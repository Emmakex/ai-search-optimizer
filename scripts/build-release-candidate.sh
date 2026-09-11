#!/usr/bin/env bash
set -euo pipefail

export LC_ALL=C
export TZ=UTC

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
PLUGIN_FILE="$ROOT/ai-search-optimizer.php"
VERSION="$(sed -n 's/^ \* Version: //p' "$PLUGIN_FILE" | head -n1 | tr -d '\r')"

if [[ -z "$VERSION" ]]; then
  echo "Could not determine plugin version" >&2
  exit 1
fi

if [[ ! "$VERSION" =~ ^[0-9]+\.[0-9]+\.[0-9]+$ ]]; then
  echo "Release candidate builder requires a stable semantic version (x.y.z), received: $VERSION" >&2
  exit 1
fi

DIST="$ROOT/dist"
ZIP="$DIST/ai-search-optimizer-$VERSION.zip"
SHA_FILE="$DIST/ai-search-optimizer-$VERSION.sha256"
MANIFEST="$DIST/release-manifest.txt"
TMP="$(mktemp -d)"
trap 'rm -rf "$TMP"' EXIT

bash "$ROOT/scripts/build-plugin.sh"
cp "$ZIP" "$TMP/first.zip"
FIRST_SHA="$(sha256sum "$TMP/first.zip" | awk '{print $1}')"

bash "$ROOT/scripts/build-plugin.sh"
SECOND_SHA="$(sha256sum "$ZIP" | awk '{print $1}')"

if ! cmp -s "$TMP/first.zip" "$ZIP"; then
  echo "Release candidate build is not byte-reproducible." >&2
  echo "first_sha256=$FIRST_SHA" >&2
  echo "second_sha256=$SECOND_SHA" >&2
  exit 1
fi

PACKAGE_BYTES="$(wc -c < "$ZIP" | tr -d ' ')"
PACKAGE_ENTRIES="$(unzip -Z1 "$ZIP" | wc -l | tr -d ' ')"
SOURCE_COMMIT="$(git -C "$ROOT" rev-parse HEAD)"
SOURCE_TREE="$(git -C "$ROOT" rev-parse HEAD^{tree})"
PACKAGE_NAME="$(basename "$ZIP")"

printf '%s  %s\n' "$SECOND_SHA" "$PACKAGE_NAME" > "$SHA_FILE"
cat > "$MANIFEST" <<EOF
product=AI Search Optimizer
version=$VERSION
channel=release-candidate
source_commit=$SOURCE_COMMIT
source_tree=$SOURCE_TREE
package=$PACKAGE_NAME
package_bytes=$PACKAGE_BYTES
package_entries=$PACKAGE_ENTRIES
package_sha256=$SECOND_SHA
reproducible_build=PASS
EOF

(
  cd "$DIST"
  sha256sum -c "$(basename "$SHA_FILE")"
)

grep -Fx "version=$VERSION" "$MANIFEST" >/dev/null
grep -Fx "channel=release-candidate" "$MANIFEST" >/dev/null
grep -Fx "source_commit=$SOURCE_COMMIT" "$MANIFEST" >/dev/null
grep -Fx "source_tree=$SOURCE_TREE" "$MANIFEST" >/dev/null
grep -Fx "package=$PACKAGE_NAME" "$MANIFEST" >/dev/null
grep -Fx "package_sha256=$SECOND_SHA" "$MANIFEST" >/dev/null
grep -Fx "reproducible_build=PASS" "$MANIFEST" >/dev/null

echo "Release candidate reproducibility PASS"
echo "Version: $VERSION"
echo "Source commit: $SOURCE_COMMIT"
echo "Source tree: $SOURCE_TREE"
echo "Package: $PACKAGE_NAME"
echo "Bytes: $PACKAGE_BYTES"
echo "Entries: $PACKAGE_ENTRIES"
echo "SHA-256: $SECOND_SHA"
