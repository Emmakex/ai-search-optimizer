<?php

$root = dirname(__DIR__);
$plugin = file_get_contents($root . '/ai-search-optimizer.php');
$module = file_get_contents($root . '/includes/contextual-support.php');
$shim = file_get_contents($root . '/includes/kairoseth-connection-readiness.php');

if ($plugin === false || $module === false || $shim === false) {
    fwrite(STDERR, "FAIL: could not read contextual support sources.\n");
    exit(1);
}

$checks = array(
    array(strpos($plugin, 'Version: 0.5.0-dev') !== false, 'development version identity changed unexpectedly'),
    array(strpos($shim, "require_once __DIR__ . '/contextual-support.php';") !== false, 'legacy Phase 3A file must be a compatibility shim only'),
    array(strpos($module, "KAIROSETH_AISO_CUSTOM_REQUESTS_URL = 'https://kairoseth.com/custom-requests'") !== false, 'canonical Kairoseth custom request destination is missing'),
    array(strpos($module, "'extensionSlug' => 'ai-search-optimizer'") !== false, 'extension slug must be server-owned'),
    array(strpos($module, "'extensionName' => 'AI Search Optimizer'") !== false, 'extension name must be server-owned'),
    array(strpos($module, "'hostPlatform' => 'wordpress'") !== false, 'host platform must be server-owned'),
    array(strpos($module, "array('implementation_support', 'business_customization')") !== false, 'request type allow-list changed unexpectedly'),
    array(strpos($module, "'requestType'") !== false, 'bounded request type context is missing'),
    array(strpos($module, "PHP_QUERY_RFC3986") !== false, 'support URL query must use RFC3986 encoding'),
    array(strpos($module, "'ai-search-optimizer-support'") !== false, 'support Tools page slug is missing'),
    array(strpos($module, "'manage_options'") !== false, 'support page must require administrator authority'),
    array(strpos($module, 'Nothing is sent to Kairoseth when this WordPress page loads.') !== false, 'English local-first disclosure is missing'),
    array(strpos($module, 'No se envía nada a Kairoseth al cargar esta página de WordPress.') !== false, 'Spanish local-first disclosure is missing'),
    array(strpos($module, 'Request a custom improvement') !== false, 'English custom-improvement CTA is missing'),
    array(strpos($module, 'Solicitar una mejora a medida') !== false, 'Spanish custom-improvement CTA is missing'),
    array(strpos($module, 'target="_blank" rel="noopener noreferrer"') !== false, 'external CTA must use noopener/noreferrer'),
    array(strpos($module, 'wp_remote_') === false, 'support page must not call external services automatically'),
    array(strpos($module, 'curl_') === false, 'support page must not call external services through cURL'),
    array(strpos($module, 'update_option(') === false, 'support page must not persist Kairoseth state'),
    array(strpos($module, 'add_option(') === false, 'support page must not create Kairoseth state'),
    array(strpos($module, 'home_url(') === false, 'site URL must not be added to support context'),
    array(strpos($module, 'site_url(') === false, 'site URL must not be added to support context'),
    array(strpos($module, 'kairoseth_aiwr_site_identity') === false, 'site identity must not be added to support context'),
    array(strpos($module, 'get_current_user_id') === false && strpos($module, 'wp_get_current_user') === false, 'administrator identity must not be added to support context'),
    array(strpos($module, 'applicationPassword') === false && strpos($module, 'application_password') === false, 'Application Password must not be collected or transmitted by support CTA'),
    array(strpos($module, 'llms.txt content') !== false, 'privacy copy must explicitly mention llms.txt content is not attached'),
    array(strpos($module, '\$_POST') === false && strpos($module, '\$_REQUEST') === false, 'support page must not submit or process a lead inside WordPress'),
);

foreach ($checks as $check) {
    if (!$check[0]) {
        fwrite(STDERR, 'FAIL: ' . $check[1] . "\n");
        exit(1);
    }
}

echo "PASS: WordPress.org-first contextual support/custom-improvement contract\n";
