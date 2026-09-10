<?php

if (!defined('ABSPATH')) {
    exit;
}

/*
 * Compatibility shim retained during the 0.5.0 development line so older
 * source references do not fatal while the public WordPress.org-facing UX
 * moves to the local-first contextual support/custom-improvement model.
 */
require_once __DIR__ . '/contextual-support.php';
