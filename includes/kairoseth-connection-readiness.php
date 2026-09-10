<?php

if (!defined('ABSPATH')) {
    exit;
}

/*
 * Compatibility loader retained for the 0.5.0 development line.
 * Phase 3A originally loaded a Kairoseth connection-readiness screen from this
 * path. The customer-facing strategy now follows the WordPress.org-first
 * local-Free + explicit contextual-support model. Managed connector REST
 * compatibility remains in the main plugin, while the admin surface is owned
 * by the privacy-bounded support module below.
 */
require_once __DIR__ . '/kairoseth-support.php';
