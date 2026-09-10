# AI Search Optimizer — Runtime compatibility

Status: **Phase 2C2 implementation — evidence pending CI**  
Last reviewed: **10 September 2026**

## Purpose

Static source checks are not sufficient for a WordPress release. Phase 2C2 installs the generated plugin ZIP into real WordPress containers and executes the customer-critical lifecycle with the PHP version provided by that WordPress runtime.

## Representative matrix

```text
WordPress 5.6  / PHP 7.4   minimum declared compatibility boundary
WordPress 6.8  / PHP 8.2   representative intermediate line
WordPress 7.1  / PHP 8.3   current WordPress release line at Phase 2C2 start
```

This is a representative release matrix, not a claim that every possible WordPress/PHP permutation has been tested.

## Runtime contract executed in every matrix row

The CI harness must:

1. build the repository-owned `0.4.0` development ZIP;
2. create an isolated MariaDB + WordPress runtime;
3. run WP-CLI with the target container's PHP binary;
4. install the generated ZIP, not the repository source tree;
5. activate the plugin;
6. verify the administrator capability, deployer role and schema/setup marker;
7. create eligible public WordPress content;
8. build and validate deterministic `llms.txt` content;
9. publish through the local Free publication core;
10. require independent public verification to succeed;
11. read `/llms.txt` over HTTP and compare its exact SHA-256 with the stored/generated hash;
12. deactivate and verify deployment/preference retention plus route removal;
13. reactivate and verify the preserved deployment is publicly recoverable;
14. execute uninstall in `preserve` mode and confirm security/setup cleanup while deployment data remains;
15. simulate reinstall/reactivation and confirm preserved data remains valid;
16. execute uninstall in `delete` mode and confirm deployment plus plugin-owned security/setup state are removed.

## Test infrastructure

- official WordPress Docker images provide the WordPress/PHP runtime;
- MariaDB 10.11 provides an isolated database;
- WP-CLI 2.12.0 is pinned for deterministic administration commands;
- runtime containers and networks are unique per matrix job and deleted on exit;
- a failing runtime dumps bounded WordPress/database container logs before CI exits;
- the repository structured CI wrapper records the failed step, exit code, primary error and signature.

## Scope boundary

Phase 2C2 covers representative single-site WordPress/PHP compatibility and real lifecycle/publication execution.

It does not close:

- Multisite runtime isolation;
- WooCommerce runtime acceptance;
- responsive/admin-browser acceptance;
- accessibility acceptance;
- final immutable release package/checksum decision.

Those remain Phase 2C3/2C4 dependencies.
