# AI Search Optimizer — Roadmap

Status: **Building — Phase 2B safe local publication in progress**  
Last reviewed: **10 September 2026**

```text
Phase 0  product/repository foundation          COMPLETE
Phase 1  standalone connector extraction       COMPLETE
Phase 2  useful local Free workflow             IN PROGRESS
  2A     local analysis + deterministic preview COMPLETE
  2B     selection + safe local publication     IN PROGRESS
  2C     Free release hardening                 BLOCKED by 2B
Phase 3  Kairoseth-connected customer UX        BLOCKED by Phase 2
Phase 4  Custom Request + share + catalog       BLOCKED by shared/platform dependencies
Phase 5  public distribution / WordPress.org    BLOCKED by prior acceptance
```

## Phase 0 — product foundation — complete

Accepted:

- dedicated public repository;
- MIT license;
- canonical name/slug/SEO contract;
- product/architecture/roadmap/acceptance/security/provenance docs;
- engineering rules adapted from Kairoseth;
- no false Available/release claims.

## Phase 1 — standalone extraction — complete

The accepted WordPress connector 0.3.2 is now the standalone 0.4.0 development baseline with protocol/state compatibility preserved.

Evidence:

```text
PR #1                                    merged
merge SHA                                2b9d0df93df99ccc0cd4e99f708a3a5a72bd4212
PR CI #1                                 PASS
post-merge CI #2                         PASS
PHP syntax                               PASS
contract/security regression             PASS
single-site get_site() guard             PASS
plugin ZIP build                         PASS
package-content verification             PASS
repository cleanliness                   PASS
blocking extraction defects              0
```

Canonical closure: [`FOUNDATION_CLOSURE.md`](FOUNDATION_CLOSURE.md).

## Phase 2 — useful Free local workflow — in progress

The core Free edition must be useful without a Kairoseth account and must not silently transmit site content to Kairoseth, AI providers or third-party analytics.

### Phase 2A — local analysis + deterministic preview — complete

Accepted implementation:

- EN/ES WordPress admin workspace under Tools → AI Search Optimizer;
- local readiness overview for WordPress search visibility / `robots.txt`, sitemap and stored `llms.txt` state;
- eligible published, non-password-protected public WordPress content inventory;
- WooCommerce public products included automatically when present;
- current-site Multisite boundary communicated;
- deterministic source-grounded `llms.txt` builder with stable ordering and no generated timestamps;
- static-homepage/resource deduplication;
- validator for heading, size, resource presence, duplicate URLs and same-site URL scope;
- exact SHA-256 of the preview;
- read-only Phase 2A path with no new publication/state mutation;
- no local content transmission to Kairoseth, AI providers or third-party analytics;
- package and CI coverage for local modules.

Evidence:

```text
PR #3                                    merged
PR head                                  828d1f1188aaf282f5b1fcce055fd912021df75b
PR CI #5                                 PASS
merge SHA                                61b33412484a20a505726c808ec64bc9dc8953a3
post-merge CI #6                         PASS
blocking Phase 2A defects                0
```

Canonical closure: [`PHASE2A_CLOSURE.md`](PHASE2A_CLOSURE.md).

### Phase 2B — selection + safe local publication — in progress

Implementation contract:

- explicit per-resource content selection, including a preserved explicit empty selection;
- server rebuilds the selected artifact only from the current eligible inventory;
- validation before any mutation;
- nonce + existing least-privilege capability on the human admin workflow;
- explicit Publish action; preview remains non-mutating;
- compare-before-write token over the current stored deployment to prevent stale-page replacement;
- idempotent same-content publication without unnecessary rewrites;
- one bounded site-local deployment mutation point reusing the accepted `llms.txt` state;
- local publication records `source=local-free` without changing the inherited REST contract;
- independent HTTP read-back of the public `/llms.txt` with redirects disabled;
- exact public SHA-256 comparison against the stored/generated content;
- manual verification retry without changing stored content;
- recoverable state-changed, validation, storage and public-verification diagnostics in EN/ES;
- package and CI regression coverage for the publication module.

Phase 2B is not accepted until PR CI, merge and post-merge CI are green. A real representative WordPress install/runtime matrix remains part of Phase 2C release hardening.

### Phase 2C — Free release hardening

Blocked by Phase 2B acceptance. Complete:

- Multisite UX and site-local isolation acceptance;
- WooCommerce behavior acceptance where claimed;
- uninstall/data-retention controls;
- responsive/accessibility acceptance;
- install/update/deactivate/uninstall policy and tests;
- security/privacy disclosure synchronization;
- representative WordPress/PHP compatibility evidence.

No Kairoseth account is required for these core Free functions.

## Phase 3 — optional Kairoseth connection

Add task-oriented EN/ES UX for connecting to Kairoseth AI Search Optimizer while preserving server-authoritative organization/product access.

Advanced cloud capabilities may include whole-site analysis, Importance / AI Readiness, curation, approved revisions/history, optional AI assistance and managed publication verification.

No long-lived provider secret ships in the plugin.

## Phase 4 — Extensions commercial integration

Before the extension is marked Available in Kairoseth Extensions:

- canonical product registry entry;
- Kairoseth product page;
- contextual Custom Request end-to-end through the shared module;
- user-initiated share using canonical Kairoseth URL;
- accurate Free/Custom boundary;
- platform CI for changed catalog/shared contracts.

The product may be registered earlier as **Building** without implying availability. Pro remains deferred unless repeated reusable demand justifies it.

## Phase 5 — distribution

Target distribution can include GitHub Releases and WordPress.org. `ai-search-optimizer` is only a target WordPress.org slug until actually accepted/reserved.

Release gate includes:

- immutable version/tag;
- build artifact + checksum;
- install/activate/update/deactivate/uninstall acceptance;
- representative WordPress compatibility;
- Multisite acceptance;
- WooCommerce compatibility where claimed;
- WordPress Plugin Check before directory submission;
- WordPress.org policy/license/readme compliance;
- real install/download action;
- release docs/changelog synchronized;
- blocking defects = 0.

## Post-v1 candidates

Demand-led only: drift monitoring, scheduled checks, richer WooCommerce product representations, agency/multi-site operations, additional AI Search diagnostics and optional reusable Pro capabilities.
