<?php
/**
 * Local llms.txt publication and verification helpers.
 *
 * @package AI_Search_Optimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Provides the local inventory key operation.
 *
 * @param mixed $item The item value.
 * @return mixed The operation result.
 */
function kairoseth_aiwr_local_inventory_key( $item ) {
	if ( ! is_array( $item ) ) {
		return '';
	}
	$type = isset( $item['type'] ) && is_string( $item['type'] ) ? preg_replace( '/[^a-z0-9_-]/i', '', $item['type'] ) : '';
	$id   = isset( $item['id'] ) ? (int) $item['id'] : 0;
	if ( '' === $type || $id <= 0 ) {
		return '';
	}
	return strtolower( $type ) . ':' . $id;
}

/**
 * Provides the local filter selected inventory operation.
 *
 * @param mixed $inventory The inventory value.
 * @param mixed $selected_keys The selected keys value.
 * @return mixed The operation result.
 */
function kairoseth_aiwr_local_filter_selected_inventory( $inventory, $selected_keys ) {
	$allowed = array();
	foreach ( (array) $selected_keys as $key ) {
		if ( is_string( $key ) && preg_match( '/^[a-z0-9_-]+:[1-9][0-9]*$/i', $key ) ) {
			$allowed[ strtolower( $key ) ] = true;
		}
	}

	$selected = array();
	foreach ( (array) $inventory as $item ) {
		$key = kairoseth_aiwr_local_inventory_key( $item );
		if ( '' !== $key && isset( $allowed[ $key ] ) ) {
			$selected[] = $item;
		}
	}

	return kairoseth_aiwr_local_sort_inventory( $selected );
}

/**
 * Provides the local deployment token operation.
 *
 * @param mixed $deployment The deployment value.
 * @return mixed The operation result.
 */
function kairoseth_aiwr_local_deployment_token( $deployment ) {
	if ( ! is_array( $deployment ) ) {
		return hash( 'sha256', 'none' );
	}

	$content  = isset( $deployment['content'] ) && is_string( $deployment['content'] ) ? $deployment['content'] : '';
	$snapshot = array(
		'revisionSlug' => isset( $deployment['revisionSlug'] ) && is_string( $deployment['revisionSlug'] ) ? $deployment['revisionSlug'] : '',
		'contentHash'  => isset( $deployment['contentHash'] ) && is_string( $deployment['contentHash'] ) ? $deployment['contentHash'] : '',
		'actualHash'   => hash( 'sha256', $content ),
		'updatedAt'    => isset( $deployment['updatedAt'] ) && is_string( $deployment['updatedAt'] ) ? $deployment['updatedAt'] : '',
		'blogId'       => isset( $deployment['blogId'] ) ? (int) $deployment['blogId'] : 0,
		'networkId'    => array_key_exists( 'networkId', $deployment ) && null !== $deployment['networkId'] ? (int) $deployment['networkId'] : null,
		'homeUrl'      => isset( $deployment['homeUrl'] ) && is_string( $deployment['homeUrl'] ) ? $deployment['homeUrl'] : '',
	);

	return hash( 'sha256', wp_json_encode( $snapshot, JSON_UNESCAPED_SLASHES ) );
}

/**
 * Provides the local deployment is valid operation.
 *
 * @param mixed $deployment The deployment value.
 * @return mixed The operation result.
 */
function kairoseth_aiwr_local_deployment_is_valid( $deployment ) {
	return is_array( $deployment )
		&& isset( $deployment['content'], $deployment['contentHash'] )
		&& is_string( $deployment['content'] )
		&& is_string( $deployment['contentHash'] )
		&& preg_match( '/^[a-f0-9]{64}$/', $deployment['contentHash'] )
		&& hash_equals( $deployment['contentHash'], hash( 'sha256', $deployment['content'] ) );
}

/**
 * Provides the local verify public content operation.
 *
 * @param mixed $content The content value.
 * @param mixed $content_hash The content hash value.
 * @return mixed The operation result.
 */
function kairoseth_aiwr_local_verify_public_content( $content, $content_hash ) {
	if ( ! is_string( $content ) || ! is_string( $content_hash ) || ! preg_match( '/^[a-f0-9]{64}$/', $content_hash ) ) {
		return array(
			'verified' => false,
			'code'     => 'verification_input_invalid',
		);
	}

	$target_url = home_url( '/llms.txt' );
	$response   = wp_remote_get(
		$target_url,
		array(
			'timeout'             => 10,
			'redirection'         => 0,
			'limit_response_size' => KAIROSETH_AIWR_MAX_CONTENT_BYTES + 1,
			'headers'             => array( 'Accept' => 'text/plain' ),
		)
	);

	if ( is_wp_error( $response ) ) {
		return array(
			'verified'  => false,
			'code'      => 'public_request_failed',
			'targetUrl' => $target_url,
		);
	}

	$status = (int) wp_remote_retrieve_response_code( $response );
	if ( 200 !== $status ) {
		return array(
			'verified'   => false,
			'code'       => 'public_http_status',
			'httpStatus' => $status,
			'targetUrl'  => $target_url,
		);
	}

	$body = (string) wp_remote_retrieve_body( $response );
	if ( strlen( $body ) > KAIROSETH_AIWR_MAX_CONTENT_BYTES ) {
		return array(
			'verified'  => false,
			'code'      => 'public_body_too_large',
			'targetUrl' => $target_url,
		);
	}

	$public_hash = hash( 'sha256', $body );
	if ( ! hash_equals( $content_hash, $public_hash ) || ! hash_equals( hash( 'sha256', $content ), $public_hash ) ) {
		return array(
			'verified'     => false,
			'code'         => 'public_hash_mismatch',
			'expectedHash' => $content_hash,
			'publicHash'   => $public_hash,
			'targetUrl'    => $target_url,
		);
	}

	return array(
		'verified'    => true,
		'code'        => 'verified',
		'contentHash' => $public_hash,
		'targetUrl'   => $target_url,
	);
}

/**
 * Provides the local verify current publication operation.
 *
 * @return mixed The operation result.
 */
function kairoseth_aiwr_local_verify_current_publication() {
	$deployment = get_option( KAIROSETH_AIWR_DEPLOYMENT_OPTION, null );
	if ( ! kairoseth_aiwr_local_deployment_is_valid( $deployment ) ) {
		return array(
			'verified' => false,
			'code'     => 'no_valid_deployment',
		);
	}

	return kairoseth_aiwr_local_verify_public_content( $deployment['content'], $deployment['contentHash'] );
}

/**
 * Provides the local publish content operation.
 *
 * @param mixed $content The content value.
 * @param mixed $expected_state_token The expected state token value.
 * @param int   $selected_count The selected count value.
 * @return mixed The operation result.
 */
function kairoseth_aiwr_local_publish_content( $content, $expected_state_token, $selected_count = 0 ) {
	$content              = is_string( $content ) ? $content : '';
	$expected_state_token = is_string( $expected_state_token ) ? trim( $expected_state_token ) : '';
	$selected_count       = max( 0, (int) $selected_count );

	$current       = get_option( KAIROSETH_AIWR_DEPLOYMENT_OPTION, null );
	$current_token = kairoseth_aiwr_local_deployment_token( $current );
	if ( '' === $expected_state_token || ! hash_equals( $current_token, $expected_state_token ) ) {
		return array(
			'ok'           => false,
			'changed'      => false,
			'code'         => 'state_changed',
			'verification' => null,
		);
	}

	$validation = kairoseth_aiwr_local_validate_llms( $content, home_url( '/' ), KAIROSETH_AIWR_MAX_CONTENT_BYTES );
	if ( ! $validation['valid'] ) {
		return array(
			'ok'           => false,
			'changed'      => false,
			'code'         => 'validation_failed',
			'validation'   => $validation,
			'verification' => null,
		);
	}

	$content_hash = $validation['contentHash'];
	if (
		kairoseth_aiwr_local_deployment_is_valid( $current )
		&& hash_equals( $content_hash, $current['contentHash'] )
		&& hash_equals( $content_hash, hash( 'sha256', $current['content'] ) )
	) {
		$verification = kairoseth_aiwr_local_verify_public_content( $content, $content_hash );
		return array(
			'ok'           => true,
			'changed'      => false,
			'code'         => $verification['verified'] ? 'already_current_verified' : 'already_current_unverified',
			'contentHash'  => $content_hash,
			'verification' => $verification,
		);
	}

	$identity = kairoseth_aiwr_site_identity();
	$record   = array(
		'revisionSlug'          => 'local-' . gmdate( 'Ymd\\THis\\Z' ),
		'contentHash'           => $content_hash,
		'content'               => $content,
		'blogId'                => $identity['blogId'],
		'networkId'             => $identity['networkId'],
		'homeUrl'               => $identity['homeUrl'],
		'updatedAt'             => gmdate( 'c' ),
		'source'                => 'local-free',
		'selectedResourceCount' => $selected_count,
	);

	update_option( KAIROSETH_AIWR_DEPLOYMENT_OPTION, $record, false );

	$stored = get_option( KAIROSETH_AIWR_DEPLOYMENT_OPTION, null );
	if ( ! kairoseth_aiwr_local_deployment_is_valid( $stored ) || ! hash_equals( $content_hash, $stored['contentHash'] ) ) {
		return array(
			'ok'           => false,
			'changed'      => false,
			'code'         => 'storage_verification_failed',
			'contentHash'  => $content_hash,
			'verification' => null,
		);
	}

	$verification = kairoseth_aiwr_local_verify_public_content( $content, $content_hash );
	return array(
		'ok'           => true,
		'changed'      => true,
		'code'         => $verification['verified'] ? 'published_verified' : 'published_unverified',
		'contentHash'  => $content_hash,
		'verification' => $verification,
	);
}

require_once __DIR__ . '/local-lifecycle.php';
