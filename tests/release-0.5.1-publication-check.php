<?php

$root = dirname(__DIR__);
$publisher = file_get_contents($root . '/scripts/publish-github-release-0.5.1.sh');
$workflow = file_get_contents($root . '/.github/workflows/publish-0.5.1.yml');
$ctaVerifier = file_get_contents($root . '/scripts/verify-kairoseth-cta.sh');
$notes = file_get_contents($root . '/docs/releases/0.5.1.md');

if ($publisher === false || $workflow === false || $ctaVerifier === false || $notes === false) {
    fwrite(STDERR, "FAIL: could not read 0.5.1 GitHub release publication sources.\n");
    exit(1);
}

function aiso_release_051_assert($condition, $message) {
    if (!$condition) {
        fwrite(STDERR, 'FAIL: ' . $message . "\n");
        exit(1);
    }
}

$expectedSource = 'c93ac68c3698fa2c7e003dabc41f72e2e423b5cd';
$expectedTree = 'e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b';
$expectedSha = '2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b';
$expectedBytes = '29560';
$expectedEntries = '13';
$previousSource = 'b116ae5df76c7a72ad37ff4e8e80632d6ebb457b';
$previousTree = '6a837ed67049ae04cdf59656cc15997a8d9bb7b3';
$previousSha = '0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e';

foreach (array($expectedSource, $expectedTree, $expectedSha, $expectedBytes, $expectedEntries, $previousSource, $previousTree, $previousSha) as $required) {
    aiso_release_051_assert(strpos($publisher, $required) !== false, "publisher missing frozen 0.5.1 release identity {$required}");
}

aiso_release_051_assert(strpos($publisher, 'VERSION="0.5.1"') !== false, 'publisher must use exact version 0.5.1');
aiso_release_051_assert(strpos($publisher, 'TAG="0.5.1"') !== false, 'publisher must use exact immutable tag 0.5.1');
aiso_release_051_assert(strpos($publisher, 'PREVIOUS_VERSION="0.5.0"') !== false, 'publisher lifecycle baseline must be accepted 0.5.0');
aiso_release_051_assert(strpos($publisher, 'gh release create') !== false && strpos($publisher, '--draft') !== false, 'publisher must create the GitHub Release as draft first');
aiso_release_051_assert(strpos($publisher, 'gh release download') !== false, 'publisher must download uploaded release assets for verification');
aiso_release_051_assert(strpos($publisher, 'cmp -s "$CURRENT_ZIP" "$DOWNLOADED_ZIP"') !== false, 'publisher must require byte-identical uploaded/downloaded ZIP');
aiso_release_051_assert(strpos($publisher, 'CURRENT_BYTES') !== false && strpos($publisher, 'DOWNLOADED_BYTES') !== false, 'publisher must verify accepted byte size before and after upload');
aiso_release_051_assert(strpos($publisher, 'CURRENT_ENTRIES') !== false && strpos($publisher, 'DOWNLOADED_ENTRIES') !== false, 'publisher must verify accepted ZIP entry count before and after upload');
aiso_release_051_assert(substr_count($publisher, 'runtime-release-lifecycle.sh') >= 2, 'publisher must run lifecycle proof before and after upload');
aiso_release_051_assert(strpos($publisher, 'gh release edit "$TAG" --repo "$REPOSITORY" --draft=false') !== false, 'publisher must publish only by converting the verified draft');
aiso_release_051_assert(strpos($publisher, 'refusing to overwrite immutable release identity') !== false, 'publisher must fail closed when the release tag already exists');
aiso_release_051_assert(strpos($publisher, 'Publication failed before public release; cleaning temporary GitHub release state.') !== false, 'publisher must clean draft/tag state after pre-publication failure');

$draftPos = strpos($publisher, 'gh release create');
$downloadPos = strpos($publisher, 'gh release download');
$secondLifecyclePos = strrpos($publisher, 'runtime-release-lifecycle.sh');
$publishPos = strpos($publisher, 'gh release edit "$TAG" --repo "$REPOSITORY" --draft=false');
aiso_release_051_assert($draftPos !== false && $downloadPos > $draftPos && $secondLifecyclePos > $downloadPos && $publishPos > $secondLifecyclePos, 'publication order must be draft -> download -> lifecycle proof -> public');

aiso_release_051_assert(strpos($ctaVerifier, 'https://kairoseth.com/custom-requests') !== false, 'CTA verifier must target canonical Kairoseth Custom Requests URL');
aiso_release_051_assert(strpos($ctaVerifier, 'extensionVersion') !== false, 'CTA verifier must include the bounded extension version context');

aiso_release_051_assert(strpos($workflow, "github.event.ref_type == 'branch'") !== false, 'workflow must only accept a branch creation trigger');
aiso_release_051_assert(strpos($workflow, "github.event.ref == 'release/publish-0.5.1'") !== false, 'workflow must require the one-shot 0.5.1 publication branch');
aiso_release_051_assert(strpos($workflow, "github.actor == 'Emmakex'") !== false, 'workflow must restrict the one-shot trigger actor');
aiso_release_051_assert(strpos($workflow, 'contents: write') !== false, 'publication workflow needs explicit contents write permission');
aiso_release_051_assert(strpos($workflow, 'ref: main') !== false && strpos($workflow, 'fetch-depth: 0') !== false, 'publication workflow must execute canonical full-history main tooling');
aiso_release_051_assert(strpos($workflow, "AISO_RELEASE_VERSION: '0.5.1'") !== false, 'publication CTA proof must use exact 0.5.1 context');
aiso_release_051_assert(strpos($workflow, 'scripts/verify-kairoseth-cta.sh') !== false, 'publication workflow must run the live CTA production verifier');
aiso_release_051_assert(strpos($workflow, 'scripts/publish-github-release-0.5.1.sh') !== false, 'workflow must use the dedicated fail-closed 0.5.1 publisher');
$ctaPos = strpos($workflow, 'scripts/verify-kairoseth-cta.sh');
$publisherPos = strpos($workflow, 'scripts/publish-github-release-0.5.1.sh');
aiso_release_051_assert($ctaPos !== false && $publisherPos !== false && $ctaPos < $publisherPos, 'live CTA proof must execute before any GitHub release publication');

aiso_release_051_assert(strpos($notes, 'submission-hardening patch') !== false, 'release notes must identify the 0.5.1 scope truthfully');
aiso_release_051_assert(strpos($notes, 'does **not** mean the plugin is available on WordPress.org') !== false, 'release notes must not claim WordPress.org availability');
aiso_release_051_assert(strpos($notes, $expectedSource) !== false, 'release notes must publish the frozen source commit');
aiso_release_051_assert(strpos($notes, $expectedTree) !== false, 'release notes must publish the frozen source tree');
aiso_release_051_assert(strpos($notes, $expectedSha) !== false, 'release notes must publish the accepted package SHA-256');
aiso_release_051_assert(strpos($notes, $expectedBytes) !== false && strpos($notes, $expectedEntries) !== false, 'release notes must publish accepted bytes and entry count');

echo "PASS: GitHub Release 0.5.1 publication contract source={$expectedSource} sha256={$expectedSha} bytes={$expectedBytes} entries={$expectedEntries}\n";
