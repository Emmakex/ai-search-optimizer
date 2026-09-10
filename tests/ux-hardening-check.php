<?php

$root = dirname(__DIR__);
$admin = file_get_contents($root . '/includes/local-admin.php');
$lifecycle = file_get_contents($root . '/includes/local-lifecycle.php');
$assets = file_get_contents($root . '/includes/local-admin-assets.php');

if ($admin === false || $lifecycle === false || $assets === false) {
    fwrite(STDERR, "Could not read UX hardening sources.\n");
    exit(1);
}

$assertions = array(
    array($admin, "aria-label=\"<?php echo esc_attr(kairoseth_aiwr_local_text('include')", 'resource checkboxes expose accessible labels'),
    array($admin, 'textarea readonly aria-label=', 'llms.txt preview has an accessible name'),
    array($admin, 'name="aiso_action" value="publish"', 'publish action remains a native named button'),
    array($admin, 'name="aiso_action" value="verify"', 'verify action remains a native named button'),
    array($lifecycle, '<label><input type="radio" name="aiso_uninstall_mode" value="preserve"', 'preserve retention radio is associated with visible label text'),
    array($lifecycle, '<label><input type="radio" name="aiso_uninstall_mode" value="delete"', 'delete retention radio is associated with visible label text'),
    array($lifecycle, "require_once __DIR__ . '/local-admin-assets.php';", 'lifecycle loads shared admin hardening assets'),
    array($assets, "max-width: 782px", 'WordPress mobile admin breakpoint is hardened'),
    array($assets, 'overflow-x: auto', 'wide inventory table is contained instead of overflowing the page'),
    array($assets, 'min-height: 44px', 'primary mobile controls meet a touch-friendly minimum height'),
    array($assets, ':focus-visible', 'keyboard focus receives a visible treatment'),
    array($assets, 'overflow-wrap: anywhere', 'long URLs and hashes can wrap'),
    array($assets, "admin_head-tools_page_ai-search-optimizer", 'main workflow receives targeted hardening styles'),
    array($assets, "admin_head-tools_page_ai-search-optimizer-data", 'data lifecycle page receives targeted hardening styles'),
);

foreach ($assertions as $assertion) {
    list($haystack, $needle, $description) = $assertion;
    if (strpos($haystack, $needle) === false) {
        fwrite(STDERR, "FAIL: {$description}\nExpected source marker: {$needle}\n");
        exit(1);
    }
}

if (strpos($assets, '@media') === false) {
    fwrite(STDERR, "FAIL: responsive CSS media query missing.\n");
    exit(1);
}

if (preg_match('/outline\s*:\s*none/i', $assets)) {
    fwrite(STDERR, "FAIL: hardening CSS must not remove focus outlines.\n");
    exit(1);
}

echo "PASS: responsive/accessibility source contract\n";
