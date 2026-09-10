<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$corePath = $root . '/includes/local-core.php';
$adminPath = $root . '/includes/local-admin.php';
$pluginPath = $root . '/ai-search-optimizer.php';

require_once $corePath;

function fail_check(string $message): void {
    fwrite(STDERR, "FAIL: {$message}\n");
    exit(1);
}

function assert_true($condition, string $message): void {
    if (!$condition) {
        fail_check($message);
    }
}

$site = [
    'name' => 'Example Site',
    'description' => 'Public source-grounded content for AI Search.',
    'homeUrl' => 'https://example.com/',
];
$inventory = [
    [
        'id' => 3,
        'type' => 'post',
        'typeLabel' => 'Posts',
        'title' => 'News',
        'url' => 'https://example.com/news/',
        'description' => 'Latest public news.',
    ],
    [
        'id' => 2,
        'type' => 'product',
        'typeLabel' => 'Products',
        'title' => 'Alpha Product',
        'url' => 'https://example.com/product/alpha/',
        'description' => 'Public product information.',
    ],
    [
        'id' => 1,
        'type' => 'page',
        'typeLabel' => 'Pages',
        'title' => 'About',
        'url' => 'https://example.com/about/',
        'description' => 'About this website.',
    ],
];

$first = kairoseth_aiwr_local_build_llms($site, $inventory);
$second = kairoseth_aiwr_local_build_llms($site, array_reverse($inventory));
assert_true($first === $second, 'same public input must produce byte-identical llms.txt regardless of inventory input order');
assert_true(strpos($first, "# Example Site\n") === 0, 'generated llms.txt must start with one H1 site title');
assert_true(strpos($first, 'https://example.com/about/') < strpos($first, 'https://example.com/product/alpha/'), 'pages must sort before products');
assert_true(strpos($first, 'https://example.com/product/alpha/') < strpos($first, 'https://example.com/news/'), 'products must sort before posts');
assert_true(strpos($first, 'Generated at') === false, 'deterministic output must not contain generated timestamps');

$validation = kairoseth_aiwr_local_validate_llms($first, $site['homeUrl']);
assert_true($validation['valid'] === true, 'generated same-site llms.txt must validate');
assert_true($validation['resourceCount'] === 4, 'generated llms.txt must contain homepage plus three public resources');
assert_true($validation['contentHash'] === hash('sha256', $first), 'validator must expose exact SHA-256');

$duplicate = $first . '- [Duplicate](https://example.com/about/)\n';
$duplicateValidation = kairoseth_aiwr_local_validate_llms($duplicate, $site['homeUrl']);
assert_true($duplicateValidation['valid'] === false, 'duplicate local URLs must fail validation');
assert_true(in_array('duplicate_url', array_column($duplicateValidation['findings'], 'code'), true), 'duplicate URL finding must be actionable');

$external = $first . '- [External](https://outside.example.org/page/)\n';
$externalValidation = kairoseth_aiwr_local_validate_llms($external, $site['homeUrl']);
assert_true($externalValidation['valid'] === false, 'external URLs must fail the local source-grounded contract');
assert_true(in_array('external_url', array_column($externalValidation['findings'], 'code'), true), 'external URL finding must be actionable');

$emptyValidation = kairoseth_aiwr_local_validate_llms("# Example Site\n", $site['homeUrl']);
assert_true($emptyValidation['valid'] === false, 'preview with no resources must fail validation');
assert_true(in_array('no_resources', array_column($emptyValidation['findings'], 'code'), true), 'no-resources finding must be actionable');

$core = file_get_contents($corePath);
$admin = file_get_contents($adminPath);
$plugin = file_get_contents($pluginPath);
if ($core === false || $admin === false || $plugin === false) {
    fail_check('cannot read source files for local Free contract checks');
}

$requiredAdminContracts = [
    'function kairoseth_aiwr_local_public_post_types()',
    'function kairoseth_aiwr_local_inventory($limit = 100)',
    'function kairoseth_aiwr_local_readiness()',
    "add_management_page(",
    "KAIROSETH_AIWR_CAPABILITY",
    "'post_status' => 'publish'",
    "'has_password' => false",
    "'suppress_filters' => false",
    'This local analysis does not send site content to Kairoseth, AI providers, or third-party analytics.',
    'Este análisis local no envía contenido del sitio a Kairoseth, proveedores de IA ni analítica de terceros.',
    'WooCommerce is active; public products are eligible for the local inventory.',
    'Este análisis está aislado al sitio actual dentro de la red WordPress.',
];
foreach ($requiredAdminContracts as $needle) {
    assert_true(strpos($admin, $needle) !== false, "missing local Free admin contract: {$needle}");
}

$requiredCoreContracts = [
    'function kairoseth_aiwr_local_build_llms($site, $inventory)',
    'function kairoseth_aiwr_local_validate_llms($content, $home_url, $max_bytes = 524288)',
    "hash('sha256', \$content)",
    "'duplicate_url'",
    "'external_url'",
];
foreach ($requiredCoreContracts as $needle) {
    assert_true(strpos($core, $needle) !== false, "missing local Free core contract: {$needle}");
}

$forbiddenLocalPatterns = [
    'wp_remote_post(',
    'wp_remote_request(',
    'OPENAI_API_KEY',
    'ANTHROPIC_API_KEY',
    'GEMINI_API_KEY',
    'current_time(',
    'gmdate(',
    'microtime(',
    'update_option(',
    'delete_option(',
];
foreach ($forbiddenLocalPatterns as $needle) {
    assert_true(strpos($core . "\n" . $admin, $needle) === false, "Phase 2A local analysis must remain deterministic/read-only: {$needle}");
}

assert_true(strpos($plugin, "require_once __DIR__ . '/includes/local-core.php';") !== false, 'plugin bootstrap must load local core');
assert_true(strpos($plugin, "require_once __DIR__ . '/includes/local-admin.php';") !== false, 'plugin bootstrap must load local admin workspace');

echo "PASS: deterministic account-free local analysis, inventory, preview and validation contracts\n";
