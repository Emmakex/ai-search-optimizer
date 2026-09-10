# AI Search Optimizer — Roadmap

Status: **Building**  
Last reviewed: **10 September 2026**

```text
Phase 0  product/repository foundation          ACTIVE
Phase 1  standalone connector extraction       ACTIVE
Phase 2  useful local Free workflow             BLOCKED by Phase 1
Phase 3  Kairoseth-connected customer UX        BLOCKED by Phase 2
Phase 4  Custom Request + share + catalog       BLOCKED by shared/platform dependencies
Phase 5  public distribution / WordPress.org    BLOCKED by prior acceptance
```

## Phase 0 — product foundation

Required:

- dedicated public repository;
- MIT license;
- canonical name/slug/SEO contract;
- product/architecture/roadmap/acceptance/security/provenance docs;
- engineering rules adapted from Kairoseth;
- no false Available/release claims.

## Phase 1 — standalone extraction

Import the accepted WordPress connector 0.3.2 into this repository as the 0.4.0 development baseline while preserving protocol/state compatibility.

Acceptance requires:

- PHP syntax green;
- contract/static tests green;
- deterministic plugin ZIP build green;
- no embedded provider/platform secrets;
- MIT header/root license aligned;
- legacy REST/capability/state compatibility retained;
- single-site `get_site()` regression protected;
- provenance recorded.

Phase 1 does not itself make the product public-release ready.

## Phase 2 — useful Free local workflow

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

Pro remains deferred unless repeated reusable demand justifies it.

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
