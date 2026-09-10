#!/usr/bin/env bash
set -euo pipefail

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

(
  cd "$DIST"
  TZ=UTC zip -X -q -r "$(basename "$ZIP")" ai-search-optimizer
)

unzip -t "$ZIP" >/dev/null

echo "Built $ZIP"
sha256sum "$ZIP"
