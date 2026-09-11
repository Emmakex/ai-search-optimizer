<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function kairoseth_aiwr_local_uninstall_option_name() {
	return 'kairoseth_ai_web_readiness_uninstall_mode';
}

function kairoseth_aiwr_local_normalize_uninstall_mode( $value ) {
	return $value === 'delete' ? 'delete' : 'preserve';
}

function kairoseth_aiwr_local_uninstall_mode() {
	return kairoseth_aiwr_local_normalize_uninstall_mode(
		get_option( kairoseth_aiwr_local_uninstall_option_name(), 'preserve' )
	);
}

function kairoseth_aiwr_local_lifecycle_text( $key ) {
	$locale = function_exists( 'determine_locale' ) ? determine_locale() : get_locale();
	$locale = strpos( strtolower( (string) $locale ), 'es' ) === 0 ? 'es' : 'en';
	$copy   = array(
		'en' => array(
			'page_title'     => 'AI Search Optimizer — Data & uninstall',
			'menu_title'     => 'AI Search Optimizer Data',
			'intro'          => 'Choose what happens to the stored llms.txt content if the plugin is uninstalled.',
			'preserve'       => 'Preserve published llms.txt data',
			'preserve_help'  => 'Recommended default. The stored deployment remains in WordPress so reinstalling the plugin can recover it. The public /llms.txt route is unavailable while the plugin is removed.',
			'delete'         => 'Delete published llms.txt data',
			'delete_help'    => 'Uninstall permanently deletes the stored llms.txt deployment for this WordPress site.',
			'always_cleanup' => 'Uninstall always removes the plugin setup marker, custom deployer role, administrator capability and this retention preference.',
			'deactivation'   => 'Deactivation does not delete the stored llms.txt deployment or this retention preference.',
			'save'           => 'Save uninstall preference',
			'saved'          => 'Uninstall preference saved.',
			'invalid_nonce'  => 'The request could not be verified. Reload this page and try again.',
		),
		'es' => array(
			'page_title'     => 'AI Search Optimizer — Datos y desinstalación',
			'menu_title'     => 'Datos de AI Search Optimizer',
			'intro'          => 'Elige qué ocurrirá con el contenido llms.txt guardado si se desinstala el plugin.',
			'preserve'       => 'Conservar los datos publicados de llms.txt',
			'preserve_help'  => 'Opción recomendada por defecto. El despliegue guardado permanece en WordPress para poder recuperarlo al reinstalar el plugin. La ruta pública /llms.txt no estará disponible mientras el plugin esté eliminado.',
			'delete'         => 'Eliminar los datos publicados de llms.txt',
			'delete_help'    => 'La desinstalación elimina permanentemente el despliegue llms.txt guardado para este sitio WordPress.',
			'always_cleanup' => 'La desinstalación siempre elimina el marcador interno de configuración, el rol de despliegue, la capability del administrador y esta preferencia de conservación.',
			'deactivation'   => 'La desactivación no elimina el despliegue llms.txt guardado ni esta preferencia de conservación.',
			'save'           => 'Guardar preferencia de desinstalación',
			'saved'          => 'Preferencia de desinstalación guardada.',
			'invalid_nonce'  => 'No se pudo verificar la solicitud. Recarga esta página e inténtalo de nuevo.',
		),
	);
	return isset( $copy[ $locale ][ $key ] ) ? $copy[ $locale ][ $key ] : $copy['en'][ $key ];
}

function kairoseth_aiwr_local_register_lifecycle_page() {
	add_management_page(
		kairoseth_aiwr_local_lifecycle_text( 'page_title' ),
		kairoseth_aiwr_local_lifecycle_text( 'menu_title' ),
		KAIROSETH_AIWR_CAPABILITY,
		'ai-search-optimizer-data',
		'kairoseth_aiwr_local_render_lifecycle_page'
	);
}

function kairoseth_aiwr_local_render_lifecycle_page() {
	if ( ! current_user_can( KAIROSETH_AIWR_CAPABILITY ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'ai-search-optimizer' ) );
	}

	$saved          = false;
	$nonce_error    = false;
	$request_method = isset( $_SERVER['REQUEST_METHOD'] )
		? strtoupper( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) )
		: '';
	if ( $request_method === 'POST' ) {
		$nonce = isset( $_POST['aiso_retention_nonce'] ) ? sanitize_text_field( wp_unslash( $_POST['aiso_retention_nonce'] ) ) : '';
		if ( $nonce === '' || ! wp_verify_nonce( $nonce, 'aiso_retention_settings' ) ) {
			$nonce_error = true;
		} else {
			$requested = isset( $_POST['aiso_uninstall_mode'] ) ? sanitize_key( wp_unslash( $_POST['aiso_uninstall_mode'] ) ) : 'preserve';
			$mode      = kairoseth_aiwr_local_normalize_uninstall_mode( $requested );
			update_option( kairoseth_aiwr_local_uninstall_option_name(), $mode, false );
			$saved = true;
		}
	}

	$mode = kairoseth_aiwr_local_uninstall_mode();
	?>
	<div class="wrap ai-search-optimizer-lifecycle">
		<h1><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'page_title' ) ); ?></h1>
		<p><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'intro' ) ); ?></p>
		<?php
		if ( $saved ) :
			?>
			<div class="notice notice-success inline"><p><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'saved' ) ); ?></p></div><?php endif; ?>
		<?php
		if ( $nonce_error ) :
			?>
			<div class="notice notice-error inline"><p><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'invalid_nonce' ) ); ?></p></div><?php endif; ?>
		<form method="post">
			<?php wp_nonce_field( 'aiso_retention_settings', 'aiso_retention_nonce' ); ?>
			<fieldset>
				<p><label><input type="radio" name="aiso_uninstall_mode" value="preserve" <?php checked( $mode, 'preserve' ); ?>> <strong><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'preserve' ) ); ?></strong></label></p>
				<p class="description"><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'preserve_help' ) ); ?></p>
				<p><label><input type="radio" name="aiso_uninstall_mode" value="delete" <?php checked( $mode, 'delete' ); ?>> <strong><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'delete' ) ); ?></strong></label></p>
				<p class="description"><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'delete_help' ) ); ?></p>
			</fieldset>
			<div class="notice notice-info inline"><p><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'deactivation' ) ); ?></p><p><?php echo esc_html( kairoseth_aiwr_local_lifecycle_text( 'always_cleanup' ) ); ?></p></div>
			<?php submit_button( kairoseth_aiwr_local_lifecycle_text( 'save' ) ); ?>
		</form>
	</div>
	<?php
}

if ( PHP_SAPI !== 'cli' ) {
	add_action( 'admin_menu', 'kairoseth_aiwr_local_register_lifecycle_page' );
}

require_once __DIR__ . '/local-admin-assets.php';
