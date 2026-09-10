# AI Search Optimizer — Acceptance

Status: **Phase 2 accepted; Phase 3A historical technical slice accepted; Phase 3B contextual support/custom-development path in progress; public WordPress.org distribution not yet claimed**  
Last reviewed: **10 September 2026**

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

The customer-facing direction has since been intentionally simplified to the same WordPress.org-first pattern used by Kairoseth AI Transparency. Phase 3A remains historical technical evidence; it is no longer the primary growth/support journey.

The inherited REST connector remains available for separately configured managed integrations and continues to require exact site identity, least privilege and compare-and-set mutation.

## Phase 3B — contextual support/custom-development — current acceptance

Canonical customer model:

```text
local Free plugin
→ optional explicit administrator CTA
→ Kairoseth Custom Requests
→ user chooses what information to submit
```

Required WordPress surface:

```text
Tools → AI Search Optimizer Support
capability = manage_options
```

Required actions:

```text
Improve with Kairoseth
→ requestType=implementation_support

Request custom development
→ requestType=business_customization
```

### Privacy and authority gates

```text
[ ] support page load makes zero Kairoseth request
[ ] no automatic lead submission
[ ] no telemetry/click tracking
[ ] no local Free feature lock or entitlement dependency
[ ] exact destination = https://kairoseth.com/custom-requests
[ ] destination rejects HTTP/foreign/lookalike/wrong-path/userinfo/port/query/fragment
[ ] automatic context keys exactly allow-listed
[ ] extension slug/name are plugin-owned constants
[ ] request types are plugin-owned allow-list
[ ] site URL/home URL not automatically transmitted
[ ] llms.txt content/hash not automatically transmitted
[ ] content/readiness inventory not automatically transmitted
[ ] administrator/customer identity not automatically transmitted
[ ] WooCommerce content not automatically transmitted
[ ] credentials/passwords/tokens not automatically transmitted
[ ] prompts/conversations/logs/database/options not automatically transmitted
[ ] external links use noopener+noreferrer
[ ] Kairoseth server re-normalizes extension identity
[ ] browser/query context cannot choose recipient mailbox
[ ] user supplies personal/business/request details only on Kairoseth form
```

### UX and regression gates

```text
[ ] support page EN/ES
[ ] both CTAs EN/ES
[ ] desktop browser acceptance
[ ] 390px mobile browser acceptance
[ ] accessible headings/links/focus/touch targets
[ ] local Free workflow unchanged and green
[ ] WordPress/PHP matrix green
[ ] Multisite + WooCommerce green
[ ] inherited managed REST protocol unchanged
[ ] reproducible development package green
[ ] blocking defects = 0
```

### WordPress.org gates introduced in Phase 3B

```text
[ ] readme.txt has valid directory-oriented headers and description
[ ] External services section documents exact circumstances of Kairoseth navigation
[ ] service URL and privacy policy documented
[ ] no trialware behavior
[ ] no automatic tracking/external contact without consent
[ ] no public-site promotional links/credits
[ ] admin CTA remains contextual and non-hijacking
[ ] official WordPress Plugin Check is blocking in CI
[ ] official WordPress Plugin Check PASS on production-shaped package
```

Phase 3B is not accepted until PR CI, merge and post-merge CI verify all applicable gates.

## Phase 3C — directory/release hardening — blocked by Phase 3B

Before a stable WordPress.org submission candidate, add/confirm the same quality baseline used by AI Transparency:

- WordPress Coding Standards;
- PHPCompatibility for supported PHP lines;
- final EN/ES package coverage;
- official Plugin Check on final production-shaped package;
- final external-service/readme policy review;
- install/upgrade/deactivate/uninstall acceptance from final package;
- stable version/tag/readme alignment;
- zero blocking security/privacy/accessibility defects.

## Kairoseth Extensions `Available` gate

The extension may remain `Building` until all required distribution truth exists. `Available` additionally requires:

- canonical registry/product record;
- real public distribution action;
- contextual Custom Request path accepted;
- truthful package/version/repository metadata;
- required platform CI and production verification.

## WordPress.org publication gate

Directory availability must not be claimed until:

- a stable complete version exists;
- plugin header and `readme.txt` metadata agree;
- final package passes official Plugin Check and repository release gates;
- external services are fully and plainly documented;
- no prohibited trialware/tracking/deceptive claims/admin hijacking exist;
- code/assets/dependencies have compatible licensing;
- WordPress.org independently approves and publishes the plugin.

`ai-search-optimizer` remains only the target directory slug until actually accepted/reserved.

## Claims gate

No customer-facing release may guarantee ranking, citation, indexing, crawling, AI ingestion, training inclusion or endorsement by external providers.
