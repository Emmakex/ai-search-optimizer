# AI Search Optimizer — Acceptance

Status: **Phases 0–3 accepted; Phase 4 is the next permitted workstream; public WordPress.org distribution not yet claimed**  
Last reviewed: **11 September 2026**

## Engineering inheritance

This repository inherits the Kairoseth rules for minimum-sufficient validation, finish-before-advance, EN/ES customer surfaces, least privilege, server-authoritative authorization, actionable diagnostics, durable failure learning and feature branch → PR → CI → merge → verification.

## Phase 0 / 1 — accepted

The standalone repository and connector extraction are accepted. The public plugin identity is `AI Search Optimizer`, technical slug/text domain `ai-search-optimizer`, license MIT, and the inherited connector protocol remains compatible with the accepted 0.3.2 predecessor.

Foundation/extraction blockers: **0**.

## Phase 2 — useful local Free workflow — accepted

Required and accepted behavior:

```text
[x] useful without Kairoseth account/license/entitlement
[x] local robots.txt / sitemap / llms.txt readiness
[x] eligible public WordPress inventory
[x] WooCommerce public-product awareness
[x] deterministic source-grounded llms.txt generation
[x] structure/size/duplicate/same-site validation
[x] explicit resource selection
[x] explicit human publication
[x] compare-before-write and idempotence
[x] stored content SHA-256 integrity
[x] independent public read-back with redirects disabled
[x] exact generated/stored/public SHA-256 comparison
[x] EN/ES customer workflow
[x] responsive/accessibility browser acceptance
[x] WordPress single-site and Multisite isolation
[x] WooCommerce runtime acceptance
[x] WordPress/PHP representative runtime matrix
[x] explicit preserve/delete uninstall policy
[x] no silent telemetry/content transmission
[x] reproducible release-candidate package
[x] blocking Phase 2 defects = 0
```

Accepted 0.4.0 release-candidate identity:

```text
source commit       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package             ai-search-optimizer-0.4.0.zip
package bytes       21745
package entries     11
package SHA-256     27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

Canonical closure documents retain the detailed CI/run evidence for 2A, 2B and 2C1–2C4.

## Phase 3A — connection-readiness technical slice — accepted / superseded as primary CTA

Phase 3A proved that a WordPress-side Kairoseth readiness surface could remain local, non-authoritative and secret-free. Its exact evidence remains in [`PHASE3A_ACCEPTANCE.md`](PHASE3A_ACCEPTANCE.md).

The customer-facing direction was intentionally simplified to the WordPress.org-first pattern used by Kairoseth AI Transparency. Phase 3A remains historical technical evidence; it is no longer the primary growth/support journey.

The inherited REST connector remains available for separately configured managed integrations and continues to require exact site identity, least privilege and compare-and-set mutation.

## Phase 3B — contextual support/custom-development — accepted

Canonical customer model:

```text
local Free plugin
→ optional explicit administrator CTA
→ Kairoseth Custom Requests
→ user chooses what information to submit
```

Accepted privacy/authority and UX gates:

```text
[x] support page load makes zero Kairoseth request
[x] no automatic lead submission
[x] no telemetry/click tracking
[x] no local Free feature lock or entitlement dependency
[x] exact destination = https://kairoseth.com/custom-requests
[x] hostile destination variants fail closed
[x] automatic context keys exactly allow-listed
[x] extension slug/name are plugin-owned constants
[x] request types are plugin-owned allow-list
[x] site URL/home URL not automatically transmitted
[x] llms.txt content/hash not automatically transmitted
[x] content/readiness inventory not automatically transmitted
[x] administrator/customer identity not automatically transmitted
[x] WooCommerce content not automatically transmitted
[x] credentials/passwords/tokens not automatically transmitted
[x] prompts/conversations/logs/database/options not automatically transmitted
[x] external links use noopener+noreferrer
[x] Kairoseth server re-normalizes extension identity
[x] browser/query context cannot choose recipient mailbox
[x] support page and CTAs EN/ES
[x] desktop + 390px mobile browser acceptance
[x] local Free workflow unchanged and green
[x] WordPress/PHP matrix green
[x] Multisite + WooCommerce green
[x] reproducible development package green
[x] official WordPress Plugin Check blocking and PASS
[x] blockers = 0
```

Canonical evidence: [`PHASE3B_CONTEXTUAL_SUPPORT.md`](PHASE3B_CONTEXTUAL_SUPPORT.md).

## Phase 3C — WordPress.org support/privacy hardening — accepted

Phase 3C adds and accepts the quality/release-discipline baseline without converting the plugin into trialware or weakening its privacy boundary.

```text
[x] WPCS blocking over production PHP
[x] PHPCompatibilityWP blocking for PHP 7.4+ baseline
[x] structured PHPCS diagnostics retained by CI
[x] PHPCS final result = 0 errors / 0 warnings / 0 fixable
[x] official Plugin Check PASS on production-shaped package
[x] WordPress 5.6 / PHP 7.4 packaged runtime PASS
[x] WordPress 6.8 / PHP 8.2 packaged runtime PASS
[x] WordPress 7.1 / PHP 8.3 packaged runtime PASS
[x] Multisite + WooCommerce PASS
[x] real browser EN/ES responsive/accessibility PASS
[x] contract/security/local Free/publication/lifecycle regressions PASS
[x] no-trialware/no-tracking/no-silent-contact boundary retained
[x] development/release metadata aligned
[x] reproducible 0.5.0-dev package evidence PASS
[x] PR #20 merged
[x] final PR CI #74 PASS
[x] post-merge main CI #75 PASS
[x] blocking Phase 3C defects = 0
```

Post-merge development package:

```text
source commit       393c35e67724b69ed6c7a4728b7d5a8595ee8169
source tree         72121f93a097391c3c30da82cb582259f04748dc
package             ai-search-optimizer-0.5.0-dev.zip
package bytes       29365
package entries     13
package SHA-256     c10b2a780824fc08e43b557def3423a3d25bf313412ac6436ef9f6c53bad0137
```

Canonical evidence: [`PHASE3C_ACCEPTANCE.md`](PHASE3C_ACCEPTANCE.md).

**Phase 3 is complete.**

## Phase 4 — Kairoseth Extensions `Available` gate — next / not started

Phase 4 is unblocked by Phase 3 acceptance but is not yet accepted. `Available` requires:

- canonical registry/product record;
- real and truthful public plugin identity/version/distribution state;
- contextual Custom Request path accepted;
- user-initiated share if included in the shared Extensions contract;
- required Kairoseth Platform CI and production verification.

The extension may remain `Building` until all Phase 4 gates are complete.

## Phase 5 — WordPress.org publication gate

Directory availability must not be claimed until:

- a deliberate stable complete version exists;
- plugin header and `readme.txt` metadata agree;
- immutable Git tag and GitHub Release package/checksum exist;
- the final package passes official Plugin Check and repository release gates;
- external services are fully and plainly documented;
- no prohibited trialware/tracking/deceptive claims/admin hijacking exist;
- code/assets/dependencies have compatible licensing;
- install/upgrade/deactivate/uninstall acceptance passes on the final package;
- WordPress.org independently approves and publishes the plugin.

`ai-search-optimizer` remains only the target directory slug until actually accepted/reserved.

## Claims gate

No customer-facing release may guarantee ranking, citation, indexing, crawling, AI ingestion, training inclusion or endorsement by external providers.
