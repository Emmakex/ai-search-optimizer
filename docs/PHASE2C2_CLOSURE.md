# Phase 2C2 Closure — WordPress/PHP Runtime Compatibility

Status: **Accepted**  
Date: **10 September 2026**

## Accepted scope

Phase 2C2 proves the generated AI Search Optimizer ZIP in representative real WordPress/PHP runtimes rather than relying only on static contract tests.

Accepted matrix:

```text
WordPress 5.6 / PHP 7.4   PASS
WordPress 6.8 / PHP 8.2   PASS
WordPress 7.1 / PHP 8.3   PASS
```

Each row installs the built ZIP and exercises:

- activation and setup state;
- administrator deployment capability and dedicated deployer role;
- creation of real public WordPress content;
- deterministic local `llms.txt` generation and validation;
- explicit publication;
- independent public HTTP read-back;
- exact generated/stored/public SHA-256 equality;
- deactivation with deployment preservation;
- reactivation and public verification recovery;
- uninstall with preserve mode;
- reinstall/reactivation recovery of preserved deployment;
- uninstall with delete mode and security/setup cleanup.

## Engineering evidence

```text
PR #9                         merged
initial PR CI #18             FAIL
failure scope                  WordPress 5.6 historical runtime fixture, before plugin installation
failure signature              b4edb0c72807e8a6dd35cc3285aac513735bf810c442dbfd5f7b1f420b99e640
final PR head                  7df89ac99642a1a0675d46e5028d734c0aae20e5
PR CI #19                     PASS
merge SHA                      675f1f3bc9ed2572a94c497f21047c6a8c38a4e0
post-merge CI #20             PASS
blocking Phase 2C2 defects     0
```

## Failure diagnosis retained

CI #18 failed only on WordPress 5.6 / PHP 7.4. The historical WordPress container self-updated core files during bootstrap and produced an inconsistent mixed core tree. `wp-includes/general-template.php` attempted to require `wp-includes/php-compat/readonly.php`, which was absent, causing a PHP fatal before AI Search Optimizer was installed.

Root cause: **runtime fixture self-update race**, not plugin product code.

Fix: freeze WordPress core updates before the first request in the compatibility harness. No matrix row was removed and no plugin requirement was raised.

Validation: CI #19 and post-merge CI #20 both passed the full three-row matrix.

## Release truth

Phase 2C2 acceptance does **not** publish version 0.4.0 and does **not** mark the extension Available. Multisite/WooCommerce real-runtime acceptance and responsive/accessibility hardening remain Phase 2C3.
