<?php

if (!defined('ABSPATH')) {
    exit;
}

const KAIROSETH_AISO_PLATFORM_APP_URL = 'https://kairoseth.com/app';

function kairoseth_aiso_connection_locale() {
    if (function_exists('kairoseth_aiwr_local_locale')) {
        return kairoseth_aiwr_local_locale();
    }
    $locale = function_exists('determine_locale') ? determine_locale() : get_locale();
    return strpos(strtolower((string) $locale), 'es') === 0 ? 'es' : 'en';
}

function kairoseth_aiso_connection_text($key) {
    $copy = array(
        'en' => array(
            'page_title' => 'Connect AI Search Optimizer to Kairoseth',
            'menu_title' => 'AI Search Optimizer · Kairoseth',
            'intro' => 'Use this page to confirm that this exact WordPress site is ready for the optional Kairoseth connection. The local Free workflow keeps working without a Kairoseth account.',
            'privacy' => 'This readiness page makes no request to Kairoseth and sends no site content, credentials, analytics, or connection state. Kairoseth opens only when you choose the button below.',
            'readiness_title' => 'Connection readiness',
            'ready' => 'Ready to connect',
            'blocked' => 'Needs attention before connecting',
            'https' => 'HTTPS site root',
            'https_ready' => 'The exact WordPress home URL uses HTTPS.',
            'https_blocked' => 'Kairoseth managed WordPress connections require an HTTPS site root.',
            'app_passwords' => 'WordPress Application Passwords',
            'app_passwords_ready' => 'WordPress reports Application Passwords as available.',
            'app_passwords_blocked' => 'Application Passwords are not currently available. Check HTTPS and security-plugin policy before connecting.',
            'role' => 'Least-privilege deployer role',
            'role_ready' => 'The Kairoseth AI Web Deployer role is available with the dedicated deployment capability.',
            'role_blocked' => 'The dedicated deployer role/capability is not available. Reactivate the plugin or repair its setup before connecting.',
            'identity_title' => 'Exact WordPress identity',
            'home_url' => 'WordPress root',
            'rest_endpoint' => 'Connection endpoint',
            'target_url' => 'llms.txt target',
            'blog_id' => 'Blog ID',
            'network_id' => 'Network ID',
            'single_site' => 'Single site',
            'multisite' => 'Multisite',
            'not_applicable' => 'Not applicable',
            'guide_title' => 'Connect with least privilege',
            'step_1' => 'An administrator creates or chooses a dedicated WordPress user and assigns the Kairoseth AI Web Deployer role.',
            'step_2' => 'In that user profile, create a WordPress Application Password for Kairoseth. Treat it like a password and copy it only when you are ready to connect.',
            'step_3' => 'Open Kairoseth, choose your authorized organization and AI Search Optimizer site, then enter the dedicated WordPress username and Application Password once.',
            'step_4' => 'Kairoseth validates this exact Blog ID / Network ID / home URL before storing the credential encrypted server-side. The credential is never returned to this WordPress page.',
            'step_5' => 'If you disconnect later, remove the connection in Kairoseth and revoke that Application Password in WordPress.',
            'create_user' => 'Create dedicated WordPress user',
            'admin_required' => 'A WordPress administrator with user-management permission must create or configure the dedicated user.',
            'open_kairoseth' => 'Open Kairoseth AI Search Optimizer',
            'handoff_note' => 'The handoff URL contains no site identifier, username, Application Password, token, or organization information. Kairoseth resolves access from the authenticated account.',
            'status_note' => 'Ready means this WordPress side satisfies the local prerequisites. It does not claim that Kairoseth has already validated or stored a connection.',
        ),
        'es' => array(
            'page_title' => 'Conectar AI Search Optimizer con Kairoseth',
            'menu_title' => 'AI Search Optimizer · Kairoseth',
            'intro' => 'Usa esta página para comprobar que este sitio WordPress exacto está preparado para la conexión opcional con Kairoseth. El flujo Free local sigue funcionando sin una cuenta Kairoseth.',
            'privacy' => 'Esta comprobación no hace ninguna petición a Kairoseth ni envía contenido, credenciales, analítica o estado de conexión. Kairoseth solo se abre cuando eliges el botón de abajo.',
            'readiness_title' => 'Preparación de la conexión',
            'ready' => 'Listo para conectar',
            'blocked' => 'Requiere atención antes de conectar',
            'https' => 'Raíz HTTPS',
            'https_ready' => 'La URL principal exacta de WordPress utiliza HTTPS.',
            'https_blocked' => 'Las conexiones WordPress gestionadas por Kairoseth requieren una raíz HTTPS.',
            'app_passwords' => 'Application Passwords de WordPress',
            'app_passwords_ready' => 'WordPress informa que las Application Passwords están disponibles.',
            'app_passwords_blocked' => 'Las Application Passwords no están disponibles actualmente. Revisa HTTPS y la política del plugin de seguridad antes de conectar.',
            'role' => 'Rol de despliegue de mínimo privilegio',
            'role_ready' => 'El rol Kairoseth AI Web Deployer está disponible con la capability de despliegue dedicada.',
            'role_blocked' => 'El rol/capability de despliegue no está disponible. Reactiva el plugin o repara su configuración antes de conectar.',
            'identity_title' => 'Identidad WordPress exacta',
            'home_url' => 'Raíz WordPress',
            'rest_endpoint' => 'Endpoint de conexión',
            'target_url' => 'Destino llms.txt',
            'blog_id' => 'Blog ID',
            'network_id' => 'Network ID',
            'single_site' => 'Single site',
            'multisite' => 'Multisite',
            'not_applicable' => 'No aplica',
            'guide_title' => 'Conectar con mínimo privilegio',
            'step_1' => 'Un administrador crea o elige un usuario WordPress dedicado y le asigna el rol Kairoseth AI Web Deployer.',
            'step_2' => 'En el perfil de ese usuario crea una Application Password de WordPress para Kairoseth. Trátala como una contraseña y cópiala solo cuando vayas a conectar.',
            'step_3' => 'Abre Kairoseth, elige tu organización autorizada y el sitio de AI Search Optimizer, y usa una sola vez el usuario WordPress dedicado y la Application Password.',
            'step_4' => 'Kairoseth valida este Blog ID / Network ID / home URL exactos antes de guardar la credencial cifrada server-side. La credencial nunca vuelve a esta página WordPress.',
            'step_5' => 'Si desconectas más adelante, elimina la conexión en Kairoseth y revoca también esa Application Password en WordPress.',
            'create_user' => 'Crear usuario WordPress dedicado',
            'admin_required' => 'Un administrador WordPress con permiso para gestionar usuarios debe crear o configurar el usuario dedicado.',
            'open_kairoseth' => 'Abrir Kairoseth AI Search Optimizer',
            'handoff_note' => 'La URL de acceso no contiene identificador del sitio, usuario, Application Password, token ni datos de organización. Kairoseth resuelve el acceso desde la cuenta autenticada.',
            'status_note' => '“Listo” significa que WordPress cumple los prerrequisitos locales. No afirma que Kairoseth ya haya validado o guardado una conexión.',
        ),
    );

    $locale = kairoseth_aiso_connection_locale();
    if (isset($copy[$locale][$key])) {
        return $copy[$locale][$key];
    }
    return isset($copy['en'][$key]) ? $copy['en'][$key] : $key;
}

function kairoseth_aiso_connection_home_is_https($home_url) {
    $scheme = wp_parse_url((string) $home_url, PHP_URL_SCHEME);
    return is_string($scheme) && strtolower($scheme) === 'https';
}

function kairoseth_aiso_application_passwords_available() {
    return function_exists('wp_is_application_passwords_available')
        && (bool) wp_is_application_passwords_available();
}

function kairoseth_aiso_connection_readiness() {
    $identity = kairoseth_aiwr_site_identity();
    $role = get_role(KAIROSETH_AIWR_DEPLOYER_ROLE);
    $role_ready = $role && $role->has_cap(KAIROSETH_AIWR_CAPABILITY);
    $https_ready = kairoseth_aiso_connection_home_is_https($identity['homeUrl']);
    $application_passwords_ready = kairoseth_aiso_application_passwords_available();

    return array(
        'ready' => $https_ready && $application_passwords_ready && $role_ready,
        'https' => $https_ready,
        'applicationPasswords' => $application_passwords_ready,
        'role' => (bool) $role_ready,
        'identity' => $identity,
        'connectionEndpoint' => trailingslashit($identity['restUrl']) . 'connection',
    );
}

function kairoseth_aiso_register_connection_page() {
    add_management_page(
        kairoseth_aiso_connection_text('page_title'),
        kairoseth_aiso_connection_text('menu_title'),
        KAIROSETH_AIWR_CAPABILITY,
        'ai-search-optimizer-kairoseth',
        'kairoseth_aiso_render_connection_page'
    );
}
add_action('admin_menu', 'kairoseth_aiso_register_connection_page');

function kairoseth_aiso_render_readiness_item($label_key, $ready, $ready_key, $blocked_key) {
    ?>
    <section class="aiso-kairoseth-card">
        <h3><?php echo esc_html(kairoseth_aiso_connection_text($label_key)); ?></h3>
        <p><span class="aiso-kairoseth-status <?php echo $ready ? 'is-ready' : 'is-blocked'; ?>"><?php echo esc_html(kairoseth_aiso_connection_text($ready ? 'ready' : 'blocked')); ?></span></p>
        <p><?php echo esc_html(kairoseth_aiso_connection_text($ready ? $ready_key : $blocked_key)); ?></p>
    </section>
    <?php
}

function kairoseth_aiso_render_connection_page() {
    if (!current_user_can(KAIROSETH_AIWR_CAPABILITY)) {
        wp_die(esc_html__('You do not have permission to access this page.', 'ai-search-optimizer'));
    }

    $readiness = kairoseth_aiso_connection_readiness();
    $identity = $readiness['identity'];
    ?>
    <div class="wrap ai-search-optimizer-kairoseth">
        <h1><?php echo esc_html(kairoseth_aiso_connection_text('page_title')); ?></h1>
        <p class="description"><?php echo esc_html(kairoseth_aiso_connection_text('intro')); ?></p>
        <div class="notice notice-info inline"><p><strong><?php echo esc_html(kairoseth_aiso_connection_text('privacy')); ?></strong></p></div>

        <style>
            .ai-search-optimizer-kairoseth{max-width:1100px}.ai-search-optimizer-kairoseth .aiso-kairoseth-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;margin:18px 0}.ai-search-optimizer-kairoseth .aiso-kairoseth-card{background:#fff;border:1px solid #dcdcde;border-radius:8px;padding:16px;min-width:0}.ai-search-optimizer-kairoseth .aiso-kairoseth-card h3{margin-top:0}.ai-search-optimizer-kairoseth .aiso-kairoseth-status{display:inline-block;padding:3px 8px;border-radius:999px;background:#f0f0f1;font-weight:600}.ai-search-optimizer-kairoseth .aiso-kairoseth-status.is-ready{background:#edfaef;color:#0a5c16}.ai-search-optimizer-kairoseth .aiso-kairoseth-status.is-blocked{background:#fff8e5;color:#6e4b00}.ai-search-optimizer-kairoseth .aiso-kairoseth-identity{background:#fff;border:1px solid #dcdcde;border-radius:8px;padding:16px;margin:12px 0 20px}.ai-search-optimizer-kairoseth .aiso-kairoseth-identity dt{font-weight:600;margin-top:10px}.ai-search-optimizer-kairoseth .aiso-kairoseth-identity dd{margin:3px 0 0;overflow-wrap:anywhere}.ai-search-optimizer-kairoseth .aiso-kairoseth-actions{display:flex;gap:10px;align-items:center;flex-wrap:wrap;margin:18px 0}.ai-search-optimizer-kairoseth .button{min-height:40px;display:inline-flex;align-items:center}.ai-search-optimizer-kairoseth :focus-visible{outline:2px solid currentColor;outline-offset:2px}@media(max-width:600px){.ai-search-optimizer-kairoseth .aiso-kairoseth-grid{grid-template-columns:1fr}.ai-search-optimizer-kairoseth .aiso-kairoseth-actions{align-items:stretch;flex-direction:column}.ai-search-optimizer-kairoseth .aiso-kairoseth-actions .button{justify-content:center;width:100%;min-height:44px}}
        </style>

        <h2><?php echo esc_html(kairoseth_aiso_connection_text('readiness_title')); ?></h2>
        <p><strong><?php echo esc_html(kairoseth_aiso_connection_text($readiness['ready'] ? 'ready' : 'blocked')); ?></strong></p>
        <p><?php echo esc_html(kairoseth_aiso_connection_text('status_note')); ?></p>
        <div class="aiso-kairoseth-grid">
            <?php kairoseth_aiso_render_readiness_item('https', $readiness['https'], 'https_ready', 'https_blocked'); ?>
            <?php kairoseth_aiso_render_readiness_item('app_passwords', $readiness['applicationPasswords'], 'app_passwords_ready', 'app_passwords_blocked'); ?>
            <?php kairoseth_aiso_render_readiness_item('role', $readiness['role'], 'role_ready', 'role_blocked'); ?>
        </div>

        <h2><?php echo esc_html(kairoseth_aiso_connection_text('identity_title')); ?></h2>
        <dl class="aiso-kairoseth-identity">
            <dt><?php echo esc_html(kairoseth_aiso_connection_text('home_url')); ?></dt><dd><code><?php echo esc_html($identity['homeUrl']); ?></code></dd>
            <dt><?php echo esc_html(kairoseth_aiso_connection_text('rest_endpoint')); ?></dt><dd><code><?php echo esc_html($readiness['connectionEndpoint']); ?></code></dd>
            <dt><?php echo esc_html(kairoseth_aiso_connection_text('target_url')); ?></dt><dd><code><?php echo esc_html($identity['targetUrl']); ?></code></dd>
            <dt><?php echo esc_html(kairoseth_aiso_connection_text('blog_id')); ?></dt><dd><?php echo esc_html((string) $identity['blogId']); ?></dd>
            <dt><?php echo esc_html(kairoseth_aiso_connection_text('network_id')); ?></dt><dd><?php echo $identity['networkId'] === null ? esc_html(kairoseth_aiso_connection_text('not_applicable')) : esc_html((string) $identity['networkId']); ?></dd>
            <dt><?php echo esc_html(kairoseth_aiso_connection_text('multisite')); ?></dt><dd><?php echo esc_html(kairoseth_aiso_connection_text($identity['isMultisite'] ? 'multisite' : 'single_site')); ?></dd>
        </dl>

        <h2><?php echo esc_html(kairoseth_aiso_connection_text('guide_title')); ?></h2>
        <ol>
            <li><?php echo esc_html(kairoseth_aiso_connection_text('step_1')); ?></li>
            <li><?php echo esc_html(kairoseth_aiso_connection_text('step_2')); ?></li>
            <li><?php echo esc_html(kairoseth_aiso_connection_text('step_3')); ?></li>
            <li><?php echo esc_html(kairoseth_aiso_connection_text('step_4')); ?></li>
            <li><?php echo esc_html(kairoseth_aiso_connection_text('step_5')); ?></li>
        </ol>
        <div class="aiso-kairoseth-actions">
            <?php if (current_user_can('create_users')) : ?>
                <a class="button" href="<?php echo esc_url(admin_url('user-new.php')); ?>"><?php echo esc_html(kairoseth_aiso_connection_text('create_user')); ?></a>
            <?php else : ?>
                <span><?php echo esc_html(kairoseth_aiso_connection_text('admin_required')); ?></span>
            <?php endif; ?>
            <a class="button button-primary" href="<?php echo esc_url(KAIROSETH_AISO_PLATFORM_APP_URL); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html(kairoseth_aiso_connection_text('open_kairoseth')); ?></a>
        </div>
        <p class="description"><?php echo esc_html(kairoseth_aiso_connection_text('handoff_note')); ?></p>
    </div>
    <?php
}
