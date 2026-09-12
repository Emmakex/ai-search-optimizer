<?php

$root = dirname(__DIR__);
$plugin = file_get_contents($root . '/ai-search-optimizer.php');
$readme = file_get_contents($root . '/readme.txt');
$repoReadme = file_get_contents($root . '/README.md');
$changelog = file_get_contents($root . '/CHANGELOG.md');
$security = file_get_contents($root . '/SECURITY.md');
$phase5b = file_get_contents($root . '/docs/PHASE5B_GITHUB_RELEASE.md');
$phase5c2 = file_get_contents($root . '/docs/PHASE5C2_GITHUB_RELEASE.md');

if ($plugin === false || $readme === false || $repoReadme === false || $changelog === false || $security === false || $phase5b === false || $phase5c2 === false) {
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

function aiso_assert($condition, $message) {
    if (!$condition) {
        fwrite(STDERR, 'FAIL: ' . $message . "\n");
        exit(1);
    }
}

$version = aiso_capture('/^ \* Version:\s*(.+)$/m', $plugin, 'plugin Version header');
$constantVersion = aiso_capture("/KAIROSETH_AIWR_CONNECTOR_VERSION\s*=\s*'([^']+)'/", $plugin, 'connector version constant');
$requiresWp = aiso_capture('/^ \* Requires at least:\s*(.+)$/m', $plugin, 'plugin minimum WordPress version');
$requiresPhp = aiso_capture('/^ \* Requires PHP:\s*(.+)$/m', $plugin, 'plugin minimum PHP version');
$stableTag = aiso_capture('/^Stable tag:\s*(.+)$/m', $readme, 'readme Stable tag');
$readmeRequiresWp = aiso_capture('/^Requires at least:\s*(.+)$/m', $readme, 'readme minimum WordPress version');
$readmeRequiresPhp = aiso_capture('/^Requires PHP:\s*(.+)$/m', $readme, 'readme minimum PHP version');
$testedUpTo = aiso_capture('/^Tested up to:\s*(.+)$/m', $readme, 'readme Tested up to');

$currentVersion = '0.5.1';
$currentSource = 'c93ac68c3698fa2c7e003dabc41f72e2e423b5cd';
$currentTree = 'e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b';
$currentSha = '2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b';
$currentReleaseId = '387576797';
$previousSource = 'b116ae5df76c7a72ad37ff4e8e80632d6ebb457b';
$previousSha = '0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e';
$historicalSha = '27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c';

$checks = array(
    array($version === $currentVersion, "plugin stable version expected {$currentVersion}, received {$version}"),
    array((bool) preg_match('/^[0-9]+\.[0-9]+\.[0-9]+$/', $version), "plugin Version {$version} is not stable semantic version"),
    array($constantVersion === $version, "connector constant {$constantVersion} does not match plugin version {$version}"),
    array($stableTag === $version, "readme Stable tag {$stableTag} must match plugin Version {$version}"),
    array($readmeRequiresWp === $requiresWp, 'readme/plugin WordPress minimum mismatch'),
    array($readmeRequiresPhp === $requiresPhp, 'readme/plugin PHP minimum mismatch'),
    array($testedUpTo === '7.1', "Tested up to expected 7.1, received {$testedUpTo}"),
    array(strpos($readme, '= 0.5.1 =') !== false, 'packaged readme must retain 0.5.1 changelog entry'),
    array(strpos($readme, '= 0.5.0 =') !== false, 'packaged readme must retain 0.5.0 changelog entry'),
    array(strpos($repoReadme, 'Public GitHub Release `0.5.1`') !== false, 'README must identify 0.5.1 as current public GitHub release'),
    array(strpos($repoReadme, $currentSource) !== false && strpos($repoReadme, $currentTree) !== false && strpos($repoReadme, $currentSha) !== false, 'README must publish current 0.5.1 source/tree/package identity'),
    array(strpos($repoReadme, $previousSource) !== false && strpos($repoReadme, $previousSha) !== false, 'README must retain 0.5.0 historical identity'),
    array(strpos($repoReadme, $historicalSha) !== false, 'README must retain 0.4.0 historical identity'),
    array(strpos($security, '`0.5.1` is the current public GitHub Release') !== false, 'SECURITY must identify 0.5.1 as current public GitHub release'),
    array(strpos($security, $currentSha) !== false && strpos($security, $previousSha) !== false && strpos($security, $historicalSha) !== false, 'SECURITY must retain current and historical package integrity'),
    array(strpos($changelog, '## 0.5.1 — Public GitHub release') !== false, 'CHANGELOG must identify 0.5.1 as public GitHub release'),
    array(strpos($changelog, '## 0.5.0 — Public GitHub release') !== false, 'CHANGELOG must retain 0.5.0 historical public release'),
    array(strpos($changelog, '## 0.4.0 — Release candidate') !== false, 'CHANGELOG must retain 0.4.0 historical release candidate'),
    array(strpos($phase5b, 'Status: **ACCEPTED') !== false && strpos($phase5b, $previousSource) !== false && strpos($phase5b, $previousSha) !== false, 'Phase 5B record must remain accepted historical 0.5.0 evidence'),
    array(strpos($phase5c2, 'Status: **ACCEPTED') !== false, 'Phase 5C.2 canonical record must be accepted'),
    array(strpos($phase5c2, $currentSource) !== false && strpos($phase5c2, $currentTree) !== false && strpos($phase5c2, $currentSha) !== false, 'Phase 5C.2 record must retain exact current release identity'),
    array(strpos($phase5c2, $currentReleaseId) !== false && strpos($phase5c2, '34695973744') !== false, 'Phase 5C.2 record must retain release ID and publication run'),
    array(strpos($plugin, ' * Plugin URI:') === false, '0.5.1 line must keep Plugin URI absent'),
    array(strpos($plugin, ' * Author URI:') === false, '0.5.1 line must keep Author URI absent'),
    array(strpos($readme, 'not yet claimed as published on WordPress.org or as an official public GitHub Release') === false, 'stale packaged pre-publication sentence remains'),
    array(strpos($repoReadme, 'WordPress.org publication is not yet claimed') === false || strpos($repoReadme, 'not yet claimed as available on WordPress.org') !== false, 'README WordPress.org status must be explicit and truthful'),
);

foreach ($checks as $check) {
    aiso_assert($check[0], $check[1]);
}

echo "PASS: release metadata alignment current={$currentVersion} sha256={$currentSha}; previous=0.5.0; historical=0.4.0; WordPress.org=pending\n";
