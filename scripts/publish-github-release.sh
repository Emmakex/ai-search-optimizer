#!/usr/bin/env bash
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
VERSION="0.5.0"
TAG="0.5.0"
REPOSITORY="${GITHUB_REPOSITORY:-Emmakex/ai-search-optimizer}"
ACCEPTED_SOURCE="b116ae5df76c7a72ad37ff4e8e80632d6ebb457b"
ACCEPTED_TREE="6a837ed67049ae04cdf59656cc15997a8d9bb7b3"
ACCEPTED_SHA256="0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e"
PREVIOUS_VERSION="0.4.0"
PREVIOUS_SOURCE="4d68b111d1f796fdc9bfbc3e670eeecc69c09a76"
PREVIOUS_SHA256="27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c"
WORK_ROOT="${RUNNER_TEMP:-$(mktemp -d)}/aiso-publish-${VERSION}-$$"
ACCEPTED_DIR="$WORK_ROOT/accepted-source"
PREVIOUS_DIR="$WORK_ROOT/previous-source"
DOWNLOAD_DIR="$WORK_ROOT/downloaded-release"
NOTES_FILE="$ROOT/docs/releases/0.5.0.md"
TAG_CREATED=0
RELEASE_CREATED=0
RELEASE_PUBLISHED=0

CURRENT_ZIP="$ACCEPTED_DIR/dist/ai-search-optimizer-${VERSION}.zip"
CURRENT_SHA_FILE="$ACCEPTED_DIR/dist/ai-search-optimizer-${VERSION}.sha256"
CURRENT_MANIFEST="$ACCEPTED_DIR/dist/release-manifest.txt"
PREVIOUS_ZIP="$PREVIOUS_DIR/dist/ai-search-optimizer-${PREVIOUS_VERSION}.zip"

cleanup() {
  local status=$?
  set +e

  git -C "$ROOT" worktree remove --force "$ACCEPTED_DIR" >/dev/null 2>&1 || true
  git -C "$ROOT" worktree remove --force "$PREVIOUS_DIR" >/dev/null 2>&1 || true

  if [[ $status -ne 0 && "$RELEASE_PUBLISHED" -eq 0 ]]; then
    echo "Publication failed before public release; cleaning temporary GitHub release state." >&2
    if [[ "$RELEASE_CREATED" -eq 1 ]]; then
      GH_TOKEN="${GH_TOKEN:-}" gh release delete "$TAG" --repo "$REPOSITORY" --yes >/dev/null 2>&1 || true
    fi
    if [[ "$TAG_CREATED" -eq 1 ]]; then
      git -C "$ROOT" push origin ":refs/tags/$TAG" >/dev/null 2>&1 || true
      git -C "$ROOT" tag -d "$TAG" >/dev/null 2>&1 || true
    fi
  fi

  rm -rf "$WORK_ROOT"
  exit "$status"
}
trap cleanup EXIT

fail() {
  echo "$*" >&2
  exit 1
}

for command in git gh jq sha256sum cmp; do
  command -v "$command" >/dev/null 2>&1 || fail "Required publication tool missing: $command"
done

[[ -n "${GH_TOKEN:-}" ]] || fail "GH_TOKEN is required for GitHub publication."
[[ -f "$NOTES_FILE" ]] || fail "Release notes missing: $NOTES_FILE"

cd "$ROOT"

# Publication is intentionally one-shot. Never overwrite or move an existing tag/release.
if git ls-remote --exit-code --tags origin "refs/tags/$TAG" >/dev/null 2>&1; then
  fail "Tag $TAG already exists; refusing to overwrite immutable release identity."
fi
if GH_TOKEN="$GH_TOKEN" gh release view "$TAG" --repo "$REPOSITORY" >/dev/null 2>&1; then
  fail "GitHub Release $TAG already exists; refusing to overwrite it."
fi

SOURCE_TREE="$(git rev-parse "${ACCEPTED_SOURCE}^{tree}")"
[[ "$SOURCE_TREE" == "$ACCEPTED_TREE" ]] || fail "Accepted source tree drift: expected=$ACCEPTED_TREE received=$SOURCE_TREE"

mkdir -p "$WORK_ROOT" "$DOWNLOAD_DIR"
git worktree add --detach "$ACCEPTED_DIR" "$ACCEPTED_SOURCE" >/dev/null
git worktree add --detach "$PREVIOUS_DIR" "$PREVIOUS_SOURCE" >/dev/null

# Reconstruct the exact accepted 0.5.0 package from the frozen source.
bash "$ACCEPTED_DIR/scripts/build-release-candidate.sh"
[[ -f "$CURRENT_ZIP" && -f "$CURRENT_SHA_FILE" && -f "$CURRENT_MANIFEST" ]] || fail "Accepted release artifacts were not produced."
CURRENT_SHA="$(sha256sum "$CURRENT_ZIP" | awk '{print $1}')"
[[ "$CURRENT_SHA" == "$ACCEPTED_SHA256" ]] || fail "Accepted 0.5.0 package drift: expected=$ACCEPTED_SHA256 received=$CURRENT_SHA"
(
  cd "$ACCEPTED_DIR/dist"
  sha256sum -c "$(basename "$CURRENT_SHA_FILE")"
)
grep -Fx "source_commit=$ACCEPTED_SOURCE" "$CURRENT_MANIFEST" >/dev/null || fail "Release manifest source commit drifted."
grep -Fx "source_tree=$ACCEPTED_TREE" "$CURRENT_MANIFEST" >/dev/null || fail "Release manifest source tree drifted."
grep -Fx "package_sha256=$ACCEPTED_SHA256" "$CURRENT_MANIFEST" >/dev/null || fail "Release manifest package SHA drifted."

# Reconstruct the historical accepted package used by the upgrade proof.
bash "$PREVIOUS_DIR/scripts/build-plugin.sh"
[[ -f "$PREVIOUS_ZIP" ]] || fail "Historical 0.4.0 package was not produced."
PREVIOUS_SHA="$(sha256sum "$PREVIOUS_ZIP" | awk '{print $1}')"
[[ "$PREVIOUS_SHA" == "$PREVIOUS_SHA256" ]] || fail "Historical 0.4.0 package drift: expected=$PREVIOUS_SHA256 received=$PREVIOUS_SHA"

# Final pre-publication lifecycle proof against exact package identities.
CURRENT_PACKAGE="$CURRENT_ZIP" \
PREVIOUS_PACKAGE="$PREVIOUS_ZIP" \
CURRENT_VERSION="$VERSION" \
PREVIOUS_VERSION="$PREVIOUS_VERSION" \
EXPECTED_CURRENT_SHA="$ACCEPTED_SHA256" \
EXPECTED_PREVIOUS_SHA="$PREVIOUS_SHA256" \
WP_VERSION="7.1" \
PHP_VERSION="8.3" \
bash "$ROOT/scripts/runtime-release-lifecycle.sh"

# Create an annotated immutable release tag pointing to the frozen accepted product source.
git config user.name "github-actions[bot]"
git config user.email "41898282+github-actions[bot]@users.noreply.github.com"
git tag -a "$TAG" "$ACCEPTED_SOURCE" -m "AI Search Optimizer $VERSION"
git push origin "refs/tags/$TAG"
TAG_CREATED=1

REMOTE_TARGET="$(git rev-list -n1 "$TAG")"
[[ "$REMOTE_TARGET" == "$ACCEPTED_SOURCE" ]] || fail "Tag target mismatch after push: expected=$ACCEPTED_SOURCE received=$REMOTE_TARGET"

# Create as draft first. It is not made public until uploaded bytes and lifecycle are reverified.
GH_TOKEN="$GH_TOKEN" gh release create "$TAG" \
  "$CURRENT_ZIP" \
  "$CURRENT_SHA_FILE" \
  "$CURRENT_MANIFEST" \
  --repo "$REPOSITORY" \
  --verify-tag \
  --draft \
  --title "AI Search Optimizer $VERSION" \
  --notes-file "$NOTES_FILE"
RELEASE_CREATED=1

DRAFT_JSON="$WORK_ROOT/draft-release.json"
GH_TOKEN="$GH_TOKEN" gh release view "$TAG" --repo "$REPOSITORY" --json tagName,name,isDraft,isPrerelease,assets,url > "$DRAFT_JSON"
jq -e --arg tag "$TAG" --arg title "AI Search Optimizer $VERSION" '
  .tagName == $tag
  and .name == $title
  and .isDraft == true
  and .isPrerelease == false
  and ([.assets[].name] | sort) == (["ai-search-optimizer-0.5.0.sha256","ai-search-optimizer-0.5.0.zip","release-manifest.txt"] | sort)
' "$DRAFT_JSON" >/dev/null || fail "Draft GitHub Release metadata/assets do not match the accepted contract."

# Download the actual uploaded draft assets and prove they are byte-identical.
GH_TOKEN="$GH_TOKEN" gh release download "$TAG" --repo "$REPOSITORY" --dir "$DOWNLOAD_DIR"
DOWNLOADED_ZIP="$DOWNLOAD_DIR/ai-search-optimizer-${VERSION}.zip"
DOWNLOADED_SHA_FILE="$DOWNLOAD_DIR/ai-search-optimizer-${VERSION}.sha256"
DOWNLOADED_MANIFEST="$DOWNLOAD_DIR/release-manifest.txt"
for asset in "$DOWNLOADED_ZIP" "$DOWNLOADED_SHA_FILE" "$DOWNLOADED_MANIFEST"; do
  [[ -f "$asset" ]] || fail "Downloaded release asset missing: $asset"
done

DOWNLOADED_SHA="$(sha256sum "$DOWNLOADED_ZIP" | awk '{print $1}')"
[[ "$DOWNLOADED_SHA" == "$ACCEPTED_SHA256" ]] || fail "Downloaded release ZIP drift: expected=$ACCEPTED_SHA256 received=$DOWNLOADED_SHA"
(
  cd "$DOWNLOAD_DIR"
  sha256sum -c "$(basename "$DOWNLOADED_SHA_FILE")"
)
cmp -s "$CURRENT_ZIP" "$DOWNLOADED_ZIP" || fail "Uploaded/downloaded release ZIP is not byte-identical to the accepted package."
cmp -s "$CURRENT_SHA_FILE" "$DOWNLOADED_SHA_FILE" || fail "Uploaded checksum file drifted."
cmp -s "$CURRENT_MANIFEST" "$DOWNLOADED_MANIFEST" || fail "Uploaded release manifest drifted."

# Final proof runs against the asset downloaded back from GitHub, not the pre-upload local copy.
CURRENT_PACKAGE="$DOWNLOADED_ZIP" \
PREVIOUS_PACKAGE="$PREVIOUS_ZIP" \
CURRENT_VERSION="$VERSION" \
PREVIOUS_VERSION="$PREVIOUS_VERSION" \
EXPECTED_CURRENT_SHA="$ACCEPTED_SHA256" \
EXPECTED_PREVIOUS_SHA="$PREVIOUS_SHA256" \
WP_VERSION="7.1" \
PHP_VERSION="8.3" \
bash "$ROOT/scripts/runtime-release-lifecycle.sh"

# All release evidence passed. Only now make the release public.
GH_TOKEN="$GH_TOKEN" gh release edit "$TAG" --repo "$REPOSITORY" --draft=false
RELEASE_PUBLISHED=1

PUBLIC_JSON="$WORK_ROOT/public-release.json"
GH_TOKEN="$GH_TOKEN" gh release view "$TAG" --repo "$REPOSITORY" --json tagName,name,isDraft,isPrerelease,assets,url,publishedAt > "$PUBLIC_JSON"
jq -e --arg tag "$TAG" --arg title "AI Search Optimizer $VERSION" '
  .tagName == $tag
  and .name == $title
  and .isDraft == false
  and .isPrerelease == false
  and (.publishedAt != null)
  and ([.assets[].name] | sort) == (["ai-search-optimizer-0.5.0.sha256","ai-search-optimizer-0.5.0.zip","release-manifest.txt"] | sort)
' "$PUBLIC_JSON" >/dev/null || fail "Published GitHub Release metadata is inconsistent."

FINAL_TARGET="$(git rev-list -n1 "$TAG")"
[[ "$FINAL_TARGET" == "$ACCEPTED_SOURCE" ]] || fail "Published tag target drifted: expected=$ACCEPTED_SOURCE received=$FINAL_TARGET"

echo "GitHub Release publication PASS"
echo "Version: $VERSION"
echo "Tag: $TAG"
echo "Source commit: $ACCEPTED_SOURCE"
echo "Source tree: $ACCEPTED_TREE"
echo "Package SHA-256: $ACCEPTED_SHA256"
echo "Release URL: $(jq -r '.url' "$PUBLIC_JSON")"
