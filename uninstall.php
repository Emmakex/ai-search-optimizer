<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

const AISO_UNINSTALL_CAPABILITY = 'kairoseth_ai_web_readiness_deploy';
const AISO_UNINSTALL_ROLE = 'kairoseth_ai_web_deployer';
const AISO_UNINSTALL_DEPLOYMENT_OPTION = 'kairoseth_ai_web_readiness_deployment';
const AISO_UNINSTALL_SETUP_OPTION = 'kairoseth_ai_web_readiness_setup_version';
const AISO_UNINSTALL_MODE_OPTION = 'kairoseth_ai_web_readiness_uninstall_mode';

function aiso_uninstall_current_site() {
    $mode = get_option(AISO_UNINSTALL_MODE_OPTION, 'preserve');
    $mode = $mode === 'delete' ? 'delete' : 'preserve';

    $administrator = get_role('administrator');
    if ($administrator && $administrator->has_cap(AISO_UNINSTALL_CAPABILITY)) {
        $administrator->remove_cap(AISO_UNINSTALL_CAPABILITY);
    }

    $deployer_users = get_users(array(
        'role' => AISO_UNINSTALL_ROLE,
        'fields' => 'ids',
    ));
    foreach ((array) $deployer_users as $user_id) {
        $user = new WP_User((int) $user_id);
        $user->remove_role(AISO_UNINSTALL_ROLE);
    }
    remove_role(AISO_UNINSTALL_ROLE);

    delete_option(AISO_UNINSTALL_SETUP_OPTION);
    delete_option(AISO_UNINSTALL_MODE_OPTION);

    if ($mode === 'delete') {
        delete_option(AISO_UNINSTALL_DEPLOYMENT_OPTION);
    }
}

if (is_multisite()) {
    $site_ids = get_sites(array(
        'fields' => 'ids',
        'number' => 0,
        'spam' => 0,
        'deleted' => 0,
        'archived' => 0,
    ));
    foreach ((array) $site_ids as $site_id) {
        switch_to_blog((int) $site_id);
        aiso_uninstall_current_site();
        restore_current_blog();
    }
} else {
    aiso_uninstall_current_site();
}
