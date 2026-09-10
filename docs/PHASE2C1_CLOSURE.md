# AI Search Optimizer — Phase 2C1 closure

Status: **ACCEPTED — lifecycle + data retention hardening complete**  
Date: **10 September 2026**

## Accepted scope

Phase 2C1 closes the plugin lifecycle/data-retention contract for the unreleased `0.4.0` line.

Accepted behavior:

- authorized EN/ES wp-admin surface for uninstall retention preference;
- bounded `preserve` / `delete` values;
- unknown or malformed values normalize to `preserve`;
- deactivation keeps stored deployment content and uninstall preference;
- uninstall always removes setup marker, retention preference, custom deployer role and administrator deployment capability;
- users assigned the custom deployer role have that role removed before the role definition is deleted;
- deployment content is deleted only when that site's explicit uninstall policy is `delete`;
- preserve mode retains deployment data for later recovery after reinstall;
- Multisite uninstall processes each site in its own context;
- no network-global deployment deletion, outbound uninstall request or arbitrary filesystem mutation;
- `uninstall.php` and `includes/local-lifecycle.php` ship in the generated ZIP;
- public README, WordPress `readme.txt`, SECURITY and CHANGELOG match implemented behavior.

## Engineering evidence

```text
implementation branch                       feat/phase2c1-lifecycle-retention
PR                                           #7
final PR head                                e52bacde07bf6569dfb4486d3fda77acc4752502
PR CI                                        #14 PASS
merge SHA                                    ac102413f55e15ce8ae93a0a9e78cb545d7d26e5
post-merge CI                                #15 PASS
PHP syntax                                   PASS
connector/security regression                PASS
Phase 2A local Free regression               PASS
Phase 2B safe publication regression         PASS
lifecycle/uninstall regression               PASS
plugin ZIP build                             PASS
package-content verification                 PASS
repository cleanliness                       PASS
blocking Phase 2C1 defects                   0
```

## Release truth

Phase 2C1 acceptance does **not** mean `0.4.0` is released or that the extension is Available in Kairoseth Extensions or WordPress.org.

The lifecycle contract has static/package acceptance, but real WordPress install/deactivate/reactivate/uninstall execution is intentionally reserved for Phase 2C2 so release readiness is based on runtime evidence rather than source inspection alone.

## Next permitted boundary

**Phase 2C2 — WordPress/PHP runtime compatibility.**

It must install the packaged ZIP in representative real WordPress/PHP combinations and execute activation, local publication/public verification, deactivation/reactivation and uninstall preserve/delete flows. Multisite/WooCommerce runtime acceptance remains Phase 2C3.

Canonical lifecycle policy: [`DATA_RETENTION.md`](DATA_RETENTION.md).
