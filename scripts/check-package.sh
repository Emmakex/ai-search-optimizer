#!/usr/bin/env bash
set -euo pipefail

ZIP="$(find dist -maxdepth 1 -name 'ai-search-optimizer-*.zip' -type f -print -quit)"
test -n "$ZIP"

unzip -Z1 "$ZIP" | sort > /tmp/ai-search-optimizer-package-files.txt
cat /tmp/ai-search-optimizer-package-files.txt

cat > /tmp/ai-search-optimizer-expected-files.txt <<'EOF'
ai-search-optimizer/
ai-search-optimizer/LICENSE
ai-search-optimizer/ai-search-optimizer.php
ai-search-optimizer/includes/
ai-search-optimizer/includes/local-admin-assets.php
ai-search-optimizer/includes/local-admin.php
ai-search-optimizer/includes/local-core.php
ai-search-optimizer/includes/local-lifecycle.php
ai-search-optimizer/includes/local-publish.php
ai-search-optimizer/readme.txt
ai-search-optimizer/uninstall.php
EOF

diff -u /tmp/ai-search-optimizer-expected-files.txt /tmp/ai-search-optimizer-package-files.txt
