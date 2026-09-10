#!/usr/bin/env bash
set -euo pipefail

export LC_ALL=C
export TZ=UTC
umask 022

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
PLUGIN_FILE="$ROOT/ai-search-optimizer.php"
VERSION="$(sed -n 's/^ \* Version: //p' "$PLUGIN_FILE" | head -n1 | tr -d '\r')"

if [[ -z "$VERSION" ]]; then
  echo "Could not determine plugin version" >&2
  exit 1
fi

DIST="$ROOT/dist"
PACKAGE_DIR="$DIST/ai-search-optimizer"
ZIP="$DIST/ai-search-optimizer-$VERSION.zip"

rm -rf "$DIST"
mkdir -p "$PACKAGE_DIR"
cp "$PLUGIN_FILE" "$PACKAGE_DIR/ai-search-optimizer.php"
cp "$ROOT/uninstall.php" "$PACKAGE_DIR/uninstall.php"
cp "$ROOT/readme.txt" "$PACKAGE_DIR/readme.txt"
cp "$ROOT/LICENSE" "$PACKAGE_DIR/LICENSE"
cp -R "$ROOT/includes" "$PACKAGE_DIR/includes"

# Canonical release packaging: normalize permissions, timestamps and entry order so
# the same accepted source tree produces byte-identical ZIP bytes in the Linux CI
# build environment. 2000-01-01 UTC is safely representable by the ZIP format.
find "$PACKAGE_DIR" -type d -exec chmod 0755 {} +
find "$PACKAGE_DIR" -type f -exec chmod 0644 {} +
find "$PACKAGE_DIR" -exec touch -t 200001010000.00 {} +

(
  cd "$DIST"
  find ai-search-optimizer -print | sort | zip -X -q "$ZIP" -@
)

unzip -t "$ZIP" >/dev/null

echo "Built $ZIP"
sha256sum "$ZIP"
