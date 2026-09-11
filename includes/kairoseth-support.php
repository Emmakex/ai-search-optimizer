<?php
/**
 * Contextual Kairoseth support integration helpers.
 *
 * @package AI_Search_Optimizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const KAIROSETH_AISO_CUSTOM_REQUESTS_URL = 'https://kairoseth.com/custom-requests';
const KAIROSETH_AISO_EXTENSION_SLUG      = 'ai-search-optimizer';
const KAIROSETH_AISO_EXTENSION_NAME      = 'AI Search Optimizer';

/**
 * Provides the support locale operation.
 *
 * @return mixed The operation result.
 */
function kairoseth_aiso_support_locale() {
	$locale = function_exists( 'determine_locale' ) ? determine_locale() : get_locale();
	return strpos( strtolower( (string) $locale ), 'es' ) === 0 ? 'es' : 'en';
}

/**
 * Provides the support text operation.
 *
 * @param mixed $key The key value.
 * @return mixed The operation result.
 */
function kairoseth_aiso_support_text( $key ) {
	$copy = array(
		'en' => array(
			'page_title'    => 'AI Search Optimizer Support',
			'menu_title'    => 'AI Search Optimizer Support',
			'intro'         => 'AI Search Optimizer works locally without a Kairoseth account. Use these optional actions only when you want help improving the setup or need custom development.',
			'local_title'   => 'Your Free workflow stays local',
			'local_copy'    => 'Analysis, content selection, llms.txt generation, validation, publication and public verification continue to work without Kairoseth.',
			'privacy_title' => 'What happens when you use these actions',
			'privacy_1'     => 'Nothing is sent to Kairoseth when this WordPress page loads.',
			'privacy_2'     => 'A request begins only after you deliberately open one of the links below.',
			'privacy_3'     => 'The link contains only the plugin identity/version, WordPress version, language and selected request type.',
			'privacy_4'     => 'Your site URL, llms.txt content or hash, content inventory, administrator identity, WooCommerce data, credentials, tokens, prompts, logs and database data are not attached automatically.',
			'privacy_5'     => 'On Kairoseth you decide what contact, business, website or request information to enter and submit.',
			'improve_title' => 'Improve with Kairoseth',
			'improve_copy'  => 'Use this when you want implementation guidance or help improving your AI Search and llms.txt setup beyond the local workflow.',
			'improve_cta'   => 'Improve with Kairoseth',
			'custom_title'  => 'Custom development',
			'custom_copy'   => 'Use this for tailored workflows, integrations, automation or features specific to your WordPress, WooCommerce or business environment.',
			'custom_cta'    => 'Request custom development',
			'error'         => 'The verified Kairoseth request destination is unavailable. No data was sent and every local Free feature remains available.',
			'footnote'      => 'Kairoseth is optional. It is not a license, entitlement or requirement for the local Free features.',
		),
		'es' => array(
			'page_title'    => 'Soporte de AI Search Optimizer',
			'menu_title'    => 'Soporte de AI Search Optimizer',
			'intro'         => 'AI Search Optimizer funciona localmente sin una cuenta Kairoseth. Usa estas acciones opcionales solo cuando quieras ayuda para mejorar la configuración o necesites desarrollo a medida.',
			'local_title'   => 'Tu flujo Free sigue siendo local',
			'local_copy'    => 'El análisis, selección de contenido, generación de llms.txt, validación, publicación y verificación pública siguen funcionando sin Kairoseth.',
			'privacy_title' => 'Qué ocurre cuando usas estas acciones',
			'privacy_1'     => 'No se envía nada a Kairoseth cuando cargas esta página de WordPress.',
			'privacy_2'     => 'Una solicitud solo comienza cuando abres deliberadamente uno de los enlaces siguientes.',
			'privacy_3'     => 'El enlace contiene únicamente identidad/versión del plugin, versión de WordPress, idioma y tipo de solicitud seleccionado.',
			'privacy_4'     => 'No se adjuntan automáticamente la URL de tu sitio, contenido o hash de llms.txt, inventario de contenido, identidad del administrador, datos de WooCommerce, credenciales, tokens, prompts, logs ni datos de la base de datos.',
			'privacy_5'     => 'En Kairoseth tú decides qué datos de contacto, empresa, web o solicitud introducir y enviar.',
			'improve_title' => 'Mejorar con Kairoseth',
			'improve_copy'  => 'Usa esta opción si quieres orientación de implementación o ayuda para mejorar tu configuración de AI Search y llms.txt más allá del flujo local.',
			'improve_cta'   => 'Mejorar con Kairoseth',
			'custom_title'  => 'Desarrollo a medida',
			'custom_copy'   => 'Usa esta opción para flujos, integraciones, automatizaciones o funcionalidades adaptadas a tu WordPress, WooCommerce o entorno de negocio.',
			'custom_cta'    => 'Solicitar desarrollo a medida',
			'error'         => 'El destino verificado de solicitudes Kairoseth no está disponible. No se envió ningún dato y todas las funciones Free locales siguen disponibles.',
			'footnote'      => 'Kairoseth es opcional. No es una licencia, entitlement ni requisito para las funciones Free locales.',
		),
	);

	$locale = kairoseth_aiso_support_locale();
	if ( isset( $copy[ $locale ][ $key ] ) ) {
		return $copy[ $locale ][ $key ];
	}
	return isset( $copy['en'][ $key ] ) ? $copy['en'][ $key ] : $key;
}

/**
 * Provides the support bounded version operation.
 *
 * @param mixed $value The value value.
 * @return mixed The operation result.
 */
function kairoseth_aiso_support_bounded_version( $value ) {
	$value = trim( (string) $value );
	if ( '' === $value || strlen( $value ) > 40 || ! preg_match( '/^[A-Za-z0-9][A-Za-z0-9._+\-]*$/', $value ) ) {
		return '';
	}
	return $value;
}

/**
 * Provides the support context operation.
 *
 * @return mixed The operation result.
 */
function kairoseth_aiso_support_context() {
	$plugin_version    = kairoseth_aiso_support_bounded_version( KAIROSETH_AIWR_CONNECTOR_VERSION );
	$wordpress_version = kairoseth_aiso_support_bounded_version( get_bloginfo( 'version' ) );

	if ( '' === $plugin_version || '' === $wordpress_version ) {
		return null;
	}

	return array(
		'source'              => 'extension',
		'extensionSlug'       => KAIROSETH_AISO_EXTENSION_SLUG,
		'extensionName'       => KAIROSETH_AISO_EXTENSION_NAME,
		'extensionVersion'    => $plugin_version,
		'hostPlatform'        => 'wordpress',
		'hostPlatformVersion' => $wordpress_version,
		'locale'              => kairoseth_aiso_support_locale(),
	);
}

/**
 * Provides the support canonical destination operation.
 *
 * @param mixed $destination The destination value.
 * @return mixed The operation result.
 */
function kairoseth_aiso_support_canonical_destination( $destination ) {
	$destination = trim( (string) $destination );
	$parts       = wp_parse_url( $destination );
	if ( ! is_array( $parts ) ) {
		return '';
	}

	$scheme = isset( $parts['scheme'] ) ? strtolower( (string) $parts['scheme'] ) : '';
	$host   = isset( $parts['host'] ) ? strtolower( (string) $parts['host'] ) : '';
	$path   = isset( $parts['path'] ) ? (string) $parts['path'] : '';

	if ( 'https' !== $scheme || 'kairoseth.com' !== $host || '/custom-requests' !== $path ) {
		return '';
	}

	foreach ( array( 'user', 'pass', 'port', 'query', 'fragment' ) as $forbidden ) {
		if ( isset( $parts[ $forbidden ] ) && '' !== (string) $parts[ $forbidden ] ) {
			return '';
		}
	}

	return 'https://kairoseth.com/custom-requests';
}

/**
 * Provides the support url operation.
 *
 * @param mixed $request_type The request type value.
 * @return mixed The operation result.
 */
function kairoseth_aiso_support_url( $request_type ) {
	$allowed_types = array( 'implementation_support', 'business_customization' );
	if ( ! in_array( $request_type, $allowed_types, true ) ) {
		return '';
	}

	$destination = kairoseth_aiso_support_canonical_destination( KAIROSETH_AISO_CUSTOM_REQUESTS_URL );
	$context     = kairoseth_aiso_support_context();
	if ( '' === $destination || ! is_array( $context ) ) {
		return '';
	}

	$context['requestType'] = $request_type;
	$expected_keys          = array(
		'source',
		'extensionSlug',
		'extensionName',
		'extensionVersion',
		'hostPlatform',
		'hostPlatformVersion',
		'locale',
		'requestType',
	);
	if ( array_keys( $context ) !== $expected_keys ) {
		return '';
	}

	return $destination . '?' . http_build_query( $context, '', '&', PHP_QUERY_RFC3986 );
}

/**
 * Provides the register support page operation.
 */
function kairoseth_aiso_register_support_page() {
	add_management_page(
		kairoseth_aiso_support_text( 'page_title' ),
		kairoseth_aiso_support_text( 'menu_title' ),
		'manage_options',
		'ai-search-optimizer-support',
		'kairoseth_aiso_render_support_page'
	);
}
add_action( 'admin_menu', 'kairoseth_aiso_register_support_page' );

/**
 * Provides the render support page operation.
 */
function kairoseth_aiso_render_support_page() {
	if ( ! current_user_can( 'manage_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'ai-search-optimizer' ) );
	}

	$improve_url = kairoseth_aiso_support_url( 'implementation_support' );
	$custom_url  = kairoseth_aiso_support_url( 'business_customization' );
	$has_urls    = '' !== $improve_url && '' !== $custom_url;
	?>
	<div class="wrap ai-search-optimizer-support">
		<h1><?php echo esc_html( kairoseth_aiso_support_text( 'page_title' ) ); ?></h1>
		<p class="description"><?php echo esc_html( kairoseth_aiso_support_text( 'intro' ) ); ?></p>

		<div class="notice notice-info inline">
			<p><strong><?php echo esc_html( kairoseth_aiso_support_text( 'local_title' ) ); ?></strong></p>
			<p><?php echo esc_html( kairoseth_aiso_support_text( 'local_copy' ) ); ?></p>
		</div>

		<section class="aiso-support-privacy" aria-labelledby="aiso-support-privacy-title">
			<h2 id="aiso-support-privacy-title"><?php echo esc_html( kairoseth_aiso_support_text( 'privacy_title' ) ); ?></h2>
			<ul>
				<li><?php echo esc_html( kairoseth_aiso_support_text( 'privacy_1' ) ); ?></li>
				<li><?php echo esc_html( kairoseth_aiso_support_text( 'privacy_2' ) ); ?></li>
				<li><?php echo esc_html( kairoseth_aiso_support_text( 'privacy_3' ) ); ?></li>
				<li><?php echo esc_html( kairoseth_aiso_support_text( 'privacy_4' ) ); ?></li>
				<li><?php echo esc_html( kairoseth_aiso_support_text( 'privacy_5' ) ); ?></li>
			</ul>
		</section>

		<?php if ( ! $has_urls ) : ?>
			<div class="notice notice-error inline"><p><?php echo esc_html( kairoseth_aiso_support_text( 'error' ) ); ?></p></div>
		<?php else : ?>
			<div class="aiso-support-grid">
				<section class="aiso-support-card" aria-labelledby="aiso-support-improve-title">
					<h2 id="aiso-support-improve-title"><?php echo esc_html( kairoseth_aiso_support_text( 'improve_title' ) ); ?></h2>
					<p><?php echo esc_html( kairoseth_aiso_support_text( 'improve_copy' ) ); ?></p>
					<p><a class="button button-primary" href="<?php echo esc_url( $improve_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( kairoseth_aiso_support_text( 'improve_cta' ) ); ?></a></p>
				</section>
				<section class="aiso-support-card" aria-labelledby="aiso-support-custom-title">
					<h2 id="aiso-support-custom-title"><?php echo esc_html( kairoseth_aiso_support_text( 'custom_title' ) ); ?></h2>
					<p><?php echo esc_html( kairoseth_aiso_support_text( 'custom_copy' ) ); ?></p>
					<p><a class="button button-secondary" href="<?php echo esc_url( $custom_url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( kairoseth_aiso_support_text( 'custom_cta' ) ); ?></a></p>
				</section>
			</div>
		<?php endif; ?>

		<p class="description aiso-support-footnote"><?php echo esc_html( kairoseth_aiso_support_text( 'footnote' ) ); ?></p>

		<style>
			.ai-search-optimizer-support{max-width:1000px}.ai-search-optimizer-support .aiso-support-privacy{margin:20px 0}.ai-search-optimizer-support .aiso-support-privacy li{margin:0 0 8px}.ai-search-optimizer-support .aiso-support-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin:20px 0}.ai-search-optimizer-support .aiso-support-card{background:#fff;border:1px solid #dcdcde;border-radius:8px;padding:18px;min-width:0}.ai-search-optimizer-support .aiso-support-card h2{margin-top:0}.ai-search-optimizer-support .button{display:inline-flex;align-items:center;min-height:40px}.ai-search-optimizer-support :focus-visible{outline:2px solid currentColor;outline-offset:2px}@media(max-width:600px){.ai-search-optimizer-support .aiso-support-grid{grid-template-columns:1fr}.ai-search-optimizer-support .button{justify-content:center;min-height:44px;width:100%}}
		</style>
	</div>
	<?php
}
