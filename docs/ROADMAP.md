# AI Search Optimizer — Roadmap

Status: **Building — Phase 2 useful local Free workflow in progress**  
Last reviewed: **10 September 2026**

```text
Phase 0  product/repository foundation          COMPLETE
Phase 1  standalone connector extraction       COMPLETE
Phase 2  useful local Free workflow             IN PROGRESS
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

Phase 1 closes extraction only. It does **not** make the product public-release ready.

Canonical closure: [`FOUNDATION_CLOSURE.md`](FOUNDATION_CLOSURE.md).

## Phase 2 — useful Free local workflow — in progress

The core Free edition must be useful without a Kairoseth account and must not silently transmit site content to Kairoseth, AI providers or third-party analytics.

### Phase 2A — local analysis + deterministic preview — current

Implementation scope:

- EN/ES WordPress admin workspace;
- local readiness overview for WordPress search visibility / `robots.txt`, sitemap and stored `llms.txt` state;
- eligible published, non-password-protected public WordPress content inventory;
- WooCommerce public products included automatically when the public `product` post type is present;
- site-local Multisite awareness;
- deterministic source-grounded `llms.txt` builder with no generated timestamps;
- local validator for heading, size, resource presence, duplicate URLs and same-site URL scope;
- exact SHA-256 of the preview;
- read-only behavior: no new local mutation/publication action in this slice;
- CI regression and package-content coverage for the new local modules.

Phase 2A is not accepted until its PR CI, merge and post-merge CI are green.

### Phase 2B — selection + safe local publication

Blocked by Phase 2A acceptance. Add:

- explicit content selection controls;
- validation before mutation;
- explicit human publication action;
- safe replacement / compare-before-write behavior;
- site-local `llms.txt` publication;
- independent local public read-back and exact SHA-256 verification;
- recoverable failure states and actionable diagnostics.

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
