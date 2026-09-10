<?php

declare(strict_types=1);

$sourcePath = dirname(__DIR__) . '/ai-search-optimizer.php';
$source = file_get_contents($sourcePath);

if ($source === false) {
    fwrite(STDERR, "FAIL: cannot read ai-search-optimizer.php\n");
    exit(1);
}

$required = [
    'Plugin Name: AI Search Optimizer',
    'License: MIT',
    'Text Domain: ai-search-optimizer',
    'const KAIROSETH_AIWR_CONNECTOR_VERSION =',
    "const KAIROSETH_AIWR_SCHEMA_VERSION = '2';",
    "const KAIROSETH_AIWR_CAPABILITY = 'kairoseth_ai_web_readiness_deploy';",
    "const KAIROSETH_AIWR_DEPLOYER_ROLE = 'kairoseth_ai_web_deployer';",
    "const KAIROSETH_AIWR_DEPLOYMENT_OPTION = 'kairoseth_ai_web_readiness_deployment';",
    "rest_url('kairoseth-ai-web-readiness/v1')",
    "register_rest_route(\n        'kairoseth-ai-web-readiness/v1'",
    "'plugin' => 'kairoseth-ai-web-readiness'",
    "'^llms\\\\.txt$'",
    'KAIROSETH_AIWR_MAX_CONTENT_BYTES = 524288',
    "hash('sha256', \$content)",
    'hash_equals($content_hash, $actual_hash)',
    "'kairoseth_aiwr_remote_state_changed'",
    "'expectedBlogId'",
    "'expectedNetworkId'",
    "'expectedHomeUrl'",
    "'expectedCurrentDeployed'",
    "'expectedCurrentContentHash'",
];

$failures = [];
foreach ($required as $needle) {
    if (strpos($source, $needle) === false) {
        $failures[] = "missing required contract: {$needle}";
    }
}

if (!preg_match('/^ \* Version:\s*\S+$/m', $source)) {
    $failures[] = 'plugin Version header is missing or empty';
}

if (!preg_match("/const KAIROSETH_AIWR_CONNECTOR_VERSION = '[^']+';/", $source)) {
    $failures[] = 'connector version constant is missing or empty';
}

$guard = <<<'PHP'
$site = $multisite && function_exists('get_site')
        ? get_site($blog_id)
        : null;
PHP;
if (strpos($source, $guard) === false) {
    $failures[] = 'single-site regression guard is missing: get_site() must remain Multisite-gated';
}

$forbidden = [
    'OPENAI_API_KEY',
    'ANTHROPIC_API_KEY',
    'GEMINI_API_KEY',
    'CREDENTIALS_KEY_HEX',
    'file_put_contents(',
    'fopen(',
    'unlink(',
    'WP_Filesystem',
    'ftp_',
    'ssh2_',
];

foreach ($forbidden as $needle) {
    if (strpos($source, $needle) !== false) {
        $failures[] = "forbidden distributed-code pattern: {$needle}";
    }
}

if (substr_count($source, "register_rest_route(") !== 2) {
    $failures[] = 'unexpected REST route registration count; expected exactly two route declarations';
}

if (strpos($source, "'permission_callback' => 'kairoseth_aiwr_permission_check'") === false) {
    $failures[] = 'REST permission callback is missing';
}

if ($failures !== []) {
    foreach ($failures as $failure) {
        fwrite(STDERR, "FAIL: {$failure}\n");
    }
    exit(1);
}

echo "PASS: AI Search Optimizer standalone compatibility/security contracts\n";
