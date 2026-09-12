#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
CURRENT_PACKAGE="${CURRENT_PACKAGE:?CURRENT_PACKAGE is required}"
PREVIOUS_PACKAGE="${PREVIOUS_PACKAGE:?PREVIOUS_PACKAGE is required}"
CURRENT_VERSION="${CURRENT_VERSION:-0.5.0}"
PREVIOUS_VERSION="${PREVIOUS_VERSION:-0.4.0}"
EXPECTED_CURRENT_SHA="${EXPECTED_CURRENT_SHA:?EXPECTED_CURRENT_SHA is required}"
EXPECTED_PREVIOUS_SHA="${EXPECTED_PREVIOUS_SHA:?EXPECTED_PREVIOUS_SHA is required}"
WP_VERSION="${WP_VERSION:-7.1}"
PHP_VERSION="${PHP_VERSION:-8.3}"
WP_CLI_VERSION="2.12.0"
SUFFIX="$(printf '%s-%s-%s' "$WP_VERSION" "$PHP_VERSION" "$$" | tr '.:' '--')"
NETWORK="aiso-release-$SUFFIX"
DB_CONTAINER="aiso-release-db-$SUFFIX"
WP_CONTAINER="aiso-release-wp-$SUFFIX"
WORDPRESS_IMAGE="wordpress:${WP_VERSION}-php${PHP_VERSION}-apache"
DB_IMAGE="mariadb:10.11"
WP_CLI_PHAR="/tmp/aiso-release-wp-cli-${WP_CLI_VERSION}.phar"
CORE_FREEZE="define( 'WP_AUTO_UPDATE_CORE', false ); define( 'AUTOMATIC_UPDATER_DISABLED', true );"

for package in "$CURRENT_PACKAGE" "$PREVIOUS_PACKAGE"; do
  if [[ ! -f "$package" ]]; then
    echo "Release lifecycle package not found: $package" >&2
    exit 1
  fi
done

CURRENT_SHA="$(sha256sum "$CURRENT_PACKAGE" | awk '{print $1}')"
PREVIOUS_SHA="$(sha256sum "$PREVIOUS_PACKAGE" | awk '{print $1}')"
if [[ "$CURRENT_SHA" != "$EXPECTED_CURRENT_SHA" ]]; then
  echo "Current package SHA-256 mismatch: expected=$EXPECTED_CURRENT_SHA received=$CURRENT_SHA" >&2
  exit 1
fi
if [[ "$PREVIOUS_SHA" != "$EXPECTED_PREVIOUS_SHA" ]]; then
  echo "Previous package SHA-256 mismatch: expected=$EXPECTED_PREVIOUS_SHA received=$PREVIOUS_SHA" >&2
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

assert_version() {
  local expected="$1"
  local actual
  actual="$(wp plugin get ai-search-optimizer --field=version)"
  if [[ "$actual" != "$expected" ]]; then
    echo "Plugin version mismatch: expected=$expected received=$actual" >&2
    exit 1
  fi
}

assert_security_state() {
  wp eval '
$admin = get_role("administrator");
if (!$admin || !$admin->has_cap("kairoseth_ai_web_readiness_deploy")) {
    fwrite(STDERR, "Administrator capability missing.\n");
    exit(1);
}
if (!get_role("kairoseth_ai_web_deployer")) {
    fwrite(STDERR, "Deployer role missing.\n");
    exit(1);
}
if ((string) get_option("kairoseth_ai_web_readiness_setup_version", "") !== "2") {
    fwrite(STDERR, "Setup marker missing.\n");
    exit(1);
}
' >/dev/null
}

echo "Release lifecycle target: WordPress $WP_VERSION / PHP $PHP_VERSION"
echo "Previous package: $PREVIOUS_VERSION $PREVIOUS_SHA"
echo "Current package: $CURRENT_VERSION $CURRENT_SHA"

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
  -e WORDPRESS_DB_HOST="$DB_CONTAINER:3306" \
  -e WORDPRESS_DB_USER=wordpress \
  -e WORDPRESS_DB_PASSWORD=wordpress \
  -e WORDPRESS_DB_NAME=wordpress \
  -e WORDPRESS_CONFIG_EXTRA="$CORE_FREEZE" \
  "$WORDPRESS_IMAGE" >/dev/null

curl -fsSL "https://github.com/wp-cli/wp-cli/releases/download/v${WP_CLI_VERSION}/wp-cli-${WP_CLI_VERSION}.phar" -o "$WP_CLI_PHAR"
docker cp "$WP_CLI_PHAR" "$WP_CONTAINER:/tmp/wp-cli.phar"
docker cp "$CURRENT_PACKAGE" "$WP_CONTAINER:/tmp/current.zip"
docker cp "$PREVIOUS_PACKAGE" "$WP_CONTAINER:/tmp/previous.zip"

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
  --title='AI Search Optimizer Release Lifecycle' \
  --admin_user=admin \
  --admin_password='release-lifecycle-password' \
  --admin_email='release-lifecycle@example.com' \
  --skip-email >/dev/null
wp option update permalink_structure '/%postname%/' >/dev/null
wp rewrite flush --hard >/dev/null

# 1. Clean install from the exact current package.
wp plugin install /tmp/current.zip --activate >/dev/null
assert_version "$CURRENT_VERSION"
assert_security_state
wp eval '
$content = "# Release lifecycle clean install\n\nhttps://example.invalid/clean\n";
update_option("kairoseth_ai_web_readiness_deployment", array("content" => $content, "contentHash" => hash("sha256", $content)), false);
update_option("kairoseth_ai_web_readiness_uninstall_mode", "delete", false);
' >/dev/null
wp plugin uninstall ai-search-optimizer --deactivate >/dev/null
if wp plugin is-installed ai-search-optimizer >/dev/null 2>&1; then
  echo "Clean-install delete uninstall left plugin files installed." >&2
  exit 1
fi
wp eval '
if (get_option("kairoseth_ai_web_readiness_deployment", null) !== null) {
    fwrite(STDERR, "Delete uninstall after clean install preserved deployment data.\n");
    exit(1);
}
if (get_option("kairoseth_ai_web_readiness_setup_version", null) !== null || get_option("kairoseth_ai_web_readiness_uninstall_mode", null) !== null) {
    fwrite(STDERR, "Delete uninstall after clean install left plugin metadata.\n");
    exit(1);
}
$admin = get_role("administrator");
if ($admin && $admin->has_cap("kairoseth_ai_web_readiness_deploy")) {
    fwrite(STDERR, "Delete uninstall after clean install left administrator capability.\n");
    exit(1);
}
if (get_role("kairoseth_ai_web_deployer")) {
    fwrite(STDERR, "Delete uninstall after clean install left deployer role.\n");
    exit(1);
}
' >/dev/null

echo "PASS: clean install + delete uninstall from current package"

# 2. Install the accepted prior candidate and create real local-Free deployment state.
wp plugin install /tmp/previous.zip --activate >/dev/null
assert_version "$PREVIOUS_VERSION"
assert_security_state
PAGE_ID="$(wp post create --post_type=page --post_status=publish --post_title='Upgrade Source Page' --post_content='State created by the accepted previous AI Search Optimizer candidate.' --porcelain)"
if [[ -z "$PAGE_ID" ]]; then
  echo "Failed to create upgrade source page." >&2
  exit 1
fi

PRE_UPGRADE_HASH="$(wp eval '
$inventory = kairoseth_aiwr_local_inventory(100);
$site = array(
    "name" => get_bloginfo("name"),
    "description" => get_bloginfo("description"),
    "homeUrl" => home_url("/"),
);
$content = kairoseth_aiwr_local_build_llms($site, $inventory);
$validation = kairoseth_aiwr_local_validate_llms($content, $site["homeUrl"], KAIROSETH_AIWR_MAX_CONTENT_BYTES);
if (empty($validation["valid"])) {
    fwrite(STDERR, "Previous-version llms.txt validation failed.\n");
    exit(1);
}
$token = kairoseth_aiwr_local_deployment_token(get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null));
$result = kairoseth_aiwr_local_publish_content($content, $token, count($inventory));
if (empty($result["ok"]) || empty($result["verification"]["verified"])) {
    fwrite(STDERR, "Previous-version publication failed.\n");
    var_export($result);
    exit(1);
}
echo $result["contentHash"];
')"
if [[ ! "$PRE_UPGRADE_HASH" =~ ^[a-f0-9]{64}$ ]]; then
  echo "Previous-version publication returned invalid SHA-256: $PRE_UPGRADE_HASH" >&2
  exit 1
fi

# 3. Upgrade in place to the exact current package and prove persisted state survives.
wp plugin install /tmp/current.zip --force >/dev/null
wp plugin activate ai-search-optimizer >/dev/null
assert_version "$CURRENT_VERSION"
assert_security_state
POST_UPGRADE_HASH="$(wp eval '
$d = get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null);
if (!kairoseth_aiwr_local_deployment_is_valid($d)) {
    fwrite(STDERR, "Deployment invalid after upgrade.\n");
    exit(1);
}
$v = kairoseth_aiwr_local_verify_current_publication();
if (empty($v["verified"])) {
    fwrite(STDERR, "Public verification failed after upgrade.\n");
    var_export($v);
    exit(1);
}
echo $d["contentHash"];
')"
if [[ "$POST_UPGRADE_HASH" != "$PRE_UPGRADE_HASH" ]]; then
  echo "Deployment hash changed during upgrade: before=$PRE_UPGRADE_HASH after=$POST_UPGRADE_HASH" >&2
  exit 1
fi

echo "PASS: upgrade $PREVIOUS_VERSION -> $CURRENT_VERSION preserved verified deployment $POST_UPGRADE_HASH"

# 4. Preserve uninstall must remove plugin/security metadata but retain deployment data.
wp option update kairoseth_ai_web_readiness_uninstall_mode preserve >/dev/null
wp plugin uninstall ai-search-optimizer --deactivate >/dev/null
if wp plugin is-installed ai-search-optimizer >/dev/null 2>&1; then
  echo "Preserve uninstall left plugin files installed." >&2
  exit 1
fi
wp eval '
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

# 5. Reinstall current package and prove preserved deployment is recoverable, then delete it deliberately.
wp plugin install /tmp/current.zip --activate >/dev/null
assert_version "$CURRENT_VERSION"
assert_security_state
RECOVERED_HASH="$(wp eval '
$d = get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null);
if (!kairoseth_aiwr_local_deployment_is_valid($d)) {
    fwrite(STDERR, "Preserved deployment invalid after reinstall.\n");
    exit(1);
}
$v = kairoseth_aiwr_local_verify_current_publication();
if (empty($v["verified"])) {
    fwrite(STDERR, "Preserved deployment public verification failed after reinstall.\n");
    exit(1);
}
echo $d["contentHash"];
')"
if [[ "$RECOVERED_HASH" != "$PRE_UPGRADE_HASH" ]]; then
  echo "Recovered deployment hash changed after preserve uninstall/reinstall." >&2
  exit 1
fi
wp option update kairoseth_ai_web_readiness_uninstall_mode delete >/dev/null
wp plugin uninstall ai-search-optimizer --deactivate >/dev/null
wp eval '
if (get_option("kairoseth_ai_web_readiness_deployment", null) !== null) {
    fwrite(STDERR, "Final delete uninstall preserved deployment data.\n");
    exit(1);
}
if (get_option("kairoseth_ai_web_readiness_setup_version", null) !== null || get_option("kairoseth_ai_web_readiness_uninstall_mode", null) !== null) {
    fwrite(STDERR, "Final delete uninstall left plugin metadata.\n");
    exit(1);
}
$admin = get_role("administrator");
if ($admin && $admin->has_cap("kairoseth_ai_web_readiness_deploy")) {
    fwrite(STDERR, "Final delete uninstall left administrator capability.\n");
    exit(1);
}
if (get_role("kairoseth_ai_web_deployer")) {
    fwrite(STDERR, "Final delete uninstall left deployer role.\n");
    exit(1);
}
' >/dev/null

echo "PASS: release lifecycle clean-install/upgrade/preserve/delete current=$CURRENT_VERSION previous=$PREVIOUS_VERSION package_sha256=$CURRENT_SHA"
