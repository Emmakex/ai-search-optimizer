<?php
/**
 * Plugin Name: AI Search Optimizer
 * Description: Secure least-privilege llms.txt publishing connector for Kairoseth AI Search Optimizer.
 * Version: 0.4.0
 * Requires at least: 5.6
 * Requires PHP: 7.4
 * Author: Kairoseth
 * License: MIT
 * Text Domain: ai-search-optimizer
 */

if (!defined('ABSPATH')) {
    exit;
}

/*
 * Compatibility note:
 * The internal AI Web Readiness identifiers below are intentionally retained
 * from the accepted 0.3.2 connector contract so existing Kairoseth Platform
 * integrations, stored deployment state and Multisite identity pins continue
 * to work while the public product is renamed AI Search Optimizer.
 */
const KAIROSETH_AIWR_CONNECTOR_VERSION = '0.4.0';
const KAIROSETH_AIWR_SCHEMA_VERSION = '2';
const KAIROSETH_AIWR_CAPABILITY = 'kairoseth_ai_web_readiness_deploy';
const KAIROSETH_AIWR_DEPLOYER_ROLE = 'kairoseth_ai_web_deployer';
const KAIROSETH_AIWR_DEPLOYMENT_OPTION = 'kairoseth_ai_web_readiness_deployment';
const KAIROSETH_AIWR_SETUP_OPTION = 'kairoseth_ai_web_readiness_setup_version';
const KAIROSETH_AIWR_QUERY_VAR = 'kairoseth_ai_web_readiness_llms';
const KAIROSETH_AIWR_MAX_CONTENT_BYTES = 524288;

function kairoseth_aiwr_register_site_role() {
    add_role(
        KAIROSETH_AIWR_DEPLOYER_ROLE,
        'Kairoseth AI Web Deployer',
        array(
            'read' => true,
            KAIROSETH_AIWR_CAPABILITY => true,
        )
    );

    $administrator = get_role('administrator');
    if ($administrator && !$administrator->has_cap(KAIROSETH_AIWR_CAPABILITY)) {
        $administrator->add_cap(KAIROSETH_AIWR_CAPABILITY);
    }
}

function kairoseth_aiwr_register_llms_route() {
    add_rewrite_rule(
        '^llms\\.txt$',
        'index.php?' . KAIROSETH_AIWR_QUERY_VAR . '=1',
        'top'
    );
}
add_action('init', 'kairoseth_aiwr_register_llms_route', 5);

function kairoseth_aiwr_ensure_current_site_setup($force = false) {
    kairoseth_aiwr_register_site_role();
    $current = (string) get_option(KAIROSETH_AIWR_SETUP_OPTION, '');
    if ($force || $current !== KAIROSETH_AIWR_SCHEMA_VERSION) {
        kairoseth_aiwr_register_llms_route();
        flush_rewrite_rules(false);
        update_option(KAIROSETH_AIWR_SETUP_OPTION, KAIROSETH_AIWR_SCHEMA_VERSION, false);
    }
}
add_action('init', 'kairoseth_aiwr_ensure_current_site_setup', 20);

function kairoseth_aiwr_activate_current_site() {
    kairoseth_aiwr_ensure_current_site_setup(true);
}

function kairoseth_aiwr_activate($network_wide = false) {
    if (is_multisite() && $network_wide) {
        $site_ids = get_sites(
            array(
                'fields' => 'ids',
                'number' => 0,
                'spam' => 0,
                'deleted' => 0,
                'archived' => 0,
            )
        );
        foreach ($site_ids as $site_id) {
            switch_to_blog((int) $site_id);
            kairoseth_aiwr_activate_current_site();
            restore_current_blog();
        }
        return;
    }
    kairoseth_aiwr_activate_current_site();
}
register_activation_hook(__FILE__, 'kairoseth_aiwr_activate');

function kairoseth_aiwr_is_network_active() {
    if (!is_multisite()) {
        return false;
    }
    $active = (array) get_site_option('active_sitewide_plugins', array());
    return isset($active[plugin_basename(__FILE__)]);
}

function kairoseth_aiwr_initialize_new_site($new_site) {
    if (!kairoseth_aiwr_is_network_active() || !isset($new_site->blog_id)) {
        return;
    }
    switch_to_blog((int) $new_site->blog_id);
    kairoseth_aiwr_activate_current_site();
    restore_current_blog();
}
add_action('wp_initialize_site', 'kairoseth_aiwr_initialize_new_site', 200, 1);

function kairoseth_aiwr_deactivate($network_wide = false) {
    if (is_multisite() && $network_wide) {
        $site_ids = get_sites(array('fields' => 'ids', 'number' => 0));
        foreach ($site_ids as $site_id) {
            switch_to_blog((int) $site_id);
            delete_option(KAIROSETH_AIWR_SETUP_OPTION);
            flush_rewrite_rules(false);
            restore_current_blog();
        }
        return;
    }
    delete_option(KAIROSETH_AIWR_SETUP_OPTION);
    flush_rewrite_rules(false);
}
register_deactivation_hook(__FILE__, 'kairoseth_aiwr_deactivate');

function kairoseth_aiwr_query_vars($vars) {
    $vars[] = KAIROSETH_AIWR_QUERY_VAR;
    return $vars;
}
add_filter('query_vars', 'kairoseth_aiwr_query_vars');

function kairoseth_aiwr_site_identity() {
    $blog_id = (int) get_current_blog_id();
    $multisite = is_multisite();

    $site = $multisite && function_exists('get_site')
        ? get_site($blog_id)
        : null;
    $network_id = $multisite && $site && isset($site->network_id)
        ? (int) $site->network_id
        : null;

    return array(
        'isMultisite' => $multisite,
        'blogId' => $blog_id > 0 ? $blog_id : 1,
        'networkId' => $network_id,
        'isMainSite' => $multisite ? (bool) is_main_site($blog_id) : true,
        'homeUrl' => trailingslashit(home_url('/')),
        'siteUrl' => trailingslashit(site_url('/')),
        'restUrl' => trailingslashit(rest_url('kairoseth-ai-web-readiness/v1')),
        'targetUrl' => home_url('/llms.txt'),
    );
}

function kairoseth_aiwr_public_llms() {
    if ((string) get_query_var(KAIROSETH_AIWR_QUERY_VAR) !== '1') {
        return;
    }

    $deployment = get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null);
    if (!is_array($deployment) || !isset($deployment['content'], $deployment['contentHash'])) {
        status_header(404);
        header('Content-Type: text/plain; charset=utf-8');
        header('Cache-Control: no-cache, must-revalidate');
        echo 'llms.txt is not deployed.';
        exit;
    }

    $content = is_string($deployment['content']) ? $deployment['content'] : '';
    $stored_hash = is_string($deployment['contentHash']) ? $deployment['contentHash'] : '';
    $actual_hash = hash('sha256', $content);
    if (!preg_match('/^[a-f0-9]{64}$/', $stored_hash) || !hash_equals($stored_hash, $actual_hash)) {
        status_header(500);
        header('Content-Type: text/plain; charset=utf-8');
        header('Cache-Control: no-store');
        echo 'Kairoseth deployment integrity check failed.';
        exit;
    }

    status_header(200);
    header('Content-Type: text/plain; charset=utf-8');
    header('Cache-Control: no-cache, must-revalidate');
    header('X-Content-Type-Options: nosniff');
    header('X-Kairoseth-Content-SHA256: ' . $actual_hash);
    echo $content;
    exit;
}
add_action('template_redirect', 'kairoseth_aiwr_public_llms', 0);

function kairoseth_aiwr_permission_check() {
    if (!is_user_logged_in()) {
        return new WP_Error(
            'kairoseth_aiwr_auth_required',
            'Authentication is required.',
            array('status' => 401)
        );
    }
    if (!current_user_can(KAIROSETH_AIWR_CAPABILITY)) {
        return new WP_Error(
            'kairoseth_aiwr_forbidden',
            'The authenticated user cannot deploy AI Web Readiness artifacts on this WordPress site.',
            array('status' => 403)
        );
    }
    return true;
}

function kairoseth_aiwr_append_identity($payload) {
    return array_merge($payload, kairoseth_aiwr_site_identity());
}

function kairoseth_aiwr_connection_response() {
    return rest_ensure_response(
        kairoseth_aiwr_append_identity(
            array(
                'connected' => true,
                'plugin' => 'kairoseth-ai-web-readiness',
                'pluginVersion' => KAIROSETH_AIWR_CONNECTOR_VERSION,
                'connectorSchemaVersion' => KAIROSETH_AIWR_SCHEMA_VERSION,
                'capability' => KAIROSETH_AIWR_CAPABILITY,
                'wordpressVersion' => get_bloginfo('version'),
                'woocommerceActive' => class_exists('WooCommerce'),
                'diagnostics' => array(
                    'contractVersion' => 1,
                    'authentication' => 'passed',
                    'capability' => 'passed',
                    'siteIdentity' => 'passed',
                ),
            )
        )
    );
}

function kairoseth_aiwr_deployment_state() {
    $deployment = get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null);
    if (!is_array($deployment)) {
        return rest_ensure_response(
            kairoseth_aiwr_append_identity(
                array(
                    'deployed' => false,
                    'pluginVersion' => KAIROSETH_AIWR_CONNECTOR_VERSION,
                )
            )
        );
    }

    return rest_ensure_response(
        kairoseth_aiwr_append_identity(
            array(
                'deployed' => true,
                'revisionSlug' => isset($deployment['revisionSlug']) ? (string) $deployment['revisionSlug'] : '',
                'contentHash' => isset($deployment['contentHash']) ? (string) $deployment['contentHash'] : '',
                'updatedAt' => isset($deployment['updatedAt']) ? (string) $deployment['updatedAt'] : '',
                'pluginVersion' => KAIROSETH_AIWR_CONNECTOR_VERSION,
            )
        )
    );
}

function kairoseth_aiwr_normalized_url($value) {
    if (!is_string($value) || $value === '') {
        return '';
    }
    return untrailingslashit(esc_url_raw($value));
}

function kairoseth_aiwr_verify_expected_site($body) {
    $identity = kairoseth_aiwr_site_identity();
    $expected_blog_id = isset($body['expectedBlogId']) ? (int) $body['expectedBlogId'] : 0;
    $expected_network_id = array_key_exists('expectedNetworkId', $body) && $body['expectedNetworkId'] !== null
        ? (int) $body['expectedNetworkId']
        : null;
    $expected_home_url = isset($body['expectedHomeUrl']) && is_string($body['expectedHomeUrl'])
        ? kairoseth_aiwr_normalized_url($body['expectedHomeUrl'])
        : '';

    if (
        $expected_blog_id <= 0 ||
        $expected_blog_id !== (int) $identity['blogId'] ||
        $expected_network_id !== $identity['networkId'] ||
        $expected_home_url === '' ||
        $expected_home_url !== kairoseth_aiwr_normalized_url($identity['homeUrl'])
    ) {
        return new WP_Error(
            'kairoseth_aiwr_site_mismatch',
            'The deployment is pinned to a different WordPress site in this installation/network.',
            array('status' => 409)
        );
    }
    return true;
}

function kairoseth_aiwr_verify_expected_remote_state($body, $current) {
    if (!array_key_exists('expectedCurrentDeployed', $body) || !is_bool($body['expectedCurrentDeployed'])) {
        return new WP_Error(
            'kairoseth_aiwr_invalid_expected_state',
            'A valid expectedCurrentDeployed value is required.',
            array('status' => 400)
        );
    }

    $expected_deployed = $body['expectedCurrentDeployed'];
    $expected_hash = array_key_exists('expectedCurrentContentHash', $body)
        ? $body['expectedCurrentContentHash']
        : null;
    if (
        ($expected_deployed && (!is_string($expected_hash) || !preg_match('/^[a-f0-9]{64}$/', $expected_hash))) ||
        (!$expected_deployed && $expected_hash !== null)
    ) {
        return new WP_Error(
            'kairoseth_aiwr_invalid_expected_state',
            'The expected remote deployment state is invalid.',
            array('status' => 400)
        );
    }

    $current_deployed = is_array($current);
    if (!$expected_deployed) {
        if ($current_deployed) {
            return new WP_Error(
                'kairoseth_aiwr_remote_state_changed',
                'The WordPress deployment changed after Kairoseth inspected it.',
                array('status' => 409)
            );
        }
        return true;
    }

    if (
        !$current_deployed ||
        !isset($current['contentHash'], $current['content']) ||
        !is_string($current['contentHash']) ||
        !is_string($current['content']) ||
        !preg_match('/^[a-f0-9]{64}$/', $current['contentHash']) ||
        !hash_equals($current['contentHash'], hash('sha256', $current['content'])) ||
        !hash_equals($expected_hash, $current['contentHash'])
    ) {
        return new WP_Error(
            'kairoseth_aiwr_remote_state_changed',
            'The WordPress deployment changed after Kairoseth inspected it.',
            array('status' => 409)
        );
    }

    return true;
}

function kairoseth_aiwr_deploy(WP_REST_Request $request) {
    $body = $request->get_json_params();
    if (!is_array($body)) {
        return new WP_Error('kairoseth_aiwr_invalid_body', 'A JSON object is required.', array('status' => 400));
    }

    $site_check = kairoseth_aiwr_verify_expected_site($body);
    if (is_wp_error($site_check)) {
        return $site_check;
    }

    $revision_slug = isset($body['revisionSlug']) && is_string($body['revisionSlug'])
        ? trim($body['revisionSlug'])
        : '';
    $content_hash = isset($body['contentHash']) && is_string($body['contentHash'])
        ? strtolower(trim($body['contentHash']))
        : '';
    $content = isset($body['content']) && is_string($body['content'])
        ? $body['content']
        : null;

    if (
        $revision_slug === '' || strlen($revision_slug) > 180 ||
        !preg_match('/^[a-f0-9]{64}$/', $content_hash) ||
        $content === null || strlen($content) > KAIROSETH_AIWR_MAX_CONTENT_BYTES
    ) {
        return new WP_Error(
            'kairoseth_aiwr_invalid_deployment',
            'The deployment payload is invalid or exceeds the allowed size.',
            array('status' => 400)
        );
    }

    $actual_hash = hash('sha256', $content);
    if (!hash_equals($content_hash, $actual_hash)) {
        return new WP_Error(
            'kairoseth_aiwr_hash_mismatch',
            'The supplied content does not match contentHash.',
            array('status' => 409)
        );
    }

    $current = get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null);
    $state_check = kairoseth_aiwr_verify_expected_remote_state($body, $current);
    if (is_wp_error($state_check)) {
        return $state_check;
    }

    if (
        is_array($current) &&
        isset($current['contentHash'], $current['content']) &&
        is_string($current['contentHash']) &&
        is_string($current['content']) &&
        hash_equals($content_hash, $current['contentHash']) &&
        hash_equals($content_hash, hash('sha256', $current['content']))
    ) {
        return rest_ensure_response(
            kairoseth_aiwr_append_identity(
                array(
                    'deployed' => true,
                    'changed' => false,
                    'revisionSlug' => isset($current['revisionSlug']) ? (string) $current['revisionSlug'] : $revision_slug,
                    'contentHash' => $content_hash,
                    'updatedAt' => isset($current['updatedAt']) ? (string) $current['updatedAt'] : '',
                    'pluginVersion' => KAIROSETH_AIWR_CONNECTOR_VERSION,
                )
            )
        );
    }

    $identity = kairoseth_aiwr_site_identity();
    $record = array(
        'revisionSlug' => $revision_slug,
        'contentHash' => $content_hash,
        'content' => $content,
        'blogId' => $identity['blogId'],
        'networkId' => $identity['networkId'],
        'homeUrl' => $identity['homeUrl'],
        'updatedAt' => gmdate('c'),
    );
    update_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, $record, false);

    return rest_ensure_response(
        kairoseth_aiwr_append_identity(
            array(
                'deployed' => true,
                'changed' => true,
                'revisionSlug' => $revision_slug,
                'contentHash' => $content_hash,
                'updatedAt' => $record['updatedAt'],
                'pluginVersion' => KAIROSETH_AIWR_CONNECTOR_VERSION,
            )
        )
    );
}

function kairoseth_aiwr_register_rest_routes() {
    register_rest_route(
        'kairoseth-ai-web-readiness/v1',
        '/connection',
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => 'kairoseth_aiwr_connection_response',
            'permission_callback' => 'kairoseth_aiwr_permission_check',
        )
    );

    register_rest_route(
        'kairoseth-ai-web-readiness/v1',
        '/deployment',
        array(
            array(
                'methods' => WP_REST_Server::READABLE,
                'callback' => 'kairoseth_aiwr_deployment_state',
                'permission_callback' => 'kairoseth_aiwr_permission_check',
            ),
            array(
                'methods' => WP_REST_Server::EDITABLE,
                'callback' => 'kairoseth_aiwr_deploy',
                'permission_callback' => 'kairoseth_aiwr_permission_check',
            ),
        )
    );
}
add_action('rest_api_init', 'kairoseth_aiwr_register_rest_routes');
