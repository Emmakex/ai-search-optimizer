# AI Search Optimizer — Roadmap

Status: **Building — Phase 2C4 final Free release acceptance next**  
Last reviewed: **10 September 2026**

```text
Phase 0  product/repository foundation          COMPLETE
Phase 1  standalone connector extraction       COMPLETE
Phase 2  useful local Free workflow             IN PROGRESS
  2A     local analysis + deterministic preview COMPLETE
  2B     selection + safe local publication     COMPLETE
  2C     Free release hardening                 IN PROGRESS
    2C1  lifecycle + data retention             COMPLETE
    2C2  WordPress/PHP runtime compatibility    COMPLETE
    2C3  Multisite/WooCommerce + UX hardening   COMPLETE
    2C4  release package + final acceptance     NEXT
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

### Phase 2B — selection + safe local publication — complete

Accepted implementation:

- explicit per-resource content selection with preserved explicit empty selection;
- submitted selections are filtered against the current eligible WordPress inventory;
- selected artifact rebuilt server-side from current public WordPress data;
- preview remains non-mutating;
- nonce-protected explicit Publish and Verify actions behind the inherited least-privilege capability;
- validation before any write;
- compare-before-write deployment-state token prevents stale-page replacement;
- same-content publication is idempotent and avoids unnecessary writes;
- one bounded site-local deployment mutation point reuses the accepted `llms.txt` state;
- local origin recorded as `source=local-free` without changing the inherited REST protocol;
- stored integrity rechecked immediately after mutation;
- independent HTTP read-back of public `/llms.txt` with redirects disabled;
- exact public SHA-256 comparison against generated/stored content;
- verification can be retried without changing stored content;
- recoverable EN/ES diagnostics for state drift, validation, storage and public verification failures;
- package and CI regression coverage for the publication module.

Evidence:

```text
PR #5                                    merged
final PR head                            895ba6a22c9f46674d43c4d860a9f14d99f6063c
CI #9                                    FAIL — test fixture interpolation only
CI #9 signature                          d48cb3aba4e635dfa5f275bf554bd46ca36a586923f5cc4a654d357cf2475126
CI #10                                   PASS
merge SHA                                35251c3842acaf2c71c72aa106bc855cd09fe2a9
post-merge CI #11                        PASS
blocking Phase 2B defects                0
```

Canonical closure: [`PHASE2B_CLOSURE.md`](PHASE2B_CLOSURE.md).

### Phase 2C — Free release hardening — in progress

#### Phase 2C1 — lifecycle + data retention — complete

Accepted implementation:

- dedicated EN/ES Data & uninstall admin surface;
- explicit `preserve` / `delete` choice for stored deployment content;
- invalid/unknown policy fails safe to `preserve`;
- deactivation preserves deployment and uninstall preference;
- uninstall always removes setup marker, retention preference, custom deployer role and administrator capability;
- deployer-role assignments are removed before deleting the role;
- optional stored deployment deletion occurs only when the current site's policy is `delete`;
- Multisite cleanup executes site by site without network-global deployment deletion;
- uninstall performs no outbound request or arbitrary filesystem write;
- `uninstall.php` and lifecycle module are included in the package;
- README, WordPress readme, SECURITY and CHANGELOG are synchronized with implemented behavior.

Evidence:

```text
PR #7                                    merged
final PR head                            e52bacde07bf6569dfb4486d3fda77acc4752502
PR CI #14                                PASS
merge SHA                                ac102413f55e15ce8ae93a0a9e78cb545d7d26e5
post-merge CI #15                        PASS
blocking Phase 2C1 defects               0
```

Canonical policy: [`DATA_RETENTION.md`](DATA_RETENTION.md). Canonical closure: [`PHASE2C1_CLOSURE.md`](PHASE2C1_CLOSURE.md).

#### Phase 2C2 — WordPress/PHP runtime compatibility — complete

Accepted real-runtime matrix installs the generated plugin ZIP and exercises activation, public-content generation, validation, explicit publication, independent public SHA-256 verification, deactivation/reactivation recovery and uninstall preserve/delete behavior.

```text
WordPress 5.6 / PHP 7.4                  PASS
WordPress 6.8 / PHP 8.2                  PASS
WordPress 7.1 / PHP 8.3                  PASS
PR #9                                    merged
CI #18                                   FAIL — historical WordPress fixture self-update race
CI #18 signature                         b4edb0c72807e8a6dd35cc3285aac513735bf810c442dbfd5f7b1f420b99e640
CI #19                                   PASS
merge SHA                                675f1f3bc9ed2572a94c497f21047c6a8c38a4e0
post-merge CI #20                        PASS
blocking Phase 2C2 defects               0
```

CI #18 did not reach plugin installation on the failing minimum row: the WordPress 5.6 container self-updated core files during bootstrap and produced a mixed core tree. The runtime harness now freezes core updates before first request; all three matrix rows pass without reducing coverage.

Canonical matrix: [`RUNTIME_COMPATIBILITY.md`](RUNTIME_COMPATIBILITY.md). Canonical closure: [`PHASE2C2_CLOSURE.md`](PHASE2C2_CLOSURE.md).

#### Phase 2C3 — Multisite/WooCommerce + UX hardening — complete

Accepted implementation/evidence:

- generated ZIP network-activates on WordPress 7.1 / PHP 8.3 Multisite;
- a subsite created after network activation receives site-local setup automatically;
- main-site and subsite identity/deployment state remain isolated;
- each site publishes and publicly verifies its own distinct `llms.txt` SHA-256;
- subsite publication cannot mutate the main-site deployment;
- network deactivate/reactivate preserves and recovers each site's deployment;
- network uninstall applies `preserve` / `delete` independently per site;
- WooCommerce 11.1.0 is accepted on the current runtime without consumer/API keys;
- only published public products enter the eligible inventory;
- draft, private and password-protected products remain excluded;
- real Chromium acceptance passes in English and Spanish;
- desktop 1280×900 and narrow/mobile 390×844 layouts remain usable;
- primary workflow has no page-level horizontal overflow;
- long URLs/hashes wrap, wide inventory is contained, mobile actions remain touch-friendly and keyboard focus remains visible.

Evidence:

```text
PR #11                                   merged
initial PR head                          dc92ee9c81e2b7d5c8bf0b465c040dd8c8cba6cb
CI #23                                   FAIL — unsupported wp site get harness assumption
CI #23 signature                         6f27a415ed0943186949a4096cb8d9e02665b1f629d2ade98ca11426cc4e6bab
fix commit                               ae3c0afb56e549de00607c0617b4d8698d21ce18
CI #24                                   PASS — 6/6 jobs
merge SHA                                1f8e5a419357d873bf3dda4403a45ee9e9a3eabe
post-merge CI #25                        PASS — 6/6 jobs
blocking Phase 2C3 defects               0
```

CI #23 did not expose a product defect. WP-CLI 2.12.0 did not register `wp site get`; the harness now resolves the already validated numeric blog ID with WordPress core `get_site_url()`. No coverage was removed.

Canonical closure: [`PHASE2C3_CLOSURE.md`](PHASE2C3_CLOSURE.md).

#### Phase 2C4 — release package + final acceptance — next

Finalize the Free release candidate without yet claiming public distribution:

- synchronize plugin header, `readme.txt`, README and changelog with the implemented Free workflow;
- validate final version/stable-tag/license/dependency claims;
- build a release-candidate ZIP from an exact commit;
- record SHA-256 and package manifest evidence;
- run the complete CI/runtime/browser gates against the release-candidate source;
- reach blocking Free release defects = 0;
- produce a formal Phase 2 / Free release decision.

Phase 2C4 does not by itself create a WordPress.org listing or mark the Kairoseth Extensions catalog item Available. Distribution remains Phase 5 and the separate catalog Available gate still applies.

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
