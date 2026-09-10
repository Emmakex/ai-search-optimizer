#!/usr/bin/env bash
set -euo pipefail

WP_VERSION="${WP_VERSION:-7.1}"
PHP_VERSION="${PHP_VERSION:-8.3}"
ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
WP_CLI_VERSION="2.12.0"
PLAYWRIGHT_CORE_VERSION="1.55.0"
SUFFIX="$(printf '%s-%s-%s' "$WP_VERSION" "$PHP_VERSION" "$$" | tr '.:' '--')"
NETWORK="aiso-ux-$SUFFIX"
DB_CONTAINER="aiso-ux-db-$SUFFIX"
WP_CONTAINER="aiso-ux-wp-$SUFFIX"
WORDPRESS_IMAGE="wordpress:${WP_VERSION}-php${PHP_VERSION}-apache"
DB_IMAGE="mariadb:10.11"
WP_CLI_PHAR="/tmp/aiso-ux-wp-cli-${WP_CLI_VERSION}.phar"
PACKAGE="$(find "$ROOT/dist" -maxdepth 1 -name 'ai-search-optimizer-*.zip' -type f -print -quit)"
CORE_FREEZE="define( 'WP_AUTO_UPDATE_CORE', false ); define( 'AUTOMATIC_UPDATER_DISABLED', true );"
HOST_PORT="18080"
BASE_URL="http://127.0.0.1:${HOST_PORT}"
ADMIN_PASS="$(openssl rand -hex 18)"

echo "::add-mask::${ADMIN_PASS}"

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
  rm -rf "$ROOT/node_modules"
  exit "$status"
}
trap cleanup EXIT

wp() {
  docker exec "$WP_CONTAINER" php /tmp/wp-cli.phar --path=/var/www/html --allow-root "$@"
}

echo "Admin UX runtime target: WordPress $WP_VERSION / PHP $PHP_VERSION"
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
  -p "127.0.0.1:${HOST_PORT}:80" \
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

wp core install \
  --url="$BASE_URL" \
  --title='AI Search Optimizer UX' \
  --admin_user=admin \
  --admin_password="$ADMIN_PASS" \
  --admin_email='runtime@example.com' \
  --skip-email >/dev/null

wp option update permalink_structure '/%postname%/' >/dev/null
wp rewrite flush --hard >/dev/null
wp plugin install /tmp/ai-search-optimizer.zip --activate >/dev/null

for n in $(seq 1 12); do
  wp post create \
    --post_type=page \
    --post_status=publish \
    --post_title="Responsive Runtime Resource ${n} with a deliberately long title for narrow admin layouts" \
    --post_content="Public content ${n} used to exercise the responsive AI Search Optimizer inventory." \
    >/dev/null
done

for attempt in $(seq 1 30); do
  if curl -fsS "$BASE_URL/wp-login.php" >/dev/null 2>&1; then
    break
  fi
  if [[ "$attempt" -eq 30 ]]; then
    echo "WordPress HTTP endpoint did not become ready." >&2
    exit 1
  fi
  sleep 1
done

CHROME_BIN="$(command -v google-chrome-stable || command -v google-chrome || command -v chromium || true)"
if [[ -z "$CHROME_BIN" ]]; then
  echo "No supported Chromium/Chrome executable found on CI runner." >&2
  exit 1
fi

cd "$ROOT"
npm install --no-save --package-lock=false "playwright-core@${PLAYWRIGHT_CORE_VERSION}" >/dev/null

BASE_URL="$BASE_URL" CHROME_BIN="$CHROME_BIN" WP_TEST_ADMIN_PASS="$ADMIN_PASS" EXPECT_LOCALE=en node scripts/admin-ux.mjs

wp language core install es_ES >/dev/null
wp site switch-language es_ES >/dev/null
ADMIN_ID="$(wp user get admin --field=ID)"
wp user meta update "$ADMIN_ID" locale es_ES >/dev/null

BASE_URL="$BASE_URL" CHROME_BIN="$CHROME_BIN" WP_TEST_ADMIN_PASS="$ADMIN_PASS" EXPECT_LOCALE=es node scripts/admin-ux.mjs

echo "PASS: real browser admin UX EN/ES WordPress=$WP_VERSION PHP=$PHP_VERSION viewports=1280x900,390x844"
