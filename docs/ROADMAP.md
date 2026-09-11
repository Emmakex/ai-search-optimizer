# AI Search Optimizer — Roadmap

Status: **Phase 4 complete — Kairoseth Extensions integration accepted; Phase 5 stable public distribution / WordPress.org is the next release-gated workstream**  
Last reviewed: **11 September 2026**

```text
Phase 0  product/repository foundation              COMPLETE
Phase 1  standalone connector extraction           COMPLETE
Phase 2  useful local Free workflow                COMPLETE
  2A     local analysis + deterministic preview    COMPLETE
  2B     selection + safe local publication        COMPLETE
  2C     Free release hardening                    COMPLETE
Phase 3  optional support / custom-development UX  COMPLETE
  3A     connection-readiness technical slice      COMPLETE / SUPERSEDED AS PRIMARY CTA
  3B     contextual support + custom CTA            COMPLETE
  3C     support/privacy + directory hardening      COMPLETE
Phase 4  Extensions catalog integration            COMPLETE
Phase 5  stable public distribution / WordPress.org NEXT / RELEASE-GATED
```

## Product model

The canonical customer model follows the accepted Kairoseth AI Transparency pattern:

```text
useful local Free plugin
→ optional explicit Kairoseth CTA
→ support / improvement / custom development when requested
```

The local Free plugin must never become a trial, license shell or mandatory cloud onboarding funnel. Kairoseth is optional and does not unlock or license accepted local functionality.

## Phase 0 — product foundation — complete

Accepted: dedicated public repository, MIT license, canonical name/slug, architecture/roadmap/acceptance/security/provenance docs, engineering rules and truthful release state.

Canonical closure: [`FOUNDATION_CLOSURE.md`](FOUNDATION_CLOSURE.md).

## Phase 1 — standalone extraction — complete

The accepted WordPress connector 0.3.2 became the standalone line while preserving protocol/state compatibility.

```text
PR #1                 merged
merge SHA             2b9d0df93df99ccc0cd4e99f708a3a5a72bd4212
PR CI #1              PASS
post-merge CI #2      PASS
blockers               0
```

## Phase 2 — useful local Free workflow — complete

The local Free product is useful without a Kairoseth account:

- local robots.txt / sitemap / llms.txt readiness;
- eligible public WordPress content inventory;
- WooCommerce public-product awareness;
- deterministic source-grounded llms.txt generation;
- validation and exact SHA-256;
- explicit selection and publication;
- compare-before-write and idempotence;
- independent public read-back/verification;
- EN/ES responsive admin UX;
- single-site/Multisite isolation;
- explicit uninstall retention policy;
- real WordPress/PHP and WooCommerce runtime acceptance;
- reproducible release-candidate package evidence.

Accepted 0.4.0 candidate:

```text
source commit          4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree            472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package                ai-search-optimizer-0.4.0.zip
package SHA-256        27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
Phase 2 blockers       0
```

Canonical closures: [`PHASE2A_CLOSURE.md`](PHASE2A_CLOSURE.md), [`PHASE2B_CLOSURE.md`](PHASE2B_CLOSURE.md), [`PHASE2C1_CLOSURE.md`](PHASE2C1_CLOSURE.md), [`PHASE2C2_CLOSURE.md`](PHASE2C2_CLOSURE.md), [`PHASE2C3_CLOSURE.md`](PHASE2C3_CLOSURE.md), [`PHASE2C4_CLOSURE.md`](PHASE2C4_CLOSURE.md).

## Phase 3 — optional support / custom-development UX — complete

### 3A — connection-readiness technical slice — complete, customer direction superseded

Phase 3A proved that the standalone plugin can expose local connection prerequisites without sending secrets or site state. Its technical acceptance remains valid and recorded in [`PHASE3A_ACCEPTANCE.md`](PHASE3A_ACCEPTANCE.md).

The customer-facing strategy changed after comparing the plugin with the accepted AI Transparency WordPress.org model. Connection readiness is **not** the primary growth/support CTA going forward. The inherited REST connector remains for compatible managed integrations, but local Free users are not pushed into cloud onboarding.

### 3B — contextual support + custom CTA — complete

Accepted in PR #18 and verified after merge. The administrator-only support bridge is privacy-bounded, optional and independent from the local Free feature set.

Accepted contract:

```text
Tools → AI Search Optimizer Support
GET/page load → zero Kairoseth request

Improve with Kairoseth
→ requestType=implementation_support

Request custom development
→ requestType=business_customization

explicit click
→ https://kairoseth.com/custom-requests
→ bounded technical/product query only
→ user chooses what information to submit
```

Automatic context is limited to `source`, `extensionSlug`, `extensionName`, `extensionVersion`, `hostPlatform`, `hostPlatformVersion`, `locale` and `requestType`. Forbidden automatic context includes site URL, llms.txt content/hash, public-content inventory, administrator/customer identity, WooCommerce content, plugin/theme inventory, credentials, tokens, prompts, conversations, logs, database contents and arbitrary WordPress options.

Kairoseth Platform independently allow-lists `ai-search-optimizer` and resolves its canonical product name server-side. Browser/plugin-controlled context cannot select an arbitrary extension identity or recipient mailbox.

Acceptance evidence:

```text
PR #18                    merged
merge SHA                 c05d9e162310700ed6ac1b1037ae9f96fbe43db6
final PR CI #48           PASS
post-merge CI #49         PASS — all required jobs
Plugin Check PCP 2.1.0    PASS — No errors found
package SHA-256           2f2896031c72ce4ad8d561bd0d5c2a5820ec0ecd7e18c106250c9066683d80d7
blockers                   0
```

Canonical acceptance record: [`PHASE3B_CONTEXTUAL_SUPPORT.md`](PHASE3B_CONTEXTUAL_SUPPORT.md).

### 3C — WordPress.org support/privacy hardening — complete

Phase 3C established the production-code quality baseline and closed the hardening workstream without weakening the local Free or privacy contracts.

Accepted gates:

- WordPress Coding Standards over production PHP;
- PHPCompatibilityWP for the supported PHP baseline;
- machine-readable PHPCS diagnostics retained by CI;
- official WordPress Plugin Check on a production-shaped package;
- WordPress 5.6/PHP 7.4, WordPress 6.8/PHP 8.2 and WordPress 7.1/PHP 8.3 runtime acceptance;
- Multisite + WooCommerce runtime acceptance;
- real-browser EN/ES responsive/accessibility acceptance;
- lifecycle/deactivate/uninstall regression;
- development/release metadata alignment;
- reproducible development-package evidence;
- no trialware, telemetry or silent external-contact regression.

Acceptance evidence:

```text
PR #20                    merged
final PR CI #74           PASS
merge SHA                 393c35e67724b69ed6c7a4728b7d5a8595ee8169
post-merge CI #75         PASS
final PHPCS               0 errors / 0 warnings / 0 fixable
package SHA-256           c10b2a780824fc08e43b557def3423a3d25bf313412ac6436ef9f6c53bad0137
blockers                   0
```

The package above is development evidence for `0.5.0-dev`, not a stable public release. WordPress.org external approval is still not claimed.

Canonical acceptance record: [`PHASE3C_ACCEPTANCE.md`](PHASE3C_ACCEPTANCE.md).

With 3A, 3B and 3C accepted, **Phase 3 is closed**.

## Phase 4 — Kairoseth Extensions integration — complete

Phase 4 integrated the standalone plugin into the canonical Kairoseth Extensions catalog while preserving truthful product and distribution state.

Accepted contract:

- canonical Extensions registry slug is `ai-search-optimizer`;
- public route is `https://kairoseth.com/products/ai-search-optimizer`;
- public EN/ES copy and metadata describe the real plugin scope;
- catalog status remains `building` at `0.5.0-dev`;
- no stable download or WordPress.org availability is claimed;
- Custom Requests uses the already accepted server-side extension allow-list and bounded context;
- no separate share workflow was invented because it is not part of the accepted AI Search Optimizer Extensions contract;
- public sitemap and shared SEO regression coverage include the canonical route;
- real EN/ES production browser proof, platform CI and AI Web Readiness production proof pass.

Acceptance evidence:

```text
platform PR #225                       merged
platform merge SHA #225                df56ba1a60ce345224ec1baad99f9a69c80822c0
PR CI #938                              PASS
post-merge CI #939                     PASS
post-merge Production Smoke #129       PASS

platform PR #226                       merged
final head #226                        60062a548f93a21b90aaa3e8871c6e19bc41fa4d
platform merge SHA #226                74ec596f568d8cc41418bc708d0c3a6ee98b47c6
PR CI #941                              PASS
PR Production Smoke #131               PASS
post-merge CI #942                     PASS
AI Web Readiness Production Proof #32  PASS
post-merge Production Smoke #132       PASS on attempt 2
blocking Phase 4 defects                0
```

The first post-merge Production Smoke attempt correctly caught deployment freshness before the new sitemap had converged; the strict gate was retained and the second attempt passed after production convergence. The diagnosis and regression boundary are retained in the Phase 4 acceptance record.

Canonical acceptance record: [`PHASE4_EXTENSIONS_INTEGRATION.md`](PHASE4_EXTENSIONS_INTEGRATION.md).

**Phase 4 is closed.**

## Phase 5 — stable public distribution / WordPress.org — next / release-gated

Required before submission/release:

- deliberate stable version and matching plugin/readme metadata;
- immutable Git tag and GitHub Release package/checksum;
- reproducible accepted package;
- official WordPress Plugin Check PASS;
- final WordPress.org policy/readme/external-service acceptance;
- compatible code/assets/licenses;
- real install/upgrade/uninstall acceptance from the final package;
- no blocking security/privacy/accessibility defects;
- WordPress.org external review/approval before claiming directory availability.

`ai-search-optimizer` remains only the target WordPress.org slug until actually accepted/reserved.

Phase 5 must again follow feature branch → PR → CI → merge → production/release verification. A stable version or directory claim cannot be made from documentation alone.

## Post-v1 candidates

Demand-led only: monitoring/drift, richer WooCommerce representations, agency/multi-site operations, additional AI Search diagnostics and reusable advanced capabilities.
