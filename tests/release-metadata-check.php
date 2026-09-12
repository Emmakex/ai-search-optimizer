<?php

$root = dirname(__DIR__);
$plugin = file_get_contents($root . '/ai-search-optimizer.php');
$readme = file_get_contents($root . '/readme.txt');
$repoReadme = file_get_contents($root . '/README.md');
$changelog = file_get_contents($root . '/CHANGELOG.md');
$security = file_get_contents($root . '/SECURITY.md');
$phase5b = file_get_contents($root . '/docs/PHASE5B_GITHUB_RELEASE.md');

if ($plugin === false || $readme === false || $repoReadme === false || $changelog === false || $security === false || $phase5b === false) {
    fwrite(STDERR, "FAIL: could not read release metadata sources.\n");
    exit(1);
}

function aiso_capture($pattern, $content, $label) {
    if (!preg_match($pattern, $content, $matches)) {
        fwrite(STDERR, "FAIL: missing {$label}.\n");
        exit(1);
    }
    return trim($matches[1]);
}

$version = aiso_capture('/^ \* Version:\s*(.+)$/m', $plugin, 'plugin Version header');
$constantVersion = aiso_capture("/KAIROSETH_AIWR_CONNECTOR_VERSION\s*=\s*'([^']+)'/", $plugin, 'connector version constant');
$requiresWp = aiso_capture('/^ \* Requires at least:\s*(.+)$/m', $plugin, 'plugin minimum WordPress version');
$requiresPhp = aiso_capture('/^ \* Requires PHP:\s*(.+)$/m', $plugin, 'plugin minimum PHP version');
$stableTag = aiso_capture('/^Stable tag:\s*(.+)$/m', $readme, 'readme Stable tag');
$readmeRequiresWp = aiso_capture('/^Requires at least:\s*(.+)$/m', $readme, 'readme minimum WordPress version');
$readmeRequiresPhp = aiso_capture('/^Requires PHP:\s*(.+)$/m', $readme, 'readme minimum PHP version');
$testedUpTo = aiso_capture('/^Tested up to:\s*(.+)$/m', $readme, 'readme Tested up to');

$expectedStableVersion = '0.5.0';
$historicalReleaseCandidate = '0.4.0';
$expectedTestedWp = '7.1';
$acceptedSource = 'b116ae5df76c7a72ad37ff4e8e80632d6ebb457b';
$acceptedPackageSha = '0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e';
$historicalPackageSha = '27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c';
$releaseMetadata = $plugin . $readme . $repoReadme . $changelog . $security . $phase5b;

$checks = array(
    array($version === $expectedStableVersion, "plugin stable version expected {$expectedStableVersion}, received {$version}"),
    array((bool) preg_match('/^[0-9]+\.[0-9]+\.[0-9]+$/', $version), "plugin Version {$version} is not a stable semantic version"),
    array($constantVersion === $version, "connector constant {$constantVersion} does not match plugin version {$version}"),
    array($stableTag === $version, "readme Stable tag {$stableTag} must match plugin Version {$version} for WordPress.org package correctness"),
    array($readmeRequiresWp === $requiresWp, "readme/plugin WordPress minimum mismatch: {$readmeRequiresWp} vs {$requiresWp}"),
    array($readmeRequiresPhp === $requiresPhp, "readme/plugin PHP minimum mismatch: {$readmeRequiresPhp} vs {$requiresPhp}"),
    array($testedUpTo === $expectedTestedWp, "Tested up to expected {$expectedTestedWp}, received {$testedUpTo}"),
    array(strpos($changelog, '## 0.5.0 — Public GitHub release') !== false, 'CHANGELOG must identify 0.5.0 as the public GitHub release'),
    array(strpos($changelog, '## 0.4.0 — Release candidate') !== false, 'CHANGELOG must retain the historical 0.4.0 release candidate'),
    array(strpos($readme, '= 0.5.0 =') !== false, 'WordPress readme changelog must contain 0.5.0'),
    array(strpos($readme, '= 0.4.0 =') !== false, 'WordPress readme changelog must retain 0.4.0'),
    array(strpos($repoReadme, 'Public GitHub Release `0.5.0`') !== false, 'repository README must describe the current public GitHub release'),
    array(strpos($repoReadme, $acceptedPackageSha) !== false, 'repository README must publish the accepted 0.5.0 package identity'),
    array(strpos($repoReadme, $historicalPackageSha) !== false, 'repository README must retain historical 0.4.0 package identity'),
    array(strpos($security, '`0.5.0` is the current public GitHub Release') !== false, 'SECURITY must identify 0.5.0 as the current public GitHub release'),
    array(strpos($security, $acceptedPackageSha) !== false, 'SECURITY must retain public 0.5.0 package integrity'),
    array(strpos($security, $historicalPackageSha) !== false, 'SECURITY must retain historical 0.4.0 release integrity'),
    array(strpos($phase5b, 'Status: **ACCEPTED') !== false, 'Phase 5B canonical record must be accepted'),
    array(strpos($phase5b, $acceptedSource) !== false, 'Phase 5B canonical record must retain the accepted source commit'),
    array(strpos($phase5b, $acceptedPackageSha) !== false, 'Phase 5B canonical record must retain the accepted package SHA-256'),
    array(strpos($phase5b, 'WordPress.org') !== false, 'Phase 5B canonical record must retain the WordPress.org boundary'),
    array(strpos($releaseMetadata, '0.5.0-dev') === false, 'stale 0.5.0-dev release metadata remains after public release'),
    array(strpos($changelog, '## 0.5.0 — Unreleased') === false, 'public 0.5.0 must not be marked Unreleased'),
    array(strpos($changelog, 'not yet an immutable GitHub Release') === false, 'stale pre-publication GitHub Release claim remains in CHANGELOG'),
    array(strpos($repoReadme, 'Phase 5B must still create') === false, 'stale Phase 5B-next claim remains in README'),
    array(strpos($security, 'It is not yet claimed as an official public GitHub Release') === false, 'stale pre-publication claim remains in SECURITY'),
);

foreach ($checks as $check) {
    if (!$check[0]) {
        fwrite(STDERR, 'FAIL: ' . $check[1] . "\n");
        exit(1);
    }
}

echo "PASS: public GitHub release metadata alignment {$version} with historical RC {$historicalReleaseCandidate}\n";
