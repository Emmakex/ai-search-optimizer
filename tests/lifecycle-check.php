<?php

declare(strict_types=1);

$root = dirname(__DIR__);
$lifecyclePath = $root . '/includes/local-lifecycle.php';
$uninstallPath = $root . '/uninstall.php';
$pluginPath = $root . '/ai-search-optimizer.php';

if (!defined('ABSPATH')) {
    define('ABSPATH', $root . '/');
}

require_once $lifecyclePath;

function lifecycle_fail(string $message): void {
    fwrite(STDERR, "FAIL: {$message}\n");
    exit(1);
}

function lifecycle_assert($condition, string $message): void {
    if (!$condition) {
        lifecycle_fail($message);
    }
}

$normalizePhpLayout = static function (string $value): string {
    return preg_replace('/\s+/', '', $value) ?? '';
};

lifecycle_assert(kairoseth_aiwr_local_normalize_uninstall_mode('delete') === 'delete', 'delete mode must be accepted');
lifecycle_assert(kairoseth_aiwr_local_normalize_uninstall_mode('preserve') === 'preserve', 'preserve mode must be accepted');
lifecycle_assert(kairoseth_aiwr_local_normalize_uninstall_mode('anything-else') === 'preserve', 'unknown mode must fail safe to preserve');
lifecycle_assert(kairoseth_aiwr_local_uninstall_option_name() === 'kairoseth_ai_web_readiness_uninstall_mode', 'retention option name must remain stable');

$lifecycle = file_get_contents($lifecyclePath);
$uninstall = file_get_contents($uninstallPath);
$plugin = file_get_contents($pluginPath);
if ($lifecycle === false || $uninstall === false || $plugin === false) {
    lifecycle_fail('cannot read lifecycle source files');
}

$normalizedLifecycle = $normalizePhpLayout($lifecycle);
$normalizedUninstall = $normalizePhpLayout($uninstall);
$normalizedPlugin = $normalizePhpLayout($plugin);

$requiredLifecycle = array(
    "get_option(kairoseth_aiwr_local_uninstall_option_name(), 'preserve')",
    "wp_verify_nonce(\$nonce, 'aiso_retention_settings')",
    "update_option(kairoseth_aiwr_local_uninstall_option_name(), \$mode, false)",
    "value=\"preserve\"",
    "value=\"delete\"",
    'Preserve published llms.txt data',
    'Conservar los datos publicados de llms.txt',
    'Deactivation does not delete the stored llms.txt deployment',
    'La desactivación no elimina el despliegue llms.txt guardado',
);
foreach ($requiredLifecycle as $needle) {
    lifecycle_assert(strpos($normalizedLifecycle, $normalizePhpLayout($needle)) !== false, "missing lifecycle contract: {$needle}");
}

$requiredUninstall = array(
    "if (!defined('WP_UNINSTALL_PLUGIN'))",
    "const KAIROSETH_AISO_UNINSTALL_CAPABILITY = 'kairoseth_ai_web_readiness_deploy';",
    "const KAIROSETH_AISO_UNINSTALL_ROLE = 'kairoseth_ai_web_deployer';",
    "const KAIROSETH_AISO_UNINSTALL_DEPLOYMENT_OPTION = 'kairoseth_ai_web_readiness_deployment';",
    "const KAIROSETH_AISO_UNINSTALL_SETUP_OPTION = 'kairoseth_ai_web_readiness_setup_version';",
    "const KAIROSETH_AISO_UNINSTALL_MODE_OPTION = 'kairoseth_ai_web_readiness_uninstall_mode';",
    "\$administrator->remove_cap(KAIROSETH_AISO_UNINSTALL_CAPABILITY)",
    "'role' => KAIROSETH_AISO_UNINSTALL_ROLE",
    "\$user->remove_role(KAIROSETH_AISO_UNINSTALL_ROLE)",
    'remove_role(KAIROSETH_AISO_UNINSTALL_ROLE)',
    'delete_option(KAIROSETH_AISO_UNINSTALL_SETUP_OPTION)',
    'delete_option(KAIROSETH_AISO_UNINSTALL_MODE_OPTION)',
    "if (\$mode === 'delete')",
    'delete_option(KAIROSETH_AISO_UNINSTALL_DEPLOYMENT_OPTION)',
    'is_multisite()',
    "'fields' => 'ids'",
    'switch_to_blog((int) $kairoseth_aiso_site_id)',
    'restore_current_blog()',
);
foreach ($requiredUninstall as $needle) {
    lifecycle_assert(strpos($normalizedUninstall, $normalizePhpLayout($needle)) !== false, "missing uninstall contract: {$needle}");
}

lifecycle_assert(substr_count($normalizedUninstall, $normalizePhpLayout('delete_option(KAIROSETH_AISO_UNINSTALL_DEPLOYMENT_OPTION)')) === 1, 'deployment deletion must have one bounded uninstall point');
lifecycle_assert(strpos($uninstall, 'delete_site_option(') === false, 'site-local data must not be deleted through a network-global option API');
lifecycle_assert(strpos($uninstall, 'wp_remote_') === false, 'uninstall must not make remote requests');
lifecycle_assert(strpos($uninstall, 'file_put_contents(') === false, 'uninstall must not mutate arbitrary filesystem paths');

$deactivateStart = strpos($normalizedPlugin, $normalizePhpLayout('function kairoseth_aiwr_deactivate('));
$deactivateEnd = strpos($normalizedPlugin, $normalizePhpLayout("register_deactivation_hook(__FILE__, 'kairoseth_aiwr_deactivate');"));
lifecycle_assert($deactivateStart !== false && $deactivateEnd !== false && $deactivateEnd > $deactivateStart, 'deactivation block must exist');
$deactivateBlock = substr($normalizedPlugin, $deactivateStart, $deactivateEnd - $deactivateStart);
lifecycle_assert(strpos($deactivateBlock, 'KAIROSETH_AIWR_DEPLOYMENT_OPTION') === false, 'deactivation must preserve stored llms.txt deployment data');
lifecycle_assert(strpos($deactivateBlock, 'kairoseth_ai_web_readiness_uninstall_mode') === false, 'deactivation must preserve uninstall retention preference');

echo "PASS: lifecycle retention, safe deactivation and bounded single-site/Multisite uninstall contracts\n";
