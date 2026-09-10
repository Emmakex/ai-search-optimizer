<?php

if (!defined('ABSPATH')) {
    exit;
}

function kairoseth_aiwr_local_locale() {
    $locale = function_exists('determine_locale') ? determine_locale() : get_locale();
    return strpos(strtolower((string) $locale), 'es') === 0 ? 'es' : 'en';
}

function kairoseth_aiwr_local_text($key) {
    $copy = array(
        'en' => array(
            'page_title' => 'AI Search Optimizer',
            'menu_title' => 'AI Search Optimizer',
            'intro' => 'Review how this WordPress site exposes public content for AI Search and prepare a deterministic llms.txt preview.',
            'privacy' => 'This local analysis does not send site content to Kairoseth, AI providers, or third-party analytics.',
            'readiness' => 'AI Search readiness',
            'inventory' => 'Eligible public content',
            'preview' => 'llms.txt preview',
            'validation' => 'Validation',
            'status_ready' => 'Ready',
            'status_warning' => 'Needs attention',
            'status_missing' => 'Not ready',
            'robots' => 'robots.txt',
            'robots_ready' => 'WordPress is configured to allow public search visibility.',
            'robots_blocked' => 'Search engine visibility is disabled in WordPress Reading settings.',
            'sitemap' => 'Sitemap',
            'sitemap_ready' => 'A WordPress sitemap endpoint is available.',
            'sitemap_missing' => 'No WordPress sitemap endpoint is currently available.',
            'llms' => 'llms.txt',
            'llms_ready' => 'A valid site-local llms.txt deployment is stored.',
            'llms_missing' => 'No valid site-local llms.txt has been published yet.',
            'type' => 'Type',
            'title' => 'Title',
            'url' => 'Public URL',
            'no_content' => 'No eligible public WordPress content was found.',
            'inventory_limit' => 'The local preview uses up to 100 eligible public resources for a bounded admin experience.',
            'preview_help' => 'The preview is generated only from public WordPress content. It contains no timestamps, so unchanged site input produces unchanged output.',
            'valid' => 'Valid preview',
            'invalid' => 'Preview needs attention',
            'resources' => 'resources',
            'bytes' => 'bytes',
            'sha256' => 'SHA-256',
            'woocommerce' => 'WooCommerce',
            'woocommerce_detected' => 'WooCommerce is active; public products are eligible for the local inventory.',
            'woocommerce_not_detected' => 'WooCommerce is not active on this site.',
            'multisite' => 'Multisite',
            'multisite_site' => 'This analysis is isolated to the current site in the WordPress network.',
            'single_site' => 'This is a single-site WordPress installation.',
            'finding_missing_heading' => 'The preview must start with a top-level title.',
            'finding_too_large' => 'The preview exceeds the maximum allowed llms.txt size.',
            'finding_invalid_home_url' => 'The WordPress home URL is not valid for local validation.',
            'finding_no_resources' => 'The preview does not contain any public HTTP(S) resources.',
            'finding_duplicate_url' => 'The preview contains a duplicate resource URL.',
            'finding_external_url' => 'The local preview contains a URL outside this WordPress site.',
        ),
        'es' => array(
            'page_title' => 'AI Search Optimizer',
            'menu_title' => 'AI Search Optimizer',
            'intro' => 'Revisa cómo este sitio WordPress expone contenido público para AI Search y prepara una vista previa determinista de llms.txt.',
            'privacy' => 'Este análisis local no envía contenido del sitio a Kairoseth, proveedores de IA ni analítica de terceros.',
            'readiness' => 'Preparación para AI Search',
            'inventory' => 'Contenido público elegible',
            'preview' => 'Vista previa de llms.txt',
            'validation' => 'Validación',
            'status_ready' => 'Correcto',
            'status_warning' => 'Requiere atención',
            'status_missing' => 'No preparado',
            'robots' => 'robots.txt',
            'robots_ready' => 'WordPress está configurado para permitir visibilidad pública en buscadores.',
            'robots_blocked' => 'La visibilidad para motores de búsqueda está desactivada en los ajustes de Lectura de WordPress.',
            'sitemap' => 'Sitemap',
            'sitemap_ready' => 'Hay disponible un endpoint de sitemap de WordPress.',
            'sitemap_missing' => 'Actualmente no hay disponible un endpoint de sitemap de WordPress.',
            'llms' => 'llms.txt',
            'llms_ready' => 'Existe un despliegue llms.txt local válido guardado para este sitio.',
            'llms_missing' => 'Todavía no se ha publicado un llms.txt local válido.',
            'type' => 'Tipo',
            'title' => 'Título',
            'url' => 'URL pública',
            'no_content' => 'No se encontró contenido público de WordPress elegible.',
            'inventory_limit' => 'La vista previa local utiliza hasta 100 recursos públicos elegibles para mantener acotada la experiencia del administrador.',
            'preview_help' => 'La vista previa se genera solo desde contenido público de WordPress. No contiene fechas de generación, por lo que la misma entrada produce la misma salida.',
            'valid' => 'Vista previa válida',
            'invalid' => 'La vista previa requiere atención',
            'resources' => 'recursos',
            'bytes' => 'bytes',
            'sha256' => 'SHA-256',
            'woocommerce' => 'WooCommerce',
            'woocommerce_detected' => 'WooCommerce está activo; los productos públicos son elegibles para el inventario local.',
            'woocommerce_not_detected' => 'WooCommerce no está activo en este sitio.',
            'multisite' => 'Multisite',
            'multisite_site' => 'Este análisis está aislado al sitio actual dentro de la red WordPress.',
            'single_site' => 'Esta instalación de WordPress es single-site.',
            'finding_missing_heading' => 'La vista previa debe comenzar con un título de primer nivel.',
            'finding_too_large' => 'La vista previa supera el tamaño máximo permitido para llms.txt.',
            'finding_invalid_home_url' => 'La URL principal de WordPress no es válida para la validación local.',
            'finding_no_resources' => 'La vista previa no contiene recursos públicos HTTP(S).',
            'finding_duplicate_url' => 'La vista previa contiene una URL de recurso duplicada.',
            'finding_external_url' => 'La vista previa local contiene una URL externa a este sitio WordPress.',
        ),
    );

    $locale = kairoseth_aiwr_local_locale();
    if (isset($copy[$locale][$key])) {
        return $copy[$locale][$key];
    }
    return isset($copy['en'][$key]) ? $copy['en'][$key] : $key;
}

function kairoseth_aiwr_local_public_post_types() {
    $objects = get_post_types(array('public' => true), 'objects');
    $result = array();
    foreach ((array) $objects as $name => $object) {
        if (in_array($name, array('attachment', 'product_variation'), true)) {
            continue;
        }
        $result[$name] = $object;
    }
    return $result;
}

function kairoseth_aiwr_local_inventory($limit = 100) {
    $limit = max(1, min(100, (int) $limit));
    $types = kairoseth_aiwr_local_public_post_types();
    if ($types === array()) {
        return array();
    }

    $per_type = max(5, (int) ceil($limit / max(1, count($types))));
    $items = array();

    foreach ($types as $type => $object) {
        $posts = get_posts(
            array(
                'post_type' => $type,
                'post_status' => 'publish',
                'numberposts' => $per_type,
                'orderby' => 'menu_order title',
                'order' => 'ASC',
                'has_password' => false,
                'suppress_filters' => false,
            )
        );

        foreach ($posts as $post) {
            $url = get_permalink($post);
            if (!is_string($url) || $url === '') {
                continue;
            }

            $raw_description = isset($post->post_excerpt) && $post->post_excerpt !== ''
                ? $post->post_excerpt
                : (isset($post->post_content) ? strip_shortcodes($post->post_content) : '');

            $items[] = array(
                'id' => isset($post->ID) ? (int) $post->ID : 0,
                'type' => $type,
                'typeLabel' => isset($object->labels->name) ? (string) $object->labels->name : ucfirst($type),
                'title' => get_the_title($post),
                'url' => $url,
                'description' => kairoseth_aiwr_local_plain_text($raw_description, 180),
            );
        }
    }

    return array_slice(kairoseth_aiwr_local_sort_inventory($items), 0, $limit);
}

function kairoseth_aiwr_local_readiness() {
    $robots_ready = (string) get_option('blog_public', '1') === '1';
    $sitemap_url = function_exists('get_sitemap_url') ? get_sitemap_url('index') : '';
    $sitemap_ready = is_string($sitemap_url) && $sitemap_url !== '';

    $deployment = get_option(KAIROSETH_AIWR_DEPLOYMENT_OPTION, null);
    $llms_ready = false;
    if (
        is_array($deployment) &&
        isset($deployment['content'], $deployment['contentHash']) &&
        is_string($deployment['content']) &&
        is_string($deployment['contentHash']) &&
        preg_match('/^[a-f0-9]{64}$/', $deployment['contentHash']) &&
        hash_equals($deployment['contentHash'], hash('sha256', $deployment['content']))
    ) {
        $llms_ready = true;
    }

    return array(
        array(
            'key' => 'robots',
            'status' => $robots_ready ? 'ready' : 'warning',
            'url' => home_url('/robots.txt'),
            'message' => $robots_ready ? 'robots_ready' : 'robots_blocked',
        ),
        array(
            'key' => 'sitemap',
            'status' => $sitemap_ready ? 'ready' : 'warning',
            'url' => $sitemap_ready ? $sitemap_url : home_url('/wp-sitemap.xml'),
            'message' => $sitemap_ready ? 'sitemap_ready' : 'sitemap_missing',
        ),
        array(
            'key' => 'llms',
            'status' => $llms_ready ? 'ready' : 'missing',
            'url' => home_url('/llms.txt'),
            'message' => $llms_ready ? 'llms_ready' : 'llms_missing',
        ),
    );
}

function kairoseth_aiwr_local_finding_text($finding) {
    $code = isset($finding['code']) ? (string) $finding['code'] : '';
    $message = kairoseth_aiwr_local_text('finding_' . $code);
    if (isset($finding['value']) && is_string($finding['value']) && $finding['value'] !== '') {
        $message .= ' ' . $finding['value'];
    }
    return $message;
}

function kairoseth_aiwr_local_register_admin_page() {
    add_management_page(
        kairoseth_aiwr_local_text('page_title'),
        kairoseth_aiwr_local_text('menu_title'),
        KAIROSETH_AIWR_CAPABILITY,
        'ai-search-optimizer',
        'kairoseth_aiwr_local_render_admin_page'
    );
}
add_action('admin_menu', 'kairoseth_aiwr_local_register_admin_page');

function kairoseth_aiwr_local_render_admin_page() {
    if (!current_user_can(KAIROSETH_AIWR_CAPABILITY)) {
        wp_die(esc_html__('You do not have permission to access this page.', 'ai-search-optimizer'));
    }

    $inventory = kairoseth_aiwr_local_inventory(100);
    $site = array(
        'name' => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'homeUrl' => home_url('/'),
    );
    $preview = kairoseth_aiwr_local_build_llms($site, $inventory);
    $validation = kairoseth_aiwr_local_validate_llms($preview, $site['homeUrl'], KAIROSETH_AIWR_MAX_CONTENT_BYTES);
    $readiness = kairoseth_aiwr_local_readiness();
    $woocommerce_active = class_exists('WooCommerce');
    $is_multisite = is_multisite();
    ?>
    <div class="wrap ai-search-optimizer-local">
        <h1><?php echo esc_html(kairoseth_aiwr_local_text('page_title')); ?></h1>
        <p class="description"><?php echo esc_html(kairoseth_aiwr_local_text('intro')); ?></p>
        <div class="notice notice-info inline"><p><strong><?php echo esc_html(kairoseth_aiwr_local_text('privacy')); ?></strong></p></div>

        <style>
            .ai-search-optimizer-local .aiso-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;max-width:1100px;margin:18px 0}.ai-search-optimizer-local .aiso-card{background:#fff;border:1px solid #dcdcde;border-radius:8px;padding:16px}.ai-search-optimizer-local .aiso-card h3{margin-top:0}.ai-search-optimizer-local .aiso-status{display:inline-block;padding:3px 8px;border-radius:999px;background:#f0f0f1;font-weight:600}.ai-search-optimizer-local .aiso-ready{background:#edfaef;color:#0a5c16}.ai-search-optimizer-local .aiso-warning{background:#fff8e5;color:#6e4b00}.ai-search-optimizer-local .aiso-missing{background:#fcf0f1;color:#8a2424}.ai-search-optimizer-local textarea{width:100%;max-width:1100px;font-family:monospace;min-height:360px}.ai-search-optimizer-local .aiso-meta{display:flex;gap:18px;flex-wrap:wrap;margin:8px 0 14px}.ai-search-optimizer-local .widefat{max-width:1100px}.ai-search-optimizer-local code{word-break:break-all}
        </style>

        <h2><?php echo esc_html(kairoseth_aiwr_local_text('readiness')); ?></h2>
        <div class="aiso-grid">
            <?php foreach ($readiness as $check) : ?>
                <section class="aiso-card">
                    <h3><?php echo esc_html(kairoseth_aiwr_local_text($check['key'])); ?></h3>
                    <p><span class="aiso-status aiso-<?php echo esc_attr($check['status']); ?>"><?php echo esc_html(kairoseth_aiwr_local_text('status_' . $check['status'])); ?></span></p>
                    <p><?php echo esc_html(kairoseth_aiwr_local_text($check['message'])); ?></p>
                    <p><a href="<?php echo esc_url($check['url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($check['url']); ?></a></p>
                </section>
            <?php endforeach; ?>
            <section class="aiso-card">
                <h3><?php echo esc_html(kairoseth_aiwr_local_text('woocommerce')); ?></h3>
                <p><?php echo esc_html(kairoseth_aiwr_local_text($woocommerce_active ? 'woocommerce_detected' : 'woocommerce_not_detected')); ?></p>
            </section>
            <section class="aiso-card">
                <h3><?php echo esc_html(kairoseth_aiwr_local_text('multisite')); ?></h3>
                <p><?php echo esc_html(kairoseth_aiwr_local_text($is_multisite ? 'multisite_site' : 'single_site')); ?></p>
            </section>
        </div>

        <h2><?php echo esc_html(kairoseth_aiwr_local_text('inventory')); ?></h2>
        <p><?php echo esc_html(kairoseth_aiwr_local_text('inventory_limit')); ?></p>
        <?php if ($inventory === array()) : ?>
            <p><?php echo esc_html(kairoseth_aiwr_local_text('no_content')); ?></p>
        <?php else : ?>
            <table class="widefat striped">
                <thead><tr><th><?php echo esc_html(kairoseth_aiwr_local_text('type')); ?></th><th><?php echo esc_html(kairoseth_aiwr_local_text('title')); ?></th><th><?php echo esc_html(kairoseth_aiwr_local_text('url')); ?></th></tr></thead>
                <tbody>
                    <?php foreach ($inventory as $item) : ?>
                        <tr>
                            <td><?php echo esc_html($item['typeLabel']); ?></td>
                            <td><?php echo esc_html($item['title']); ?></td>
                            <td><a href="<?php echo esc_url($item['url']); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html($item['url']); ?></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <h2><?php echo esc_html(kairoseth_aiwr_local_text('preview')); ?></h2>
        <p><?php echo esc_html(kairoseth_aiwr_local_text('preview_help')); ?></p>
        <textarea readonly aria-label="<?php echo esc_attr(kairoseth_aiwr_local_text('preview')); ?>"><?php echo esc_textarea($preview); ?></textarea>

        <h2><?php echo esc_html(kairoseth_aiwr_local_text('validation')); ?></h2>
        <p><strong><?php echo esc_html(kairoseth_aiwr_local_text($validation['valid'] ? 'valid' : 'invalid')); ?></strong></p>
        <div class="aiso-meta">
            <span><?php echo esc_html((string) $validation['resourceCount'] . ' ' . kairoseth_aiwr_local_text('resources')); ?></span>
            <span><?php echo esc_html((string) $validation['byteCount'] . ' ' . kairoseth_aiwr_local_text('bytes')); ?></span>
            <span><?php echo esc_html(kairoseth_aiwr_local_text('sha256')); ?>: <code><?php echo esc_html($validation['contentHash']); ?></code></span>
        </div>
        <?php if ($validation['findings'] !== array()) : ?>
            <ul>
                <?php foreach ($validation['findings'] as $finding) : ?>
                    <li><?php echo esc_html(kairoseth_aiwr_local_finding_text($finding)); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php
}
