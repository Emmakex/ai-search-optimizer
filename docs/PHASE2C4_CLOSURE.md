# AI Search Optimizer — Phase 2C4 Closure

Status: **GO — Phase 2 / Free 0.4.0 release candidate accepted**  
Date: **10 September 2026**

## Decision

Phase 2 is complete. The standalone Free `0.4.0` release candidate is accepted for a later public-distribution action.

This decision means:

- the account-free local Free workflow is technically accepted;
- Phase 2 release hardening has no blocking defects;
- the package is reproducible from the accepted source tree;
- the exact package SHA-256 is recorded;
- the complete static/runtime/Multisite/WooCommerce/browser suite passed before and after merge;
- public distribution remains a separate Phase 5 action.

This decision does **not** mean that a GitHub Release, public Git tag, WordPress.org listing or Kairoseth Extensions `Available` state already exists.

## Accepted source and package

```text
version                                   0.4.0
source commit                             4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree                               472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package                                   ai-search-optimizer-0.4.0.zip
package bytes                             21745
package entries                           11
package SHA-256                           27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
reproducible build                        PASS
blocking Phase 2 defects                  0
```

The release-candidate builder normalizes package permissions, timestamps and entry order, builds the ZIP twice and rejects the candidate unless both ZIPs are byte-identical.

## Validation evidence

```text
PR #13                                    merged
PR head                                   36ecb296c7962092323fd2ff92c853053ee6e612
PR CI #28                                 PASS — 7/7 jobs
PR CI #28 run id                          34484896153
merge SHA                                 4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
post-merge CI #29                         PASS — 7/7 jobs
post-merge CI #29 run id                  34485131842
```

Both CI #28 and post-merge CI #29 produced the same plugin ZIP SHA-256 from the same source tree:

```text
27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

This proves that the PR synthetic merge checkout and the accepted `main` commit produced byte-identical plugin package bytes when their source tree was identical.

## Post-merge CI #29 gates

```text
validate                                  PASS
release metadata alignment                PASS
WordPress 5.6 / PHP 7.4                   PASS
WordPress 6.8 / PHP 8.2                   PASS
WordPress 7.1 / PHP 8.3                   PASS
Multisite + WooCommerce 11.1.0            PASS
real browser admin UX EN/ES               PASS
release candidate package evidence        PASS
```

The final release-candidate job executes only after every prior static/runtime/browser dependency is green.

## CI artifact evidence

Post-merge CI #29 uploaded:

```text
artifact id                               10155308031
artifact name                             ai-search-optimizer-release-candidate-4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
artifact contents                         ZIP + .sha256 + release-manifest.txt
artifact retention                        30 days
```

The Actions artifact is supplemental, time-limited evidence. It is not the canonical permanent release download. The durable acceptance identity is the exact source commit/tree plus the plugin-package SHA-256 recorded above.

The Actions artifact archive has its own wrapper digest, which is distinct from the plugin ZIP SHA-256. Only the plugin ZIP SHA-256 above identifies the accepted install package.

## Metadata and claims acceptance

Accepted release-candidate metadata:

- plugin header version: `0.4.0`;
- connector version constant: `0.4.0`;
- WordPress `Stable tag`: `0.4.0`;
- WordPress minimum: `5.6`;
- PHP minimum: `7.4`;
- tested WordPress boundary: `7.1`;
- license: MIT;
- customer-facing docs describe implemented behavior, not planned behavior;
- no ranking, citation, indexing, crawling, ingestion or training guarantee is made;
- no GitHub Release or WordPress.org availability is claimed.

## Phase boundary

Phase 2 is now **COMPLETE**.

The next product-development workstream is Phase 3, the optional Kairoseth-connected customer experience. Public distribution remains Phase 5 and retains its own independent gates, including the real public release/tag action, WordPress Plugin Check and WordPress.org review/submission requirements where applicable.

Kairoseth Extensions `Available` remains a separate catalog gate and must not be inferred from this closure.
