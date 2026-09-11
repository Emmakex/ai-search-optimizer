<?php
/**
 * Plugin uninstall and retention cleanup.
 *
 * @package AI_Search_Optimizer
 */


if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

const KAIROSETH_AISO_UNINSTALL_CAPABILITY        = 'kairoseth_ai_web_readiness_deploy';
const KAIROSETH_AISO_UNINSTALL_ROLE              = 'kairoseth_ai_web_deployer';
const KAIROSETH_AISO_UNINSTALL_DEPLOYMENT_OPTION = 'kairoseth_ai_web_readiness_deployment';
const KAIROSETH_AISO_UNINSTALL_SETUP_OPTION      = 'kairoseth_ai_web_readiness_setup_version';
const KAIROSETH_AISO_UNINSTALL_MODE_OPTION       = 'kairoseth_ai_web_readiness_uninstall_mode';

/**
 * Provides the uninstall current site operation.
 */
function kairoseth_aiso_uninstall_current_site() {
	$mode = get_option( KAIROSETH_AISO_UNINSTALL_MODE_OPTION, 'preserve' );
	$mode = 'delete' === $mode ? 'delete' : 'preserve';

	$administrator = get_role( 'administrator' );
	if ( $administrator && $administrator->has_cap( KAIROSETH_AISO_UNINSTALL_CAPABILITY ) ) {
		$administrator->remove_cap( KAIROSETH_AISO_UNINSTALL_CAPABILITY );
	}

	$deployer_users = get_users(
		array(
			'role'   => KAIROSETH_AISO_UNINSTALL_ROLE,
			'fields' => 'ids',
		)
	);
	foreach ( (array) $deployer_users as $user_id ) {
		$user = new WP_User( (int) $user_id );
		$user->remove_role( KAIROSETH_AISO_UNINSTALL_ROLE );
	}
	remove_role( KAIROSETH_AISO_UNINSTALL_ROLE );

	delete_option( KAIROSETH_AISO_UNINSTALL_SETUP_OPTION );
	delete_option( KAIROSETH_AISO_UNINSTALL_MODE_OPTION );

	if ( 'delete' === $mode ) {
		delete_option( KAIROSETH_AISO_UNINSTALL_DEPLOYMENT_OPTION );
	}
}

if ( is_multisite() ) {
	$kairoseth_aiso_site_ids = get_sites(
		array(
			'fields'   => 'ids',
			'number'   => 0,
			'spam'     => 0,
			'deleted'  => 0,
			'archived' => 0,
		)
	);
	foreach ( (array) $kairoseth_aiso_site_ids as $kairoseth_aiso_site_id ) {
		switch_to_blog( (int) $kairoseth_aiso_site_id );
		kairoseth_aiso_uninstall_current_site();
		restore_current_blog();
	}
} else {
	kairoseth_aiso_uninstall_current_site();
}
