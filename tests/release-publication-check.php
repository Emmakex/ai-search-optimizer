<?php

$root = dirname(__DIR__);
$publisher = file_get_contents($root . '/scripts/publish-github-release.sh');
$workflow = file_get_contents($root . '/.github/workflows/publish-0.5.0.yml');
$ctaVerifier = file_get_contents($root . '/scripts/verify-kairoseth-cta.sh');
$notes = file_get_contents($root . '/docs/releases/0.5.0.md');

if ($publisher === false || $workflow === false || $ctaVerifier === false || $notes === false) {
    fwrite(STDERR, "FAIL: could not read GitHub release publication sources.\n");
    exit(1);
}

function aiso_release_assert($condition, $message) {
    if (!$condition) {
        fwrite(STDERR, 'FAIL: ' . $message . "\n");
        exit(1);
    }
}

$expectedSource = 'b116ae5df76c7a72ad37ff4e8e80632d6ebb457b';
$expectedTree = '6a837ed67049ae04cdf59656cc15997a8d9bb7b3';
$expectedSha = '0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e';
$previousSource = '4d68b111d1f796fdc9bfbc3e670eeecc69c09a76';
$previousSha = '27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c';

foreach (array($expectedSource, $expectedTree, $expectedSha, $previousSource, $previousSha) as $required) {
    aiso_release_assert(strpos($publisher, $required) !== false, "publisher missing frozen release identity {$required}");
}

aiso_release_assert(strpos($publisher, 'TAG="0.5.0"') !== false, 'publisher must use exact immutable tag 0.5.0');
aiso_release_assert(strpos($publisher, 'gh release create') !== false && strpos($publisher, '--draft') !== false, 'publisher must create the GitHub Release as draft first');
aiso_release_assert(strpos($publisher, 'gh release download') !== false, 'publisher must download uploaded release assets for verification');
aiso_release_assert(strpos($publisher, 'cmp -s "$CURRENT_ZIP" "$DOWNLOADED_ZIP"') !== false, 'publisher must require byte-identical uploaded/downloaded ZIP');
aiso_release_assert(substr_count($publisher, 'runtime-release-lifecycle.sh') >= 2, 'publisher must run lifecycle proof before and after upload');
aiso_release_assert(strpos($publisher, 'gh release edit "$TAG" --repo "$REPOSITORY" --draft=false') !== false, 'publisher must publish only by converting the verified draft');
aiso_release_assert(strpos($publisher, 'refusing to overwrite immutable release identity') !== false, 'publisher must fail closed when the release tag already exists');
aiso_release_assert(strpos($publisher, 'Publication failed before public release; cleaning temporary GitHub release state.') !== false, 'publisher must clean draft/tag state after pre-publication failure');

$draftPos = strpos($publisher, 'gh release create');
$downloadPos = strpos($publisher, 'gh release download');
$secondLifecyclePos = strrpos($publisher, 'runtime-release-lifecycle.sh');
$publishPos = strpos($publisher, 'gh release edit "$TAG" --repo "$REPOSITORY" --draft=false');
aiso_release_assert($draftPos !== false && $downloadPos > $draftPos && $secondLifecyclePos > $downloadPos && $publishPos > $secondLifecyclePos, 'publication order must be draft -> download -> lifecycle proof -> public');

aiso_release_assert(strpos($ctaVerifier, 'https://kairoseth.com/custom-requests') !== false, 'CTA verifier must target canonical Kairoseth Custom Requests URL');
aiso_release_assert(strpos($ctaVerifier, 'extensionSlug') !== false && strpos($ctaVerifier, 'ai-search-optimizer') !== false, 'CTA verifier must send the canonical AI Search Optimizer slug');
aiso_release_assert(strpos($ctaVerifier, 'extensionName') !== false && strpos($ctaVerifier, 'AI Search Optimizer') !== false, 'CTA verifier must require canonical product identity');
aiso_release_assert(strpos($ctaVerifier, 'hostPlatform') !== false && strpos($ctaVerifier, 'wordpress') !== false, 'CTA verifier must require WordPress host context');
aiso_release_assert(strpos($ctaVerifier, 'siteUrl') !== false && strpos($ctaVerifier, 'contentHash') !== false && strpos($ctaVerifier, 'credential') !== false, 'CTA verifier must reject forbidden automatic context');
aiso_release_assert(strpos($ctaVerifier, "verify_case en implementation_support") !== false, 'CTA verifier must prove English implementation support flow');
aiso_release_assert(strpos($ctaVerifier, "verify_case en business_customization") !== false, 'CTA verifier must prove English business customization flow');
aiso_release_assert(strpos($ctaVerifier, "verify_case es implementation_support") !== false, 'CTA verifier must prove Spanish implementation support flow');
aiso_release_assert(strpos($ctaVerifier, "verify_case es business_customization") !== false, 'CTA verifier must prove Spanish business customization flow');
aiso_release_assert(strpos($ctaVerifier, 'Tell us what you need.') !== false && strpos($ctaVerifier, 'Cuéntanos qué necesitas.') !== false, 'CTA verifier must prove canonical EN/ES production copy');

aiso_release_assert(strpos($workflow, "github.event.ref_type == 'branch'") !== false, 'workflow must only accept a branch creation trigger');
aiso_release_assert(strpos($workflow, "github.event.ref == 'release/publish-0.5.0'") !== false, 'workflow must require the one-shot publication branch');
aiso_release_assert(strpos($workflow, "github.actor == 'Emmakex'") !== false, 'workflow must restrict the one-shot trigger actor');
aiso_release_assert(strpos($workflow, 'contents: write') !== false, 'publication workflow needs explicit contents write permission');
aiso_release_assert(strpos($workflow, 'ref: main') !== false && strpos($workflow, 'fetch-depth: 0') !== false, 'publication workflow must execute canonical full-history main tooling');
aiso_release_assert(strpos($workflow, 'scripts/verify-kairoseth-cta.sh') !== false, 'publication workflow must run the live CTA production verifier');
aiso_release_assert(strpos($workflow, 'scripts/publish-github-release.sh') !== false, 'workflow must use the fail-closed publisher');
$ctaPos = strpos($workflow, 'scripts/verify-kairoseth-cta.sh');
$publisherPos = strpos($workflow, 'scripts/publish-github-release.sh');
aiso_release_assert($ctaPos !== false && $publisherPos !== false && $ctaPos < $publisherPos, 'live CTA proof must execute before any GitHub release publication');

aiso_release_assert(strpos($notes, 'first public GitHub release') !== false, 'release notes must identify GitHub distribution truthfully');
aiso_release_assert(strpos($notes, 'does **not** mean the plugin is available on WordPress.org') !== false, 'release notes must not claim WordPress.org availability');
aiso_release_assert(strpos($notes, $expectedSha) !== false, 'release notes must publish the accepted package SHA-256');

echo "PASS: GitHub Release publication contract tag=0.5.0 source={$expectedSource} sha256={$expectedSha} CTA=production-gated\n";
