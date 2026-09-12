from pathlib import Path
import textwrap


def replace_once(path, old, new):
    p = Path(path)
    text = p.read_text()
    if old not in text:
        raise SystemExit(f"expected text not found in {path}: {old!r}")
    p.write_text(text.replace(old, new, 1))


# Plugin identity only; no behavior change.
replace_once(
    'ai-search-optimizer.php',
    ' * Description: Secure least-privilege llms.txt publishing connector for Kairoseth AI Search Optimizer.',
    ' * Description: Prepare, validate, publish and verify llms.txt from public WordPress content with a local-first AI Search workflow.'
)
replace_once('ai-search-optimizer.php', ' * Version: 0.5.0', ' * Version: 0.5.1')
replace_once(
    'ai-search-optimizer.php',
    "const KAIROSETH_AIWR_CONNECTOR_VERSION = '0.5.0';",
    "const KAIROSETH_AIWR_CONNECTOR_VERSION = '0.5.1';"
)

# WordPress.org package readme.
replace_once('readme.txt', 'Stable tag: 0.5.0', 'Stable tag: 0.5.1')
replace_once(
    'readme.txt',
    '`0.5.0` is the current stable candidate prepared for final release validation. It is not yet claimed as published on WordPress.org or as an official public GitHub Release. The historical accepted `0.4.0` release-candidate evidence remains preserved by the repository.',
    '`0.5.1` is the WordPress.org submission-hardening release line. The plugin is not claimed as published on WordPress.org until the directory has actually accepted and published it. The immutable public GitHub `0.5.0` release remains preserved as prior release evidence.'
)
readme = Path('readme.txt')
text = readme.read_text()
marker = '== Changelog ==\n\n'
entry = (
    '= 0.5.1 =\n'
    '* Aligned the plugin version, connector version and WordPress Stable tag for the WordPress.org submission package.\n'
    '* Removed stale pre-publication release wording from the packaged readme.\n'
    '* Preserved the local-first privacy boundary, optional Kairoseth support flow and existing product behavior without adding new features.\n'
    '* Prepared a reproducible patch package for WordPress.org review with the public 0.5.0 release retained as immutable prior evidence.\n\n'
)
if entry not in text:
    if marker not in text:
        raise SystemExit('readme changelog marker missing')
    readme.write_text(text.replace(marker, marker + entry, 1))

# Metadata regression: current submission package = 0.5.1; public GitHub release remains 0.5.0.
replace_once(
    'tests/release-metadata-check.php',
    "$expectedStableVersion = '0.5.0';",
    "$expectedStableVersion = '0.5.1';\n$publicGitHubReleaseVersion = '0.5.0';"
)
replace_once(
    'tests/release-metadata-check.php',
    "    array(strpos($readme, '= 0.5.0 =') !== false, 'WordPress readme changelog must contain 0.5.0'),",
    "    array(strpos($readme, '= 0.5.1 =') !== false, 'WordPress readme changelog must contain 0.5.1'),\n    array(strpos($readme, '= 0.5.0 =') !== false, 'WordPress readme changelog must retain public 0.5.0'),"
)
replace_once(
    'tests/release-metadata-check.php',
    "    array(strpos($phase5b, 'WordPress.org') !== false, 'Phase 5B canonical record must retain the WordPress.org boundary'),",
    "    array(strpos($phase5b, 'WordPress.org') !== false, 'Phase 5B canonical record must retain the WordPress.org boundary'),\n    array(strpos($plugin, ' * Plugin URI:') === false, '0.5.1 submission line must keep Plugin URI absent'),\n    array(strpos($plugin, ' * Author URI:') === false, '0.5.1 submission line must keep Author URI absent'),\n    array(strpos($readme, 'not yet claimed as published on WordPress.org or as an official public GitHub Release') === false, 'stale 0.5.0 pre-publication sentence remains in packaged readme'),"
)
replace_once(
    'tests/release-metadata-check.php',
    'echo "PASS: public GitHub release metadata alignment {$version} with historical RC {$historicalReleaseCandidate}\\n";',
    'echo "PASS: WordPress.org submission metadata alignment {$version}; public GitHub release {$publicGitHubReleaseVersion}; historical RC {$historicalReleaseCandidate}\\n";'
)

# Runtime defaults now describe the immediate upgrade contract.
replace_once(
    'scripts/runtime-release-lifecycle.sh',
    'CURRENT_VERSION="${CURRENT_VERSION:-0.5.0}"',
    'CURRENT_VERSION="${CURRENT_VERSION:-0.5.1}"'
)
replace_once(
    'scripts/runtime-release-lifecycle.sh',
    'PREVIOUS_VERSION="${PREVIOUS_VERSION:-0.4.0}"',
    'PREVIOUS_VERSION="${PREVIOUS_VERSION:-0.5.0}"'
)
replace_once(
    'scripts/verify-kairoseth-cta.sh',
    'PLUGIN_VERSION="${AISO_RELEASE_VERSION:-0.5.0}"',
    'PLUGIN_VERSION="${AISO_RELEASE_VERSION:-0.5.1}"'
)

# CI: live CTA gate + 0.5.0 -> 0.5.1 lifecycle. Current SHA is discovered first,
# then frozen in a follow-up commit after the first full candidate CI pass.
ci = Path('.github/workflows/ci.yml')
text = ci.read_text()
text = text.replace(
    'scripts/runtime-release-lifecycle.sh scripts/publish-github-release.sh',
    'scripts/runtime-release-lifecycle.sh scripts/publish-github-release.sh scripts/verify-kairoseth-cta.sh',
    1,
)
text = text.replace(
    '      - name: Stable release metadata alignment',
    '      - name: WordPress.org submission metadata alignment',
    1,
)
start = text.index('  release_lifecycle:\n')
end = text.index('\n  package_evidence:\n', start)
block = textwrap.dedent('''\
  cta_production:
    name: Kairoseth CTA production EN/ES
    needs: validate
    runs-on: ubuntu-latest
    timeout-minutes: 10

    steps:
      - name: Checkout
        uses: actions/checkout@v4

      - name: Verify live production CTA for 0.5.1
        env:
          AISO_RELEASE_VERSION: '0.5.1'
          AISO_WORDPRESS_VERSION: '7.1'
        run: bash scripts/ci-run.sh "Kairoseth CTA production contract 0.5.1" bash scripts/verify-kairoseth-cta.sh

  release_lifecycle:
    name: Release package lifecycle + 0.5.0 upgrade
    needs: validate
    runs-on: ubuntu-latest
    timeout-minutes: 25

    steps:
      - name: Checkout full release history
        uses: actions/checkout@v4
        with:
          fetch-depth: 0

      - name: Build current 0.5.1 submission candidate
        id: current_package
        shell: bash
        run: |
          set -euo pipefail
          bash scripts/ci-run.sh "Build current 0.5.1 submission candidate" bash scripts/build-release-candidate.sh
          current_sha="$(sha256sum dist/ai-search-optimizer-0.5.1.zip | awk '{print $1}')"
          test -n "$current_sha"
          echo "sha=$current_sha" >> "$GITHUB_OUTPUT"
          echo "Current 0.5.1 candidate SHA-256: $current_sha"

      - name: Rebuild accepted 0.5.0 package
        shell: bash
        run: |
          set -euo pipefail
          previous_dir="$RUNNER_TEMP/ai-search-optimizer-0.5.0-source"
          previous_zip="$RUNNER_TEMP/ai-search-optimizer-0.5.0.zip"
          git worktree add --detach "$previous_dir" b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
          bash "$previous_dir/scripts/build-plugin.sh"
          echo "0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e  $previous_dir/dist/ai-search-optimizer-0.5.0.zip" | sha256sum -c -
          cp "$previous_dir/dist/ai-search-optimizer-0.5.0.zip" "$previous_zip"
          git worktree remove --force "$previous_dir"

      - name: Clean install, 0.5.0 upgrade and uninstall acceptance
        env:
          CURRENT_PACKAGE: ${{ github.workspace }}/dist/ai-search-optimizer-0.5.1.zip
          PREVIOUS_PACKAGE: ${{ runner.temp }}/ai-search-optimizer-0.5.0.zip
          CURRENT_VERSION: '0.5.1'
          PREVIOUS_VERSION: '0.5.0'
          EXPECTED_CURRENT_SHA: ${{ steps.current_package.outputs.sha }}
          EXPECTED_PREVIOUS_SHA: 0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
          WP_VERSION: '7.1'
          PHP_VERSION: '8.3'
        run: bash scripts/ci-run.sh "Release package lifecycle 0.5.0 -> 0.5.1" bash scripts/runtime-release-lifecycle.sh
''')
text = text[:start] + block + text[end:]
text = text.replace(
    'needs: [validate, php_quality, wordpress_plugin_check, runtime, multisite_woocommerce, admin_ux, release_lifecycle]',
    'needs: [validate, php_quality, wordpress_plugin_check, runtime, multisite_woocommerce, admin_ux, cta_production, release_lifecycle]',
    1,
)
ci.write_text(text)

# Repository-facing truth: public 0.5.0 remains accepted while 0.5.1 is the submission candidate.
replace_once(
    'README.md',
    'Status: **Public GitHub Release `0.5.0` published and Phase 5B accepted; WordPress.org publication is not yet claimed**',
    'Status: **Public GitHub Release `0.5.0` accepted; WordPress.org submission candidate `0.5.1` is in validation; WordPress.org publication is not yet claimed**'
)
replace_once(
    'README.md',
    'Current public GitHub release: 0.5.0\nHistorical accepted Free release candidate: 0.4.0',
    'Current public GitHub release: 0.5.0\nWordPress.org submission candidate: 0.5.1\nHistorical accepted Free release candidate: 0.4.0'
)
replace_once(
    'README.md',
    'GitHub Release `0.5.0` is public, but the plugin is **not yet claimed as published on WordPress.org**. Phase 5C is the separate WordPress.org submission/review/approval gate.',
    '`0.5.1` is the current WordPress.org submission-hardening candidate. GitHub Release `0.5.0` remains public and immutable, but the plugin is **not yet claimed as published on WordPress.org**. Phase 5C remains the separate WordPress.org submission/review/approval gate.'
)
replace_once(
    'README.md',
    'El GitHub Release `0.5.0` ya es público, pero **todavía no se afirma que el plugin esté publicado en WordPress.org**. La Fase 5C cubre el envío, revisión y aprobación externa del directorio.',
    '`0.5.1` es el candidato actual de hardening para el envío a WordPress.org. El GitHub Release `0.5.0` sigue público e inmutable, pero **todavía no se afirma que el plugin esté publicado en WordPress.org**. La Fase 5C cubre el envío, revisión y aprobación externa del directorio.'
)

changelog = Path('CHANGELOG.md')
text = changelog.read_text()
marker = 'All notable standalone AI Search Optimizer changes are recorded here.\n\n'
entry = '''## 0.5.1 — WordPress.org submission candidate

### Changed
- Aligned plugin header, inherited connector version and WordPress Stable tag to `0.5.1`.
- Removed stale pre-publication wording from the packaged WordPress readme.
- Changed the plugin header description to describe the actual local-first AI Search / `llms.txt` workflow rather than the inherited connector implementation detail.
- Updated release lifecycle acceptance to prove `0.5.0 → 0.5.1` upgrade compatibility.
- Added a blocking live Kairoseth CTA EN/ES preflight for the exact `0.5.1` submission line.

### Boundary
- No customer feature, data model, REST namespace, authorization rule, storage schema or outbound-data policy changes.
- Plugin URI and Author URI remain intentionally absent.
- Public GitHub Release `0.5.0` remains immutable prior evidence.
- WordPress.org availability is not claimed until actual directory publication.

'''
if entry not in text:
    if marker not in text:
        raise SystemExit('CHANGELOG insertion marker missing')
    changelog.write_text(text.replace(marker, marker + entry, 1))

replace_once(
    'SECURITY.md',
    '`0.5.0` is the current public GitHub Release and the accepted Phase 5B release line. Its exact source/tree/package identity is frozen below. It is **not yet claimed as published on WordPress.org**.',
    '`0.5.0` is the current public GitHub Release and the accepted Phase 5B release line. Its exact source/tree/package identity is frozen below. `0.5.1` is the WordPress.org submission-hardening candidate and does not change the accepted security/privacy boundary. The plugin is **not yet claimed as published on WordPress.org**.'
)
