<?php

$root = dirname(__DIR__);
$plugin = file_get_contents($root . '/ai-search-optimizer.php');
$readme = file_get_contents($root . '/readme.txt');
$repoReadme = file_get_contents($root . '/README.md');
$changelog = file_get_contents($root . '/CHANGELOG.md');
$security = file_get_contents($root . '/SECURITY.md');

if ($plugin === false || $readme === false || $repoReadme === false || $changelog === false || $security === false) {
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
$releaseMetadata = $plugin . $readme . $repoReadme . $changelog . $security;

$checks = array(
    array($version === $expectedStableVersion, "plugin stable version expected {$expectedStableVersion}, received {$version}"),
    array((bool) preg_match('/^[0-9]+\.[0-9]+\.[0-9]+$/', $version), "plugin Version {$version} is not a stable semantic version"),
    array($constantVersion === $version, "connector constant {$constantVersion} does not match plugin version {$version}"),
    array($stableTag === $version, "readme Stable tag {$stableTag} must match plugin Version {$version} for WordPress.org package correctness"),
    array($readmeRequiresWp === $requiresWp, "readme/plugin WordPress minimum mismatch: {$readmeRequiresWp} vs {$requiresWp}"),
    array($readmeRequiresPhp === $requiresPhp, "readme/plugin PHP minimum mismatch: {$readmeRequiresPhp} vs {$requiresPhp}"),
    array($testedUpTo === $expectedTestedWp, "Tested up to expected {$expectedTestedWp}, received {$testedUpTo}"),
    array(strpos($changelog, '## 0.5.0 — Stable candidate') !== false, 'CHANGELOG must identify 0.5.0 as the stable candidate'),
    array(strpos($changelog, '## 0.4.0 — Release candidate') !== false, 'CHANGELOG must retain the historical 0.4.0 release candidate'),
    array(strpos($readme, '= 0.5.0 =') !== false, 'WordPress readme changelog must contain the stable candidate'),
    array(strpos($readme, '= 0.4.0 =') !== false, 'WordPress readme changelog must retain 0.4.0'),
    array(strpos($repoReadme, 'Stable candidate `0.5.0`') !== false, 'repository README must describe the current stable candidate'),
    array(strpos($repoReadme, '27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c') !== false, 'repository README must retain historical 0.4.0 package identity'),
    array(strpos($security, '`0.5.0` is the current stable candidate') !== false, 'SECURITY must identify 0.5.0 as the current stable candidate'),
    array(strpos($security, '0.4.0') !== false, 'SECURITY must retain historical 0.4.0 release integrity'),
    array(strpos($releaseMetadata, '0.5.0-dev') === false, 'stale 0.5.0-dev release metadata remains after stable promotion'),
    array(strpos($changelog, '## 0.5.0 — Unreleased') === false, 'stable 0.5.0 must not be marked Unreleased'),
    array(strpos($changelog, '## 0.4.0 — Unreleased') === false, 'historical 0.4.0 must not regress to Unreleased'),
    array(strpos($changelog, 'Phase 2C release hardening remains in progress') === false, 'stale Phase 2C in-progress claim remains in CHANGELOG'),
);

foreach ($checks as $check) {
    if (!$check[0]) {
        fwrite(STDERR, 'FAIL: ' . $check[1] . "\n");
        exit(1);
    }
}

echo "PASS: stable release metadata alignment {$version} with historical RC {$historicalReleaseCandidate}\n";
