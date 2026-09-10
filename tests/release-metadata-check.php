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

$expectedVersion = '0.4.0';
$expectedTestedWp = '7.1';

$checks = array(
    array($version === $expectedVersion, "plugin version expected {$expectedVersion}, received {$version}"),
    array($constantVersion === $version, "connector constant {$constantVersion} does not match plugin version {$version}"),
    array($stableTag === $version, "readme Stable tag {$stableTag} does not match plugin version {$version}"),
    array($readmeRequiresWp === $requiresWp, "readme/plugin WordPress minimum mismatch: {$readmeRequiresWp} vs {$requiresWp}"),
    array($readmeRequiresPhp === $requiresPhp, "readme/plugin PHP minimum mismatch: {$readmeRequiresPhp} vs {$requiresPhp}"),
    array($testedUpTo === $expectedTestedWp, "Tested up to expected {$expectedTestedWp}, received {$testedUpTo}"),
    array(strpos($changelog, '## 0.4.0 — Release candidate') !== false, 'CHANGELOG must identify 0.4.0 as the release candidate'),
    array(strpos($readme, '= 0.4.0 =') !== false, 'WordPress readme changelog must contain 0.4.0'),
    array(strpos($repoReadme, 'Release candidate') !== false, 'repository README must describe release-candidate status'),
    array(strpos($security, '0.4.0') !== false, 'SECURITY must describe the 0.4.0 support boundary'),
    array(strpos($readme, '0.4.0 is still unreleased while release hardening is completed') === false, 'stale pre-2C4 installation copy remains in readme.txt'),
    array(strpos($changelog, '## 0.4.0 — Unreleased') === false, 'stale Unreleased heading remains in CHANGELOG'),
    array(strpos($changelog, 'Phase 2C release hardening remains in progress') === false, 'stale Phase 2C in-progress claim remains in CHANGELOG'),
);

foreach ($checks as $check) {
    if (!$check[0]) {
        fwrite(STDERR, 'FAIL: ' . $check[1] . "\n");
        exit(1);
    }
}

echo "PASS: release metadata alignment {$version}\n";
