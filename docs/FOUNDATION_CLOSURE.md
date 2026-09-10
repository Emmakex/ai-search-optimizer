# AI Search Optimizer — Foundation & extraction closure

Status: **Accepted / closed — blockers 0**  
Date: **10 September 2026**

## Scope

This record closes the dedicated-repository foundation and the standalone extraction of the accepted Kairoseth AI Web Readiness WordPress connector into **AI Search Optimizer 0.4.0 (unreleased)**.

It does not declare the first public Free release, WordPress.org availability or Kairoseth Extensions `Available` status.

## Accepted evidence

```text
repository                                 Emmakex/ai-search-optimizer
visibility                                 public
license                                    MIT
accepted predecessor                       connector 0.3.2
standalone development baseline            0.4.0
PR #1                                      merged
merge SHA                                  2b9d0df93df99ccc0cd4e99f708a3a5a72bd4212
PR CI #1                                   PASS
post-merge CI #2                           PASS
PHP syntax                                 PASS
contract/security regression               PASS
single-site get_site() guard               PASS
legacy REST/capability/state compatibility PASS
plugin ZIP build                           PASS
package content                            PASS
repository cleanliness                     PASS
blocking foundation/extraction defects     0
```

## Compatibility decision

The public name/repository/file changed to AI Search Optimizer, but the existing connector schema and `kairoseth-ai-web-readiness/v1` compatibility identifiers remain intentionally unchanged. This protects current Kairoseth Platform interoperability and existing WordPress state while the standalone product evolves.

Any future protocol rename requires explicit versioning, migration and backward-compatible acceptance.

## Security decision

The standalone package keeps the accepted least-privilege boundary: dedicated WordPress capability, exact site/blog/network pinning, content SHA-256 validation, compare-and-set remote state and no FTP/SFTP, hosting-panel, database, WooCommerce API or provider credentials.

## License decision

The public standalone source line is MIT. WordPress.org requires a GPL-compatible license and accepts GPL-compatible alternatives, although GPLv2+ is recommended. MIT/Expat is GPL-compatible. Final directory submission still requires the separate WordPress.org acceptance gate.

## Next permitted phase

**Phase 2 — useful local Free workflow** is now the next active dependency.

Its core requirement is that the public plugin become genuinely useful without a Kairoseth account before public release: local readiness, content selection, deterministic `llms.txt` generation/validation, explicit publication, verification, EN/ES admin UX and defined uninstall/data-retention behavior.

Phase 3 Kairoseth-connected UX remains blocked until Phase 2 closes.
