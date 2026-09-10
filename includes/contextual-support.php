<?php

if (!defined('ABSPATH')) {
    exit;
}

const KAIROSETH_AISO_CUSTOM_REQUESTS_URL = 'https://kairoseth.com/custom-requests';

function kairoseth_aiso_support_locale() {
    $locale = function_exists('determine_locale') ? determine_locale() : get_locale();
    return strpos(strtolower((string) $locale), 'es') === 0 ? 'es' : 'en';
}

function kairoseth_aiso_support_text($key) {
    $copy = array(
        'en' => array(
            'page_title' => 'AI Search Optimizer Support',
            'menu_title' => 'AI Search Optimizer Support',
            'intro' => 'Optional Kairoseth support and custom development for AI Search Optimizer. All accepted Free features keep working locally without Kairoseth.',
            'local_first_title' => 'Local-first by default',
            'local_first' => 'Loading this page sends nothing to Kairoseth. Analysis, content selection, llms.txt generation, validation, publication and public verification remain available without an external account.',
            'privacy_title' => 'What happens when you choose an action',
            'privacy_1' => 'Nothing is sent to Kairoseth when this WordPress page loads.',
            'privacy_2' => 'Clicking an action opens Kairoseth in a new browser tab with only bounded product and platform context.',
            'privacy_3' => 'No site URL, llms.txt content, selected resources, findings, administrator identity, credentials, logs or WordPress data are attached automatically.',
            'privacy_4' => 'You decide what personal, business or technical information to enter and submit on the Kairoseth form.',
            'support_title' => 'Get optimization support',
            'support_copy' => 'Use this for setup questions, implementation help or guidance improving your AI Search and llms.txt workflow.',
            'support_cta' => 'Open Kairoseth support',
            'custom_title' => 'Request a custom improvement',
            'custom_copy' => 'Use this for tailored development, integrations, automation or requirements beyond the local Free workflow.',
            'custom_cta' => 'Request custom development',
            'unavailable' => 'The verified Kairoseth support destination is currently unavailable. No data was sent and all local plugin features remain available.',
            'footnote' => 'Kairoseth is optional and is not a license, entitlement or feature-unlock requirement for the Free plugin.',
        ),
        'es' => array(
            'page_title' => 'Soporte de AI Search Optimizer',
            'menu_title' => 'Soporte AI Search Optimizer',
            'intro' => 'Soporte y desarrollo a medida opcionales de Kairoseth para AI Search Optimizer. Todas las funciones Free aceptadas siguen funcionando localmente sin Kairoseth.',
            'local_first_title' => 'Local-first por defecto',
            'local_first' => 'Cargar esta página no envía nada a Kairoseth. El análisis, selección de contenido, generación de llms.txt, validación, publicación y verificación pública siguen disponibles sin una cuenta externa.',
            'privacy_title' => 'Qué ocurre cuando eliges una acción',
            'privacy_1' => 'No se envía nada a Kairoseth al cargar esta página de WordPress.',
            'privacy_2' => 'Al pulsar una acción, Kairoseth se abre en una nueva pestaña únicamente con contexto acotado del producto y la plataforma.',
            'privacy_3' => 'No se adjuntan automáticamente URL del sitio, contenido llms.txt, recursos seleccionados, hallazgos, identidad del administrador, credenciales, logs ni datos de WordPress.',
            'privacy_4' => 'Tú decides qué información personal, empresarial o técnica introducir y enviar en el formulario de Kairoseth.',
            'support_title' => 'Obtener soporte de optimización',
            'support_copy' => 'Úsalo para dudas de configuración, ayuda de implementación o asesoramiento para mejorar tu flujo AI Search y llms.txt.',
            'support_cta' => 'Abrir soporte Kairoseth',
            'custom_title' => 'Solicitar una mejora a medida',
            'custom_copy' => 'Úsalo para desarrollo personalizado, integraciones, automatización o necesidades que superen el flujo Free local.',
            'custom_cta' => 'Solicitar desarrollo a medida',
            'unavailable' => 'El destino verificado de soporte Kairoseth no está disponible. No se ha enviado ningún dato y todas las funciones locales siguen disponibles.',
            'footnote' => 'Kairoseth es opcional y no es una licencia, entitlement ni requisito para desbloquear funciones del plugin Free.',
        ),
    );

    $locale = kairoseth_aiso_support_locale();
    if (isset($copy[$locale][$key])) {
        return $copy[$locale][$key];
    }
    return isset($copy['en'][$key]) ? $copy['en'][$key] : $key;
}

function kairoseth_aiso_support_bounded_version($value) {
    $value = trim((string) $value);
    if ($value === '' || strlen($value) > 40 || !preg_match('/^[A-Za-z0-9][A-Za-z0-9._+\-]*$/', $value)) {
        return '';
    }
    return $value;
}

function kairoseth_aiso_support_context() {
    $plugin_version = kairoseth_aiso_support_bounded_version(KAIROSETH_AIWR_CONNECTOR_VERSION);
    $wordpress_version = kairoseth_aiso_support_bounded_version(get_bloginfo('version'));
    if ($plugin_version === '' || $wordpress_version === '') {
        return null;
    }

    return array(
        'source' => 'extension',
        'extensionSlug' => 'ai-search-optimizer',
        'extensionName' => 'AI Search Optimizer',
        'extensionVersion' => $plugin_version,
        'hostPlatform' => 'wordpress',
        'hostPlatformVersion' => $wordpress_version,
        'locale' => kairoseth_aiso_support_locale(),
    );
}

function kairoseth_aiso_support_destination() {
    $parts = wp_parse_url(KAIROSETH_AISO_CUSTOM_REQUESTS_URL);
    if (!is_array($parts)) {
        return '';
    }

    $scheme = isset($parts['scheme']) ? strtolower((string) $parts['scheme']) : '';
    $host = isset($parts['host']) ? strtolower((string) $parts['host']) : '';
    $path = isset($parts['path']) ? (string) $parts['path'] : '';
    if ($scheme !== 'https' || $host !== 'kairoseth.com' || $path !== '/custom-requests') {
        return '';
    }

    foreach (array('user', 'pass', 'query', 'fragment', 'port') as $forbidden_part) {
        if (isset($parts[$forbidden_part]) && (string) $parts[$forbidden_part] !== '') {
            return '';
        }
    }

    return 'https://kairoseth.com/custom-requests';
}

function kairoseth_aiso_support_url($request_type) {
    $allowed = array('implementation_support', 'business_customization');
    if (!in_array($request_type, $allowed, true)) {
        return '';
    }

    $destination = kairoseth_aiso_support_destination();
    $context = kairoseth_aiso_support_context();
    if ($destination === '' || !is_array($context)) {
        return '';
    }

    $context['requestType'] = $request_type;
    $expected_keys = array(
        'source',
        'extensionSlug',
        'extensionName',
        'extensionVersion',
        'hostPlatform',
        'hostPlatformVersion',
        'locale',
        'requestType',
    );
    if (array_keys($context) !== $expected_keys) {
        return '';
    }

    return $destination . '?' . http_build_query($context, '', '&', PHP_QUERY_RFC3986);
}

function kairoseth_aiso_register_support_page() {
    add_management_page(
        kairoseth_aiso_support_text('page_title'),
        kairoseth_aiso_support_text('menu_title'),
        'manage_options',
        'ai-search-optimizer-support',
        'kairoseth_aiso_render_support_page'
    );
}
add_action('admin_menu', 'kairoseth_aiso_register_support_page');

function kairoseth_aiso_render_support_page() {
    if (!current_user_can('manage_options')) {
        wp_die(esc_html__('You do not have permission to access this page.', 'ai-search-optimizer'));
    }

    $support_url = kairoseth_aiso_support_url('implementation_support');
    $custom_url = kairoseth_aiso_support_url('business_customization');
    $available = $support_url !== '' && $custom_url !== '';
    ?>
    <div class="wrap ai-search-optimizer-support">
        <h1><?php echo esc_html(kairoseth_aiso_support_text('page_title')); ?></h1>
        <p class="description"><?php echo esc_html(kairoseth_aiso_support_text('intro')); ?></p>

        <div class="notice notice-info inline">
            <p><strong><?php echo esc_html(kairoseth_aiso_support_text('local_first_title')); ?>:</strong> <?php echo esc_html(kairoseth_aiso_support_text('local_first')); ?></p>
        </div>

        <style>
            .ai-search-optimizer-support{max-width:1000px}.ai-search-optimizer-support .aiso-support-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px;margin:20px 0}.ai-search-optimizer-support .aiso-support-card,.ai-search-optimizer-support .aiso-support-privacy{background:#fff;border:1px solid #dcdcde;border-radius:8px;padding:18px}.ai-search-optimizer-support .aiso-support-card h2,.ai-search-optimizer-support .aiso-support-privacy h2{margin-top:0}.ai-search-optimizer-support .aiso-support-list{padding-left:22px}.ai-search-optimizer-support .button{min-height:40px;display:inline-flex;align-items:center}.ai-search-optimizer-support :focus-visible{outline:2px solid currentColor;outline-offset:2px}@media(max-width:600px){.ai-search-optimizer-support .aiso-support-grid{grid-template-columns:1fr}.ai-search-optimizer-support .button{min-height:44px;width:100%;justify-content:center}}
        </style>

        <section class="aiso-support-privacy" aria-labelledby="aiso-support-privacy-title">
            <h2 id="aiso-support-privacy-title"><?php echo esc_html(kairoseth_aiso_support_text('privacy_title')); ?></h2>
            <ul class="aiso-support-list">
                <li><?php echo esc_html(kairoseth_aiso_support_text('privacy_1')); ?></li>
                <li><?php echo esc_html(kairoseth_aiso_support_text('privacy_2')); ?></li>
                <li><?php echo esc_html(kairoseth_aiso_support_text('privacy_3')); ?></li>
                <li><?php echo esc_html(kairoseth_aiso_support_text('privacy_4')); ?></li>
            </ul>
        </section>

        <?php if (!$available) : ?>
            <div class="notice notice-error inline"><p><?php echo esc_html(kairoseth_aiso_support_text('unavailable')); ?></p></div>
        <?php else : ?>
            <div class="aiso-support-grid">
                <section class="aiso-support-card" aria-labelledby="aiso-support-help-title">
                    <h2 id="aiso-support-help-title"><?php echo esc_html(kairoseth_aiso_support_text('support_title')); ?></h2>
                    <p><?php echo esc_html(kairoseth_aiso_support_text('support_copy')); ?></p>
                    <p><a class="button button-primary" href="<?php echo esc_url($support_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(kairoseth_aiso_support_text('support_cta')); ?></a></p>
                </section>
                <section class="aiso-support-card" aria-labelledby="aiso-support-custom-title">
                    <h2 id="aiso-support-custom-title"><?php echo esc_html(kairoseth_aiso_support_text('custom_title')); ?></h2>
                    <p><?php echo esc_html(kairoseth_aiso_support_text('custom_copy')); ?></p>
                    <p><a class="button" href="<?php echo esc_url($custom_url); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(kairoseth_aiso_support_text('custom_cta')); ?></a></p>
                </section>
            </div>
        <?php endif; ?>

        <p class="description"><?php echo esc_html(kairoseth_aiso_support_text('footnote')); ?></p>
    </div>
    <?php
}
