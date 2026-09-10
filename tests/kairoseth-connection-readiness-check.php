<?php

$root = dirname(__DIR__);
$plugin = file_get_contents($root . '/ai-search-optimizer.php');
$module = file_get_contents($root . '/includes/kairoseth-connection-readiness.php');

if ($plugin === false || $module === false) {
    fwrite(STDERR, "FAIL: could not read Phase 3A sources.\n");
    exit(1);
}

$checks = array(
    array(strpos($plugin, "Version: 0.5.0-dev") !== false, 'Phase 3 development must not reuse accepted 0.4.0 version'),
    array(strpos($plugin, "KAIROSETH_AIWR_CONNECTOR_VERSION = '0.5.0-dev'") !== false, 'connector version constant must follow the development line'),
    array(strpos($plugin, "KAIROSETH_AIWR_SCHEMA_VERSION = '2'") !== false, 'accepted connector schema 2 changed unexpectedly'),
    array(strpos($plugin, "'kairoseth-ai-web-readiness/v1'") !== false, 'accepted REST namespace changed unexpectedly'),
    array(strpos($plugin, "'/connection'") !== false, 'accepted connection endpoint changed unexpectedly'),
    array(strpos($plugin, "'/deployment'") !== false, 'accepted deployment endpoint changed unexpectedly'),
    array(strpos($plugin, "require_once __DIR__ . '/includes/kairoseth-connection-readiness.php';") !== false, 'Phase 3A module is not loaded'),
    array(strpos($module, "const KAIROSETH_AISO_PLATFORM_APP_URL = 'https://kairoseth.com/app';") !== false, 'handoff URL must be the canonical app root without site data'),
    array(strpos($module, 'wp_is_application_passwords_available') !== false, 'Application Password readiness is not checked'),
    array(strpos($module, 'kairoseth_aiwr_site_identity()') !== false, 'exact WordPress site identity is not reused'),
    array(strpos($module, "trailingslashit(\$identity['restUrl']) . 'connection'") !== false, 'connection readiness must expose the inherited exact connection endpoint'),
    array(strpos($module, "get_role(KAIROSETH_AIWR_DEPLOYER_ROLE)") !== false, 'least-privilege deployer role readiness is not checked'),
    array(strpos($module, "has_cap(KAIROSETH_AIWR_CAPABILITY)") !== false, 'dedicated deployment capability readiness is not checked'),
    array(strpos($module, "'ai-search-optimizer-kairoseth'") !== false, 'connection readiness admin page slug is missing'),
    array(strpos($module, 'This readiness page makes no request to Kairoseth') !== false, 'English no-transmission disclosure is missing'),
    array(strpos($module, 'Esta comprobación no hace ninguna petición a Kairoseth') !== false, 'Spanish no-transmission disclosure is missing'),
    array(strpos($module, 'The handoff URL contains no site identifier') !== false, 'English handoff privacy disclosure is missing'),
    array(strpos($module, 'La URL de acceso no contiene identificador del sitio') !== false, 'Spanish handoff privacy disclosure is missing'),
    array(strpos($module, 'target="_blank" rel="noopener noreferrer"') !== false, 'external handoff must use noopener/noreferrer'),
    array(strpos($module, 'update_option(') === false, 'Phase 3A readiness must not persist cloud/connection state'),
    array(strpos($module, 'add_option(') === false, 'Phase 3A readiness must not create cloud/connection state'),
    array(strpos($module, 'wp_remote_') === false, 'Phase 3A readiness must not make automatic WordPress HTTP requests'),
    array(strpos($module, 'curl_') === false, 'Phase 3A readiness must not make automatic cURL requests'),
    array(strpos($module, 'type="password"') === false, 'Phase 3A must not render a password input'),
    array(strpos($module, 'name="applicationPassword"') === false && strpos($module, 'name="application_password"') === false, 'Phase 3A must not collect an Application Password field'),
    array(strpos($module, "\$_POST['application") === false && strpos($module, "\$_REQUEST['application") === false, 'Phase 3A must not read an Application Password from request data'),
    array(strpos($module, 'access_token') === false && strpos($module, 'refresh_token') === false, 'Phase 3A must not introduce cloud token storage'),
);

if (preg_match("/KAIROSETH_AISO_PLATFORM_APP_URL\\s*=\\s*'([^']+)'/", $module, $matches)) {
    $checks[] = array(strpos($matches[1], '?') === false && strpos($matches[1], '#') === false, 'handoff URL must not carry query or fragment data');
} else {
    $checks[] = array(false, 'handoff URL constant could not be parsed');
}

foreach ($checks as $check) {
    if (!$check[0]) {
        fwrite(STDERR, 'FAIL: ' . $check[1] . "\n");
        exit(1);
    }
}

echo "PASS: Phase 3A optional Kairoseth connection readiness contract\n";
