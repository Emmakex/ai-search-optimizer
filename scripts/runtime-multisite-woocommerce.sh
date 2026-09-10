#!/usr/bin/env bash
set -euo pipefail

WP_VERSION="${WP_VERSION:-7.1}"
PHP_VERSION="${PHP_VERSION:-8.3}"
WOO_VERSION="${WOO_VERSION:-11.1.0}"
ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
WP_CLI_VERSION="2.12.0"
SUFFIX="$(printf '%s-%s-%s-%s' "$WP_VERSION" "$PHP_VERSION" "$WOO_VERSION" "$$" | tr '.:' '--')"
NETWORK="aiso-ms-$SUFFIX"
DB_CONTAINER="aiso-ms-db-$SUFFIX"
WP_CONTAINER="aiso-ms-wp-$SUFFIX"
WORDPRESS_IMAGE="wordpress:${WP_VERSION}-php${PHP_VERSION}-apache"
DB_IMAGE="mariadb:10.11"
WP_CLI_PHAR="/tmp/aiso-ms-wp-cli-${WP_CLI_VERSION}.phar"
PACKAGE="$(find "$ROOT/dist" -maxdepth 1 -name 'ai-search-optimizer-*.zip' -type f -print -quit)"
CORE_FREEZE="define( 'WP_AUTO_UPDATE_CORE', false ); define( 'AUTOMATIC_UPDATER_DISABLED', true );"

if [[ -z "$PACKAGE" || ! -f "$PACKAGE" ]]; then
  echo "Runtime package not found. Run scripts/build-plugin.sh first." >&2
  exit 1
fi

cleanup() {
  local status=$?
  if [[ $status -ne 0 ]]; then
    echo "--- WordPress container logs ---" >&2
    docker logs "$WP_CONTAINER" 2>&1 || true
    echo "--- Database container logs ---" >&2
    docker logs "$DB_CONTAINER" 2>&1 || true
  fi
  docker rm -f "$WP_CONTAINER" "$DB_CONTAINER" >/dev/null 2>&1 || true
  docker network rm "$NETWORK" >/dev/null 2>&1 || true
  rm -f "$WP_CLI_PHAR"
  exit "$status"
}
trap cleanup EXIT

wp() {
  docker exec "$WP_CONTAINER" php /tmp/wp-cli.phar --path=/var/www/html --allow-root "$@"
}

assert_site_eval() {
  local url="$1"
  local code="$2"
  wp --url="$url" eval "$code"
}

publish_site() {
  local url="$1"
  wp --url="$url" eval '
$inventory = kairoseth_aiwr_local_inventory(100);
$site = array(
    "name" => get_bloginfo("name"),
    "description" => get_bloginfo("description"),
    "homeUrl" => home_url("/"),
);
$content = kairoseth_aiwr_local_build_llms($site, $inventory);
$validation = kairoseth_aiwr_local_validate_llms($content, $site["homeUrl"], KAIROSETH_AIWR_MAX_CONTENT_BYTES);
if (empty($validation["valid"])) {
    fwrite(STDERR, "Multisite llms.txt validation failed.\n");
    var_export($validation);
    exit(1);
}
$token = kairoseth_aiwr_local_deployment_token(get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null));
$result = kairoseth_aiwr_local_publish_content($content, $token, count($inventory));
if (empty($result["ok"]) || empty($result["verification"]["verified"])) {
    fwrite(STDERR, "Multisite publication/public verification failed.\n");
    var_export($result);
    exit(1);
}
echo $result["contentHash"];
'
}

echo "Multisite/Woo runtime target: WordPress $WP_VERSION / PHP $PHP_VERSION / WooCommerce $WOO_VERSION"
docker network create "$NETWORK" >/dev/null

docker run -d \
  --name "$DB_CONTAINER" \
  --network "$NETWORK" \
  -e MARIADB_ROOT_PASSWORD=root \
  -e MARIADB_DATABASE=wordpress \
  -e MARIADB_USER=wordpress \
  -e MARIADB_PASSWORD=wordpress \
  "$DB_IMAGE" >/dev/null

docker run -d \
  --name "$WP_CONTAINER" \
  --network "$NETWORK" \
  -p 127.0.0.1::80 \
  -e WORDPRESS_DB_HOST="$DB_CONTAINER:3306" \
  -e WORDPRESS_DB_USER=wordpress \
  -e WORDPRESS_DB_PASSWORD=wordpress \
  -e WORDPRESS_DB_NAME=wordpress \
  -e WORDPRESS_CONFIG_EXTRA="$CORE_FREEZE" \
  "$WORDPRESS_IMAGE" >/dev/null

curl -fsSL "https://github.com/wp-cli/wp-cli/releases/download/v${WP_CLI_VERSION}/wp-cli-${WP_CLI_VERSION}.phar" -o "$WP_CLI_PHAR"
docker cp "$WP_CLI_PHAR" "$WP_CONTAINER:/tmp/wp-cli.phar"
docker cp "$PACKAGE" "$WP_CONTAINER:/tmp/ai-search-optimizer.zip"

for attempt in $(seq 1 60); do
  if docker exec "$WP_CONTAINER" test -f /var/www/html/wp-settings.php >/dev/null 2>&1 \
    && docker exec "$WP_CONTAINER" php -r '
        $host = getenv("WORDPRESS_DB_HOST");
        $parts = explode(":", (string) $host, 2);
        mysqli_report(MYSQLI_REPORT_OFF);
        $db = @new mysqli($parts[0], getenv("WORDPRESS_DB_USER"), getenv("WORDPRESS_DB_PASSWORD"), getenv("WORDPRESS_DB_NAME"), isset($parts[1]) ? (int) $parts[1] : 3306);
        exit($db->connect_errno ? 1 : 0);
      ' >/dev/null 2>&1; then
    break
  fi
  if [[ "$attempt" -eq 60 ]]; then
    echo "WordPress/database did not become ready." >&2
    exit 1
  fi
  sleep 2
done

MAIN_URL="http://$WP_CONTAINER"
wp core install \
  --url="$MAIN_URL" \
  --title='AI Search Optimizer Network' \
  --admin_user=admin \
  --admin_password='runtime-test-password' \
  --admin_email='runtime@example.com' \
  --skip-email >/dev/null

ACTUAL_WP="$(wp core version)"
ACTUAL_PHP="$(docker exec "$WP_CONTAINER" php -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;')"
[[ "$ACTUAL_WP" == "$WP_VERSION"* ]] || { echo "Expected WordPress $WP_VERSION, got $ACTUAL_WP" >&2; exit 1; }
[[ "$ACTUAL_PHP" == "$PHP_VERSION" ]] || { echo "Expected PHP $PHP_VERSION, got $ACTUAL_PHP" >&2; exit 1; }

wp option update permalink_structure '/%postname%/' >/dev/null
wp core multisite-convert --title='AI Search Optimizer Network' >/dev/null
wp rewrite flush --hard >/dev/null
wp plugin install /tmp/ai-search-optimizer.zip >/dev/null
wp plugin activate ai-search-optimizer --network >/dev/null

assert_site_eval "$MAIN_URL" '
if (!is_multisite() || get_current_blog_id() !== 1) { fwrite(STDERR, "Main Multisite identity invalid.\n"); exit(1); }
if ((string) get_option(KAIROSETH_AIWR_SETUP_OPTION, "") !== KAIROSETH_AIWR_SCHEMA_VERSION) { fwrite(STDERR, "Main setup marker missing.\n"); exit(1); }
$admin = get_role("administrator");
if (!$admin || !$admin->has_cap(KAIROSETH_AIWR_CAPABILITY)) { fwrite(STDERR, "Main administrator capability missing.\n"); exit(1); }
' >/dev/null

BLOG2_ID="$(wp site create --slug=shop --title='Shop Site' --email='shop@example.com' --porcelain)"
[[ "$BLOG2_ID" =~ ^[0-9]+$ ]] || { echo "Could not create Multisite subsite: $BLOG2_ID" >&2; exit 1; }
SITE2_URL="$(wp eval "echo get_site_url($BLOG2_ID, '/');")"
[[ -n "$SITE2_URL" ]] || { echo "Could not resolve subsite URL." >&2; exit 1; }

assert_site_eval "$SITE2_URL" '
if (get_current_blog_id() === 1) { fwrite(STDERR, "Subsite did not resolve to an independent blog.\n"); exit(1); }
if ((string) get_option(KAIROSETH_AIWR_SETUP_OPTION, "") !== KAIROSETH_AIWR_SCHEMA_VERSION) { fwrite(STDERR, "New subsite was not initialized by network-active plugin.\n"); exit(1); }
$identity = kairoseth_aiwr_site_identity();
if (empty($identity["isMultisite"]) || !empty($identity["isMainSite"]) || (int) $identity["blogId"] === 1) { fwrite(STDERR, "Subsite identity boundary invalid.\n"); exit(1); }
' >/dev/null

wp plugin install woocommerce --version="$WOO_VERSION" >/dev/null
wp --url="$SITE2_URL" plugin activate woocommerce >/dev/null
ACTUAL_WOO="$(wp --url="$SITE2_URL" eval 'echo defined("WC_VERSION") ? WC_VERSION : "";')"
[[ "$ACTUAL_WOO" == "$WOO_VERSION" ]] || { echo "Expected WooCommerce $WOO_VERSION, got $ACTUAL_WOO" >&2; exit 1; }

assert_site_eval "$MAIN_URL" '
if (class_exists("WooCommerce")) { fwrite(STDERR, "WooCommerce leaked into main-site plugin context.\n"); exit(1); }
' >/dev/null
assert_site_eval "$SITE2_URL" '
if (!class_exists("WooCommerce")) { fwrite(STDERR, "WooCommerce is not active in the target subsite.\n"); exit(1); }
' >/dev/null

MAIN_PAGE="$(wp --url="$MAIN_URL" post create --post_type=page --post_status=publish --post_title='Main Network Resource' --post_content='Main site public AI Search content.' --porcelain)"
PUBLIC_PRODUCT="$(wp --url="$SITE2_URL" post create --post_type=product --post_status=publish --post_title='Public Runtime Product' --post_content='Public WooCommerce product for AI Search.' --porcelain)"
DRAFT_PRODUCT="$(wp --url="$SITE2_URL" post create --post_type=product --post_status=draft --post_title='Draft Runtime Product' --porcelain)"
PRIVATE_PRODUCT="$(wp --url="$SITE2_URL" post create --post_type=product --post_status=private --post_title='Private Runtime Product' --porcelain)"
PASSWORD_PRODUCT="$(wp --url="$SITE2_URL" post create --post_type=product --post_status=publish --post_password='secret' --post_title='Password Runtime Product' --porcelain)"

for id in "$MAIN_PAGE" "$PUBLIC_PRODUCT" "$DRAFT_PRODUCT" "$PRIVATE_PRODUCT" "$PASSWORD_PRODUCT"; do
  [[ "$id" =~ ^[0-9]+$ ]] || { echo "Runtime content creation failed: $id" >&2; exit 1; }
done

PRODUCT_ASSERTION="
\$inventory = kairoseth_aiwr_local_inventory(100);
\$ids = array_map(function (\$item) { return isset(\$item['id']) ? (int) \$item['id'] : 0; }, \$inventory);
if (!in_array($PUBLIC_PRODUCT, \$ids, true)) { fwrite(STDERR, 'Published WooCommerce product missing from inventory.\\n'); exit(1); }
foreach (array($DRAFT_PRODUCT, $PRIVATE_PRODUCT, $PASSWORD_PRODUCT) as \$blocked) {
    if (in_array(\$blocked, \$ids, true)) { fwrite(STDERR, 'Non-public WooCommerce product leaked into inventory.\\n'); exit(1); }
}
"
assert_site_eval "$SITE2_URL" "$PRODUCT_ASSERTION" >/dev/null

assert_site_eval "$MAIN_URL" '
foreach (kairoseth_aiwr_local_inventory(100) as $item) {
    if (isset($item["url"]) && strpos((string) $item["url"], "/shop/") !== false) {
        fwrite(STDERR, "Subsite content leaked into main-site inventory.\n");
        exit(1);
    }
}
' >/dev/null

MAIN_HASH="$(publish_site "$MAIN_URL")"
[[ "$MAIN_HASH" =~ ^[a-f0-9]{64}$ ]] || { echo "Invalid main-site publication hash: $MAIN_HASH" >&2; exit 1; }
MAIN_HASH_BEFORE_SUB="$(wp --url="$MAIN_URL" eval '$d=get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION,null); echo is_array($d)&&isset($d["contentHash"])?$d["contentHash"]:"";')"
SUB_HASH="$(publish_site "$SITE2_URL")"
[[ "$SUB_HASH" =~ ^[a-f0-9]{64}$ ]] || { echo "Invalid subsite publication hash: $SUB_HASH" >&2; exit 1; }
[[ "$MAIN_HASH" != "$SUB_HASH" ]] || { echo "Main/subsite deployments unexpectedly have identical hashes." >&2; exit 1; }
MAIN_HASH_AFTER_SUB="$(wp --url="$MAIN_URL" eval '$d=get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION,null); echo is_array($d)&&isset($d["contentHash"])?$d["contentHash"]:"";')"
[[ "$MAIN_HASH_BEFORE_SUB" == "$MAIN_HASH_AFTER_SUB" && "$MAIN_HASH_AFTER_SUB" == "$MAIN_HASH" ]] || { echo "Subsite publication mutated main-site deployment." >&2; exit 1; }

SUB_STORED_HASH="$(wp --url="$SITE2_URL" eval '$d=get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION,null); echo is_array($d)&&isset($d["contentHash"])?$d["contentHash"]:"";')"
[[ "$SUB_STORED_HASH" == "$SUB_HASH" ]] || { echo "Subsite stored deployment hash mismatch." >&2; exit 1; }

HOST_PORT="$(docker port "$WP_CONTAINER" 80/tcp | head -n1 | awk -F: '{print $NF}')"
[[ -n "$HOST_PORT" ]] || { echo "Could not resolve WordPress host port." >&2; exit 1; }
MAIN_PUBLIC_HASH="$(curl -fsS -H "Host: $WP_CONTAINER" "http://127.0.0.1:${HOST_PORT}/llms.txt" | sha256sum | awk '{print $1}')"
SUB_PUBLIC_HASH="$(curl -fsS -H "Host: $WP_CONTAINER" "http://127.0.0.1:${HOST_PORT}/shop/llms.txt" | sha256sum | awk '{print $1}')"
[[ "$MAIN_PUBLIC_HASH" == "$MAIN_HASH" ]] || { echo "Main public hash mismatch." >&2; exit 1; }
[[ "$SUB_PUBLIC_HASH" == "$SUB_HASH" ]] || { echo "Subsite public hash mismatch." >&2; exit 1; }

wp plugin deactivate ai-search-optimizer --network >/dev/null
assert_site_eval "$MAIN_URL" '
$d=get_option("kairoseth_ai_web_readiness_deployment",null);
if (!is_array($d) || empty($d["contentHash"])) { fwrite(STDERR,"Main deployment lost on network deactivation.\n"); exit(1); }
if (get_option("kairoseth_ai_web_readiness_setup_version",null)!==null) { fwrite(STDERR,"Main setup marker survived network deactivation.\n"); exit(1); }
' >/dev/null
assert_site_eval "$SITE2_URL" '
$d=get_option("kairoseth_ai_web_readiness_deployment",null);
if (!is_array($d) || empty($d["contentHash"])) { fwrite(STDERR,"Subsite deployment lost on network deactivation.\n"); exit(1); }
if (get_option("kairoseth_ai_web_readiness_setup_version",null)!==null) { fwrite(STDERR,"Subsite setup marker survived network deactivation.\n"); exit(1); }
' >/dev/null

wp plugin activate ai-search-optimizer --network >/dev/null
assert_site_eval "$MAIN_URL" '
$v=kairoseth_aiwr_local_verify_current_publication();
if (empty($v["verified"])) { fwrite(STDERR,"Main deployment did not recover after network reactivation.\n"); exit(1); }
' >/dev/null
assert_site_eval "$SITE2_URL" '
$v=kairoseth_aiwr_local_verify_current_publication();
if (empty($v["verified"])) { fwrite(STDERR,"Subsite deployment did not recover after network reactivation.\n"); exit(1); }
' >/dev/null

wp --url="$MAIN_URL" option update kairoseth_ai_web_readiness_uninstall_mode preserve >/dev/null
wp --url="$SITE2_URL" option update kairoseth_ai_web_readiness_uninstall_mode delete >/dev/null
wp plugin deactivate ai-search-optimizer --network >/dev/null
wp eval 'define("WP_UNINSTALL_PLUGIN", "ai-search-optimizer/ai-search-optimizer.php"); include WP_PLUGIN_DIR . "/ai-search-optimizer/uninstall.php";' >/dev/null

assert_site_eval "$MAIN_URL" '
$d=get_option("kairoseth_ai_web_readiness_deployment",null);
if (!is_array($d) || empty($d["contentHash"])) { fwrite(STDERR,"Main preserve policy removed deployment during network uninstall.\n"); exit(1); }
if (get_option("kairoseth_ai_web_readiness_uninstall_mode",null)!==null || get_option("kairoseth_ai_web_readiness_setup_version",null)!==null) { fwrite(STDERR,"Main plugin metadata survived uninstall.\n"); exit(1); }
$admin=get_role("administrator");
if ($admin && $admin->has_cap("kairoseth_ai_web_readiness_deploy")) { fwrite(STDERR,"Main administrator capability survived uninstall.\n"); exit(1); }
if (get_role("kairoseth_ai_web_deployer")) { fwrite(STDERR,"Main deployer role survived uninstall.\n"); exit(1); }
' >/dev/null
assert_site_eval "$SITE2_URL" '
if (get_option("kairoseth_ai_web_readiness_deployment",null)!==null) { fwrite(STDERR,"Subsite delete policy preserved deployment during network uninstall.\n"); exit(1); }
if (get_option("kairoseth_ai_web_readiness_uninstall_mode",null)!==null || get_option("kairoseth_ai_web_readiness_setup_version",null)!==null) { fwrite(STDERR,"Subsite plugin metadata survived uninstall.\n"); exit(1); }
$admin=get_role("administrator");
if ($admin && $admin->has_cap("kairoseth_ai_web_readiness_deploy")) { fwrite(STDERR,"Subsite administrator capability survived uninstall.\n"); exit(1); }
if (get_role("kairoseth_ai_web_deployer")) { fwrite(STDERR,"Subsite deployer role survived uninstall.\n"); exit(1); }
' >/dev/null

echo "PASS: Multisite isolation + WooCommerce $ACTUAL_WOO on WordPress $ACTUAL_WP / PHP $ACTUAL_PHP main_hash=$MAIN_HASH sub_hash=$SUB_HASH lifecycle=network-activate/new-site/deactivate/reactivate/uninstall-per-site"
