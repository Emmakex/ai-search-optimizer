<?php

if (!defined('ABSPATH') && PHP_SAPI !== 'cli') {
    exit;
}

function kairoseth_aiwr_local_plain_text($value, $max_length = 180) {
    $text = is_string($value) ? $value : '';
    $text = html_entity_decode(strip_tags($text), ENT_QUOTES, 'UTF-8');
    $text = preg_replace('/\s+/u', ' ', $text);
    $text = trim(is_string($text) ? $text : '');

    if ($max_length <= 0) {
        return $text;
    }

    if (function_exists('mb_strlen') && function_exists('mb_substr')) {
        if (mb_strlen($text, 'UTF-8') <= $max_length) {
            return $text;
        }
        return rtrim(mb_substr($text, 0, $max_length - 1, 'UTF-8')) . '…';
    }

    if (strlen($text) <= $max_length) {
        return $text;
    }
    return rtrim(substr($text, 0, $max_length - 3)) . '...';
}

function kairoseth_aiwr_local_markdown_text($value, $max_length = 180) {
    $text = kairoseth_aiwr_local_plain_text($value, $max_length);
    return str_replace(
        array('\\', '[', ']', '(', ')'),
        array('\\\\', '\\[', '\\]', '\\(', '\\)'),
        $text
    );
}

function kairoseth_aiwr_local_type_priority($type) {
    $priorities = array(
        'page' => 10,
        'product' => 20,
        'post' => 30,
    );
    return isset($priorities[$type]) ? $priorities[$type] : 40;
}

function kairoseth_aiwr_local_sort_inventory($inventory) {
    $normalized = array();
    foreach ((array) $inventory as $item) {
        if (!is_array($item)) {
            continue;
        }
        $title = isset($item['title']) ? kairoseth_aiwr_local_plain_text($item['title'], 180) : '';
        $url = isset($item['url']) && is_string($item['url']) ? trim($item['url']) : '';
        if ($title === '' || $url === '') {
            continue;
        }
        $normalized[] = array(
            'id' => isset($item['id']) ? (int) $item['id'] : 0,
            'type' => isset($item['type']) && is_string($item['type']) ? $item['type'] : 'content',
            'typeLabel' => isset($item['typeLabel']) ? kairoseth_aiwr_local_plain_text($item['typeLabel'], 80) : 'Content',
            'title' => $title,
            'url' => $url,
            'description' => isset($item['description']) ? kairoseth_aiwr_local_plain_text($item['description'], 180) : '',
        );
    }

    usort($normalized, function ($left, $right) {
        $priority = kairoseth_aiwr_local_type_priority($left['type']) <=> kairoseth_aiwr_local_type_priority($right['type']);
        if ($priority !== 0) {
            return $priority;
        }
        $type = strcasecmp($left['typeLabel'], $right['typeLabel']);
        if ($type !== 0) {
            return $type;
        }
        $title = strcasecmp($left['title'], $right['title']);
        if ($title !== 0) {
            return $title;
        }
        return strcmp($left['url'], $right['url']);
    });

    return $normalized;
}

function kairoseth_aiwr_local_build_llms($site, $inventory) {
    $site = is_array($site) ? $site : array();
    $name = isset($site['name']) ? kairoseth_aiwr_local_markdown_text($site['name'], 180) : '';
    $description = isset($site['description']) ? kairoseth_aiwr_local_markdown_text($site['description'], 240) : '';
    $home_url = isset($site['homeUrl']) && is_string($site['homeUrl']) ? trim($site['homeUrl']) : '';
    $items = kairoseth_aiwr_local_sort_inventory($inventory);

    if ($name === '') {
        $name = 'Website';
    }

    $lines = array('# ' . $name, '');
    if ($description !== '') {
        $lines[] = '> ' . $description;
        $lines[] = '';
    }

    if ($home_url !== '') {
        $lines[] = '## Main';
        $lines[] = '';
        $lines[] = '- [' . $name . '](' . $home_url . ')';
        $lines[] = '';
    }

    $groups = array();
    foreach ($items as $item) {
        $label = $item['typeLabel'] !== '' ? $item['typeLabel'] : 'Content';
        if (!isset($groups[$label])) {
            $groups[$label] = array();
        }
        $groups[$label][] = $item;
    }

    foreach ($groups as $label => $group) {
        $lines[] = '## ' . kairoseth_aiwr_local_markdown_text($label, 80);
        $lines[] = '';
        foreach ($group as $item) {
            $line = '- [' . kairoseth_aiwr_local_markdown_text($item['title'], 180) . '](' . $item['url'] . ')';
            if ($item['description'] !== '') {
                $line .= ': ' . kairoseth_aiwr_local_markdown_text($item['description'], 180);
            }
            $lines[] = $line;
        }
        $lines[] = '';
    }

    return rtrim(implode("\n", $lines)) . "\n";
}

function kairoseth_aiwr_local_validate_llms($content, $home_url, $max_bytes = 524288) {
    $content = is_string($content) ? $content : '';
    $home_url = is_string($home_url) ? trim($home_url) : '';
    $findings = array();

    if ($content === '' || !preg_match('/^#\s+\S/m', $content)) {
        $findings[] = array('code' => 'missing_heading', 'severity' => 'error');
    }

    $byte_count = strlen($content);
    if ($byte_count > (int) $max_bytes) {
        $findings[] = array('code' => 'too_large', 'severity' => 'error');
    }

    $home_host = parse_url($home_url, PHP_URL_HOST);
    if (!is_string($home_host) || $home_host === '') {
        $findings[] = array('code' => 'invalid_home_url', 'severity' => 'error');
        $home_host = '';
    }

    preg_match_all('/\]\((https?:\/\/[^)\s]+)\)/i', $content, $matches);
    $urls = isset($matches[1]) && is_array($matches[1]) ? $matches[1] : array();
    if ($urls === array()) {
        $findings[] = array('code' => 'no_resources', 'severity' => 'error');
    }

    $seen = array();
    foreach ($urls as $url) {
        $key = strtolower($url);
        if (isset($seen[$key])) {
            $findings[] = array('code' => 'duplicate_url', 'severity' => 'error', 'value' => $url);
            continue;
        }
        $seen[$key] = true;

        $host = parse_url($url, PHP_URL_HOST);
        if (!is_string($host) || $host === '' || ($home_host !== '' && strcasecmp($home_host, $host) !== 0)) {
            $findings[] = array('code' => 'external_url', 'severity' => 'error', 'value' => $url);
        }
    }

    $valid = true;
    foreach ($findings as $finding) {
        if (isset($finding['severity']) && $finding['severity'] === 'error') {
            $valid = false;
            break;
        }
    }

    return array(
        'valid' => $valid,
        'resourceCount' => count($urls),
        'byteCount' => $byte_count,
        'contentHash' => hash('sha256', $content),
        'findings' => $findings,
    );
}
