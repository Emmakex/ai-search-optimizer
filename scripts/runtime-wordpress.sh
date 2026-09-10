#!/usr/bin/env bash
set -euo pipefail

WP_VERSION="${WP_VERSION:?WP_VERSION is required}"
PHP_VERSION="${PHP_VERSION:?PHP_VERSION is required}"
ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
WP_CLI_VERSION="2.12.0"
SUFFIX="$(printf '%s-%s-%s' "$WP_VERSION" "$PHP_VERSION" "$$" | tr '.:' '--')"
NETWORK="aiso-runtime-$SUFFIX"
DB_CONTAINER="aiso-db-$SUFFIX"
WP_CONTAINER="aiso-wp-$SUFFIX"
WORDPRESS_IMAGE="wordpress:${WP_VERSION}-php${PHP_VERSION}-apache"
DB_IMAGE="mariadb:10.11"
WP_CLI_PHAR="/tmp/aiso-wp-cli-${WP_CLI_VERSION}.phar"
PUBLIC_FILE="/tmp/aiso-public-${SUFFIX}.txt"
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
  rm -f "$WP_CLI_PHAR" "$PUBLIC_FILE"
  exit "$status"
}
trap cleanup EXIT

wp() {
  docker exec "$WP_CONTAINER" php /tmp/wp-cli.phar --path=/var/www/html --allow-root "$@"
}

assert_wp_eval() {
  local code="$1"
  wp eval "$code"
}

echo "Runtime target: WordPress $WP_VERSION / PHP $PHP_VERSION"
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
        $dbHost = $parts[0];
        $dbPort = isset($parts[1]) ? (int) $parts[1] : 3306;
        mysqli_report(MYSQLI_REPORT_OFF);
        $db = @new mysqli($dbHost, getenv("WORDPRESS_DB_USER"), getenv("WORDPRESS_DB_PASSWORD"), getenv("WORDPRESS_DB_NAME"), $dbPort);
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

SITE_URL="http://$WP_CONTAINER"
wp core install \
  --url="$SITE_URL" \
  --title='AI Search Optimizer Runtime' \
  --admin_user=admin \
  --admin_password='runtime-test-password' \
  --admin_email='runtime@example.com' \
  --skip-email >/dev/null

ACTUAL_WP="$(wp core version)"
ACTUAL_PHP="$(docker exec "$WP_CONTAINER" php -r 'echo PHP_MAJOR_VERSION.".".PHP_MINOR_VERSION;')"
if [[ "$ACTUAL_WP" != "$WP_VERSION"* ]]; then
  echo "Expected WordPress $WP_VERSION, got $ACTUAL_WP" >&2
  exit 1
fi
if [[ "$ACTUAL_PHP" != "$PHP_VERSION" ]]; then
  echo "Expected PHP $PHP_VERSION, got $ACTUAL_PHP" >&2
  exit 1
fi

wp option update permalink_structure '/%postname%/' >/dev/null
wp rewrite flush --hard >/dev/null
wp plugin install /tmp/ai-search-optimizer.zip --activate >/dev/null

assert_wp_eval '
$admin = get_role("administrator");
if (!$admin || !$admin->has_cap("kairoseth_ai_web_readiness_deploy")) {
    fwrite(STDERR, "Administrator capability missing after activation.\n");
    exit(1);
}
if (!get_role("kairoseth_ai_web_deployer")) {
    fwrite(STDERR, "Deployer role missing after activation.\n");
    exit(1);
}
if ((string) get_option("kairoseth_ai_web_readiness_setup_version", "") !== "2") {
    fwrite(STDERR, "Setup version missing after activation.\n");
    exit(1);
}
' >/dev/null

PAGE_ID="$(wp post create --post_type=page --post_status=publish --post_title='Runtime Public Page' --post_content='Runtime public content for AI Search Optimizer.' --porcelain)"
if [[ -z "$PAGE_ID" ]]; then
  echo "Failed to create runtime public page." >&2
  exit 1
fi

PUBLISHED_HASH="$(wp eval '
$inventory = kairoseth_aiwr_local_inventory(100);
$site = array(
    "name" => get_bloginfo("name"),
    "description" => get_bloginfo("description"),
    "homeUrl" => home_url("/"),
);
$content = kairoseth_aiwr_local_build_llms($site, $inventory);
$validation = kairoseth_aiwr_local_validate_llms($content, $site["homeUrl"], KAIROSETH_AIWR_MAX_CONTENT_BYTES);
if (empty($validation["valid"])) {
    fwrite(STDERR, "Runtime llms.txt validation failed.\n");
    var_export($validation);
    exit(1);
}
$token = kairoseth_aiwr_local_deployment_token(get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null));
$result = kairoseth_aiwr_local_publish_content($content, $token, count($inventory));
if (empty($result["ok"]) || empty($result["verification"]["verified"])) {
    fwrite(STDERR, "Runtime publication/public verification failed.\n");
    var_export($result);
    exit(1);
}
echo $result["contentHash"];
')"

if [[ ! "$PUBLISHED_HASH" =~ ^[a-f0-9]{64}$ ]]; then
  echo "Runtime publication did not return a valid SHA-256: $PUBLISHED_HASH" >&2
  exit 1
fi

HOST_PORT="$(docker port "$WP_CONTAINER" 80/tcp | head -n1 | awk -F: '{print $NF}')"
if [[ -z "$HOST_PORT" ]]; then
  echo "Could not resolve published WordPress host port." >&2
  exit 1
fi

curl -fsS -H "Host: $WP_CONTAINER" "http://127.0.0.1:${HOST_PORT}/llms.txt" -o "$PUBLIC_FILE"
PUBLIC_HASH="$(sha256sum "$PUBLIC_FILE" | awk '{print $1}')"
if [[ "$PUBLIC_HASH" != "$PUBLISHED_HASH" ]]; then
  echo "Public llms.txt SHA-256 mismatch: expected=$PUBLISHED_HASH received=$PUBLIC_HASH" >&2
  exit 1
fi

wp option update kairoseth_ai_web_readiness_uninstall_mode preserve >/dev/null
wp plugin deactivate ai-search-optimizer >/dev/null

assert_wp_eval '
$d = get_option("kairoseth_ai_web_readiness_deployment", null);
if (!is_array($d) || empty($d["contentHash"])) {
    fwrite(STDERR, "Deployment was lost on deactivation.\n");
    exit(1);
}
if (get_option("kairoseth_ai_web_readiness_setup_version", null) !== null) {
    fwrite(STDERR, "Setup marker survived deactivation.\n");
    exit(1);
}
if (get_option("kairoseth_ai_web_readiness_uninstall_mode", "") !== "preserve") {
    fwrite(STDERR, "Uninstall preference was lost on deactivation.\n");
    exit(1);
}
' >/dev/null

DEACTIVATED_STATUS="$(curl -sS -o /dev/null -w '%{http_code}' -H "Host: $WP_CONTAINER" "http://127.0.0.1:${HOST_PORT}/llms.txt")"
if [[ "$DEACTIVATED_STATUS" == "200" ]]; then
  echo "llms.txt route still returned 200 while plugin was deactivated." >&2
  exit 1
fi

wp plugin activate ai-search-optimizer >/dev/null
REACTIVATED_HASH="$(wp eval '
$d = get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null);
if (!kairoseth_aiwr_local_deployment_is_valid($d)) {
    fwrite(STDERR, "Preserved deployment invalid after reactivation.\n");
    exit(1);
}
$v = kairoseth_aiwr_local_verify_current_publication();
if (empty($v["verified"])) {
    fwrite(STDERR, "Public verification failed after reactivation.\n");
    var_export($v);
    exit(1);
}
echo $d["contentHash"];
')"
if [[ "$REACTIVATED_HASH" != "$PUBLISHED_HASH" ]]; then
  echo "Reactivated deployment hash changed unexpectedly." >&2
  exit 1
fi

wp option update kairoseth_ai_web_readiness_uninstall_mode preserve >/dev/null
wp plugin deactivate ai-search-optimizer >/dev/null
assert_wp_eval '
define("WP_UNINSTALL_PLUGIN", "ai-search-optimizer/ai-search-optimizer.php");
include WP_PLUGIN_DIR . "/ai-search-optimizer/uninstall.php";
$d = get_option("kairoseth_ai_web_readiness_deployment", null);
if (!is_array($d) || empty($d["contentHash"])) {
    fwrite(STDERR, "Preserve uninstall removed deployment data.\n");
    exit(1);
}
if (get_option("kairoseth_ai_web_readiness_setup_version", null) !== null || get_option("kairoseth_ai_web_readiness_uninstall_mode", null) !== null) {
    fwrite(STDERR, "Preserve uninstall left plugin metadata.\n");
    exit(1);
}
$admin = get_role("administrator");
if ($admin && $admin->has_cap("kairoseth_ai_web_readiness_deploy")) {
    fwrite(STDERR, "Preserve uninstall left administrator capability.\n");
    exit(1);
}
if (get_role("kairoseth_ai_web_deployer")) {
    fwrite(STDERR, "Preserve uninstall left deployer role.\n");
    exit(1);
}
' >/dev/null

wp plugin activate ai-search-optimizer >/dev/null
assert_wp_eval '
$d = get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null);
if (!kairoseth_aiwr_local_deployment_is_valid($d)) {
    fwrite(STDERR, "Preserved deployment was not recoverable after reinstall/reactivation simulation.\n");
    exit(1);
}
update_option("kairoseth_ai_web_readiness_uninstall_mode", "delete", false);
' >/dev/null
wp plugin deactivate ai-search-optimizer >/dev/null
assert_wp_eval '
define("WP_UNINSTALL_PLUGIN", "ai-search-optimizer/ai-search-optimizer.php");
include WP_PLUGIN_DIR . "/ai-search-optimizer/uninstall.php";
if (get_option("kairoseth_ai_web_readiness_deployment", null) !== null) {
    fwrite(STDERR, "Delete uninstall preserved deployment data.\n");
    exit(1);
}
$admin = get_role("administrator");
if ($admin && $admin->has_cap("kairoseth_ai_web_readiness_deploy")) {
    fwrite(STDERR, "Delete uninstall left administrator capability.\n");
    exit(1);
}
if (get_role("kairoseth_ai_web_deployer")) {
    fwrite(STDERR, "Delete uninstall left deployer role.\n");
    exit(1);
}
' >/dev/null

echo "PASS: packaged runtime WordPress=$ACTUAL_WP PHP=$ACTUAL_PHP publication=$PUBLISHED_HASH lifecycle=activate/deactivate/reactivate/uninstall-preserve/uninstall-delete"
