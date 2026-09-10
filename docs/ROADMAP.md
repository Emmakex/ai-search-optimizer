# AI Search Optimizer — Roadmap

Status: **Building — foundation/extraction accepted**  
Last reviewed: **10 September 2026**

```text
Phase 0  product/repository foundation          COMPLETE
Phase 1  standalone connector extraction       COMPLETE
Phase 2  useful local Free workflow             NEXT
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

## Phase 2 — useful Free local workflow — next

Build the standalone value proposition:

1. EN/ES WordPress admin experience;
2. readiness overview for `robots.txt`, sitemap and `llms.txt`;
3. eligible public content inventory;
4. deterministic source-grounded `llms.txt` builder/preview;
5. validation with actionable findings;
6. explicit local publication and safe replacement behavior;
7. local publication verification;
8. WooCommerce public-content awareness;
9. Multisite UX and site-local isolation;
10. uninstall/data-retention controls;
11. responsive/accessibility where applicable.

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
