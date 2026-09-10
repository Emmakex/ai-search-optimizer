<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$corePath = $root . '/includes/local-core.php';
$publishPath = $root . '/includes/local-publish.php';
$adminPath = $root . '/includes/local-admin.php';

require_once $corePath;
require_once $publishPath;

function publication_fail(string $message): void {
    fwrite(STDERR, "FAIL: {$message}\n");
    exit(1);
}

function publication_assert($condition, string $message): void {
    if (!$condition) {
        publication_fail($message);
    }
}

$inventory = [
    ['id' => 1, 'type' => 'page', 'typeLabel' => 'Pages', 'title' => 'About', 'url' => 'https://example.com/about/', 'description' => 'About'],
    ['id' => 2, 'type' => 'product', 'typeLabel' => 'Products', 'title' => 'Product', 'url' => 'https://example.com/product/item/', 'description' => 'Product'],
    ['id' => 3, 'type' => 'post', 'typeLabel' => 'Posts', 'title' => 'News', 'url' => 'https://example.com/news/', 'description' => 'News'],
];

publication_assert(kairoseth_aiwr_local_inventory_key($inventory[0]) === 'page:1', 'inventory selection key must be stable and site-content based');
$selected = kairoseth_aiwr_local_filter_selected_inventory($inventory, ['post:3', 'page:1', 'unknown:999']);
publication_assert(count($selected) === 2, 'selection must include only resources present in the current inventory');
publication_assert($selected[0]['id'] === 1 && $selected[1]['id'] === 3, 'selected inventory must retain deterministic product ordering');
publication_assert(kairoseth_aiwr_local_filter_selected_inventory($inventory, []) === [], 'an explicit empty selection must remain empty');

$deployment = [
    'revisionSlug' => 'local-test',
    'contentHash' => hash('sha256', 'content'),
    'content' => 'content',
    'updatedAt' => '2026-09-10T09:00:00Z',
    'blogId' => 2,
    'networkId' => 1,
    'homeUrl' => 'https://example.com/',
];
$token = kairoseth_aiwr_local_deployment_token($deployment);
$changed = $deployment;
$changed['content'] = 'changed';
publication_assert($token !== kairoseth_aiwr_local_deployment_token($changed), 'compare-before-write token must change when stored content changes');
publication_assert(kairoseth_aiwr_local_deployment_is_valid($deployment) === true, 'valid stored deployment must pass integrity validation');
publication_assert(kairoseth_aiwr_local_deployment_is_valid($changed) === false, 'tampered stored deployment must fail integrity validation');

$publish = file_get_contents($publishPath);
$admin = file_get_contents($adminPath);
if ($publish === false || $admin === false) {
    publication_fail('cannot read Phase 2B source files');
}

$requiredPublishContracts = [
    'function kairoseth_aiwr_local_filter_selected_inventory($inventory, $selected_keys)',
    'function kairoseth_aiwr_local_deployment_token($deployment)',
    'function kairoseth_aiwr_local_publish_content($content, $expected_state_token, $selected_count = 0)',
    'function kairoseth_aiwr_local_verify_public_content($content, $content_hash)',
    "get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null)",
    'hash_equals($current_token, $expected_state_token)',
    "kairoseth_aiwr_local_validate_llms($content, home_url('/'), KAIROSETH_AIWR_MAX_CONTENT_BYTES)",
    "update_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, $record, false)",
    "'source' => 'local-free'",
    "home_url('/llms.txt')",
    "'redirection' => 0",
    "'limit_response_size' => KAIROSETH_AIWR_MAX_CONTENT_BYTES + 1",
    "hash_equals($content_hash, $public_hash)",
    "'state_changed'",
    "'storage_verification_failed'",
    "'published_unverified'",
];
foreach ($requiredPublishContracts as $needle) {
    publication_assert(strpos($publish, $needle) !== false, "missing publication contract: {$needle}");
}

$requiredAdminContracts = [
    "require_once __DIR__ . '/local-publish.php';",
    "wp_verify_nonce($nonce, 'aiso_local_workflow')",
    "isset(\$_POST['aiso_selection_present'])",
    'name="aiso_selection_present" value="1"',
    'name="aiso_selected[]"',
    'name="aiso_expected_state"',
    'value="preview"',
    'value="publish"',
    'value="verify"',
    'Publishing replaces the currently stored llms.txt only if it has not changed since this page was loaded.',
    'La publicación sustituye el llms.txt guardado solo si no ha cambiado desde que se cargó esta página.',
];
foreach ($requiredAdminContracts as $needle) {
    publication_assert(strpos($admin, $needle) !== false, "missing admin publication contract: {$needle}");
}

$forbidden = [
    'file_put_contents(',
    'fopen(',
    'unlink(',
    'WP_Filesystem',
    'ftp_',
    'ssh2_',
    'OPENAI_API_KEY',
    'ANTHROPIC_API_KEY',
    'GEMINI_API_KEY',
    'wp_remote_post(',
    'wp_remote_request(',
];
foreach ($forbidden as $needle) {
    publication_assert(strpos($publish . "\n" . $admin, $needle) === false, "forbidden Phase 2B pattern: {$needle}");
}

publication_assert(substr_count($publish, "update_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION") === 1, 'Phase 2B must have one bounded local deployment mutation point');
publication_assert(strpos($publish, '$_POST') === false, 'publication core must not consume raw request input directly');

echo "PASS: explicit selection, compare-before-write, bounded publication and public SHA-256 verification contracts\n";
