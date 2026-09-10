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

$expectedDevelopmentVersion = '0.5.0-dev';
$acceptedReleaseCandidate = '0.4.0';
$expectedTestedWp = '7.1';

$checks = array(
    array($version === $expectedDevelopmentVersion, "plugin development version expected {$expectedDevelopmentVersion}, received {$version}"),
    array($constantVersion === $version, "connector constant {$constantVersion} does not match plugin version {$version}"),
    array($stableTag === $acceptedReleaseCandidate, "readme Stable tag must preserve accepted 0.4.0 boundary, received {$stableTag}"),
    array($readmeRequiresWp === $requiresWp, "readme/plugin WordPress minimum mismatch: {$readmeRequiresWp} vs {$requiresWp}"),
    array($readmeRequiresPhp === $requiresPhp, "readme/plugin PHP minimum mismatch: {$readmeRequiresPhp} vs {$requiresPhp}"),
    array($testedUpTo === $expectedTestedWp, "Tested up to expected {$expectedTestedWp}, received {$testedUpTo}"),
    array(strpos($changelog, '## 0.5.0-dev — Unreleased') !== false, 'CHANGELOG must identify the Phase 3 development line'),
    array(strpos($changelog, '## 0.4.0 — Release candidate') !== false, 'CHANGELOG must retain the accepted 0.4.0 release candidate'),
    array(strpos($readme, '= 0.5.0-dev =') !== false, 'WordPress readme changelog must contain the development line'),
    array(strpos($readme, '= 0.4.0 =') !== false, 'WordPress readme changelog must retain 0.4.0'),
    array(strpos($repoReadme, '0.5.0-dev') !== false, 'repository README must describe the current development line'),
    array(strpos($repoReadme, '27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c') !== false, 'repository README must retain accepted 0.4.0 package identity'),
    array(strpos($security, '0.4.0') !== false && strpos($security, '0.5.0-dev') !== false, 'SECURITY must distinguish accepted RC and current development line'),
    array(strpos($changelog, '## 0.4.0 — Unreleased') === false, 'accepted 0.4.0 must not regress to Unreleased'),
    array(strpos($changelog, 'Phase 2C release hardening remains in progress') === false, 'stale Phase 2C in-progress claim remains in CHANGELOG'),
);

foreach ($checks as $check) {
    if (!$check[0]) {
        fwrite(STDERR, 'FAIL: ' . $check[1] . "\n");
        exit(1);
    }
}

echo "PASS: development/release metadata alignment {$version} with accepted RC {$acceptedReleaseCandidate}\n";
