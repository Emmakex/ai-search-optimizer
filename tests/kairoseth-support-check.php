<?php

define('ABSPATH', __DIR__ . '/');
define('KAIROSETH_AIWR_CONNECTOR_VERSION', '0.5.0-dev');

function add_action($hook, $callback) {}
function determine_locale() { return 'es_ES'; }
function get_locale() { return 'en_US'; }
function get_bloginfo($field) { return $field === 'version' ? '7.1' : ''; }
function wp_parse_url($url) { return parse_url($url); }

require dirname(__DIR__) . '/includes/kairoseth-support.php';

function aiso_assert($condition, $message) {
    if (!$condition) {
        fwrite(STDERR, 'FAIL: ' . $message . "\n");
        exit(1);
    }
}

$context = kairoseth_aiso_support_context();
aiso_assert(is_array($context), 'support context must be available for valid versions');
aiso_assert($context === array(
    'source' => 'extension',
    'extensionSlug' => 'ai-search-optimizer',
    'extensionName' => 'AI Search Optimizer',
    'extensionVersion' => '0.5.0-dev',
    'hostPlatform' => 'wordpress',
    'hostPlatformVersion' => '7.1',
    'locale' => 'es',
), 'support context must contain only the bounded canonical fields');

$improve = kairoseth_aiso_support_url('implementation_support');
$custom = kairoseth_aiso_support_url('business_customization');
aiso_assert(strpos($improve, 'https://kairoseth.com/custom-requests?') === 0, 'improve CTA must use canonical Custom Requests destination');
aiso_assert(strpos($custom, 'https://kairoseth.com/custom-requests?') === 0, 'custom CTA must use canonical Custom Requests destination');
aiso_assert(kairoseth_aiso_support_url('admin') === '', 'arbitrary request types must fail closed');

foreach (array($improve, $custom) as $url) {
    $parts = parse_url($url);
    parse_str(isset($parts['query']) ? $parts['query'] : '', $query);
    aiso_assert(isset($parts['scheme']) && $parts['scheme'] === 'https', 'support URL must use HTTPS');
    aiso_assert(isset($parts['host']) && $parts['host'] === 'kairoseth.com', 'support URL must use exact Kairoseth host');
    aiso_assert(isset($parts['path']) && $parts['path'] === '/custom-requests', 'support URL must use exact Custom Requests path');
    aiso_assert(array_keys($query) === array(
        'source',
        'extensionSlug',
        'extensionName',
        'extensionVersion',
        'hostPlatform',
        'hostPlatformVersion',
        'locale',
        'requestType',
    ), 'support URL query must match the exact allow-list');
    foreach (array('siteUrl', 'homeUrl', 'llmsTxt', 'contentHash', 'username', 'email', 'token', 'credential', 'woocommerce') as $forbidden) {
        aiso_assert(!array_key_exists($forbidden, $query), 'forbidden automatic context leaked: ' . $forbidden);
    }
}

aiso_assert(kairoseth_aiso_support_canonical_destination('http://kairoseth.com/custom-requests') === '', 'HTTP destination must fail closed');
aiso_assert(kairoseth_aiso_support_canonical_destination('https://evil.example/custom-requests') === '', 'foreign host must fail closed');
aiso_assert(kairoseth_aiso_support_canonical_destination('https://kairoseth.com.evil.example/custom-requests') === '', 'lookalike host must fail closed');
aiso_assert(kairoseth_aiso_support_canonical_destination('https://kairoseth.com/app') === '', 'wrong path must fail closed');
aiso_assert(kairoseth_aiso_support_canonical_destination('https://user@kairoseth.com/custom-requests') === '', 'userinfo must fail closed');
aiso_assert(kairoseth_aiso_support_canonical_destination('https://kairoseth.com:444/custom-requests') === '', 'custom port must fail closed');
aiso_assert(kairoseth_aiso_support_canonical_destination('https://kairoseth.com/custom-requests?x=1') === '', 'preloaded query must fail closed');
aiso_assert(kairoseth_aiso_support_canonical_destination('https://kairoseth.com/custom-requests#x') === '', 'fragment must fail closed');

$source = file_get_contents(dirname(__DIR__) . '/includes/kairoseth-support.php');
aiso_assert($source !== false, 'support source must be readable');
aiso_assert(strpos($source, "'manage_options'") !== false, 'support page must require administrator capability');
aiso_assert(strpos($source, 'wp_remote_') === false, 'support page load must not make WordPress HTTP requests');
aiso_assert(strpos($source, 'curl_') === false, 'support page load must not make cURL requests');
aiso_assert(strpos($source, 'update_option(') === false && strpos($source, 'add_option(') === false, 'support bridge must not persist cloud/support state');
aiso_assert(strpos($source, 'No se envía nada a Kairoseth cuando cargas esta página de WordPress.') !== false, 'Spanish no-network disclosure is missing');
aiso_assert(strpos($source, 'Nothing is sent to Kairoseth when this WordPress page loads.') !== false, 'English no-network disclosure is missing');
aiso_assert(strpos($source, 'Mejorar con Kairoseth') !== false && strpos($source, 'Improve with Kairoseth') !== false, 'EN/ES improvement CTA is missing');
aiso_assert(strpos($source, 'Solicitar desarrollo a medida') !== false && strpos($source, 'Request custom development') !== false, 'EN/ES custom-development CTA is missing');
aiso_assert(strpos($source, 'target="_blank" rel="noopener noreferrer"') !== false, 'external CTAs must use noopener/noreferrer');

echo "PASS: privacy-bounded Kairoseth support/custom-request contract\n";
