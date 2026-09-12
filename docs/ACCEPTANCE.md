# AI Search Optimizer — Acceptance

Status: **Phases 0–4, 5A and 5B accepted; Phase 5C.0 submission-hardening contract frozen; 0.5.1 implementation is next; WordPress.org availability is not yet claimed**  
Last reviewed: **12 September 2026**

## Engineering inheritance

This repository inherits the Kairoseth rules for minimum-sufficient validation, finish-before-advance, EN/ES customer surfaces, least privilege, server-authoritative authorization, actionable diagnostics, durable failure learning and feature branch → PR → CI → merge → verification.

## Phase 0 / 1 — accepted

The standalone repository and connector extraction are accepted. Public plugin identity is `AI Search Optimizer`, technical slug/text domain `ai-search-optimizer`, license MIT, and the inherited connector protocol remains compatible with the accepted 0.3.2 predecessor.

Foundation/extraction blockers: **0**.

## Phase 2 — useful local Free workflow — accepted

```text
[x] useful without Kairoseth account/license/entitlement
[x] local robots.txt / sitemap / llms.txt readiness
[x] eligible public WordPress inventory
[x] WooCommerce public-product awareness
[x] deterministic source-grounded llms.txt generation
[x] explicit resource selection and publication
[x] compare-before-write and idempotence
[x] independent public read-back and exact SHA-256 comparison
[x] EN/ES responsive/accessibility acceptance
[x] WordPress single-site and Multisite isolation
[x] WooCommerce runtime acceptance
[x] representative WordPress/PHP runtime matrix
[x] explicit preserve/delete uninstall policy
[x] no silent telemetry/content transmission
[x] reproducible package evidence
[x] blocking Phase 2 defects = 0
```

Historical accepted `0.4.0` identity:

```text
source commit       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256     27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

## Phase 3 — contextual support / WordPress.org hardening — accepted

The primary customer model is:

```text
local Free plugin
→ optional explicit administrator CTA
→ Kairoseth Custom Requests
→ user chooses what information to submit
```

Accepted support/privacy boundary:

```text
[x] page load makes zero Kairoseth request
[x] no automatic lead submission or click tracking
[x] local Free features do not depend on Kairoseth
[x] exact destination = https://kairoseth.com/custom-requests
[x] hostile destination variants fail closed
[x] automatic context is exactly allow-listed
[x] site URL / llms.txt content or hash / inventory not attached automatically
[x] administrator/customer identity not attached automatically
[x] WooCommerce content not attached automatically
[x] credentials/tokens/prompts/logs/database/options not attached automatically
[x] request types limited to implementation_support and business_customization
[x] Kairoseth re-normalizes extension identity server-side
[x] EN/ES desktop/mobile browser acceptance
[x] WPCS + PHPCompatibilityWP blocking
[x] official Plugin Check blocking
[x] blockers = 0
```

Canonical evidence: [`PHASE3A_ACCEPTANCE.md`](PHASE3A_ACCEPTANCE.md), [`PHASE3B_CONTEXTUAL_SUPPORT.md`](PHASE3B_CONTEXTUAL_SUPPORT.md), [`PHASE3C_ACCEPTANCE.md`](PHASE3C_ACCEPTANCE.md).

**Phase 3 is complete.**

## Phase 4 — Kairoseth Extensions integration — accepted

```text
[x] extension registry slug = ai-search-optimizer
[x] public route = https://kairoseth.com/products/ai-search-optimizer
[x] EN/ES product copy matches implemented scope
[x] server-side extension identity allow-list retained
[x] Custom Requests uses bounded accepted context
[x] public sitemap/shared SEO coverage includes product route
[x] production proof passed
[x] no false WordPress.org availability claim
[x] blocking Phase 4 defects = 0
```

Canonical evidence: [`PHASE4_EXTENSIONS_INTEGRATION.md`](PHASE4_EXTENSIONS_INTEGRATION.md).

**Phase 4 is complete.**

## Phase 5A — stable candidate identity — accepted

Accepted `0.5.0` identity:

```text
version             0.5.0
source commit       b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree         6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package             ai-search-optimizer-0.5.0.zip
package bytes       29397
package entries     13
package SHA-256     0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
```

```text
[x] stable plugin/readme/connector metadata aligned
[x] prerelease/development metadata rejected
[x] WPCS + PHPCompatibilityWP PASS
[x] official WordPress Plugin Check PASS
[x] WP 5.6 / PHP 7.4 PASS
[x] WP 6.8 / PHP 8.2 PASS
[x] WP 7.1 / PHP 8.3 PASS
[x] Multisite + WooCommerce PASS
[x] real browser EN/ES PASS
[x] byte-reproducible package PASS
[x] PR #26 merged
[x] PR CI #87 PASS
[x] post-merge CI #88 PASS on attempt 2
[x] blocking Phase 5A defects = 0
```

Canonical evidence: [`PHASE5A_STABLE_CANDIDATE.md`](PHASE5A_STABLE_CANDIDATE.md).

**Phase 5A is complete.**

## Phase 5B — public GitHub Release + final package lifecycle proof — accepted

Accepted release identity:

```text
version                    0.5.0
tag                        0.5.0
annotated tag object       6433cca08a8d8a213f0c0326447910c5ee732ff5
tag target                 b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree                6a837ed67049ae04cdf59656cc15997a8d9bb7b3
GitHub Release ID          387492480
package                    ai-search-optimizer-0.5.0.zip
package bytes              29397
package SHA-256            0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
publication run            34681042749
```

Acceptance gates:

```text
[x] annotated tag 0.5.0 points to the accepted source
[x] public GitHub Release is tied to tag 0.5.0
[x] published ZIP SHA-256 equals the accepted Phase 5A package
[x] checksum and release manifest are published
[x] uploaded ZIP is downloaded back and byte-compared before publication
[x] clean install from exact release package PASS
[x] exact historical 0.4.0 rebuild/SHA proof PASS
[x] 0.4.0 -> 0.5.0 in-place upgrade PASS
[x] verified deployment survives upgrade unchanged
[x] preserve uninstall + reinstall recovery PASS
[x] delete uninstall PASS
[x] release/tag/package drift fails closed
[x] WPCS + PHPCompatibilityWP PASS
[x] official WordPress Plugin Check PASS
[x] WP 5.6 / PHP 7.4 PASS
[x] WP 6.8 / PHP 8.2 PASS
[x] WP 7.1 / PHP 8.3 PASS
[x] Multisite + WooCommerce PASS
[x] real browser EN/ES PASS
[x] production CTA HTTP 200 in EN/ES for both request types
[x] CTA retains canonical AI Search Optimizer identity and bounded context
[x] CTA gate executes before any public release mutation
[x] PR #28 / CI #93 / post-merge CI #94 accepted
[x] PR #29 / CI #98 / post-merge CI #99 accepted
[x] publication workflow run 34681042749 PASS
[x] no false WordPress.org availability claim
[x] blocking Phase 5B defects = 0
```

The publication workflow creates a draft first, verifies the uploaded assets by downloading them back from GitHub, reruns lifecycle acceptance against that downloaded ZIP, and only then makes the release public. A pre-publication failure cleans draft/tag state rather than leaving partial release state.

The production CTA preflight verifies `https://kairoseth.com/custom-requests` for:

```text
en + implementation_support   PASS
en + business_customization   PASS
es + implementation_support   PASS
es + business_customization   PASS
```

The tag is annotated but unsigned. Cryptographic tag signing was not a Phase 5B acceptance requirement; integrity is instead pinned by exact source/tree/package SHA, reproducible build and asset round-trip verification.

Canonical evidence: [`PHASE5B_GITHUB_RELEASE.md`](PHASE5B_GITHUB_RELEASE.md). Durable incidents: [`CI_INCIDENTS.md`](CI_INCIDENTS.md).

**Phase 5B is complete.**

## Phase 5C — WordPress.org publication gate — in progress

### 5C.0 — submission-hardening contract — accepted by documentation

The WordPress.org preflight found a real release-metadata issue before submission: the immutable public `0.5.0` package contains a bundled `readme.txt` sentence that still describes `0.5.0` as a stable candidate and says a public GitHub Release is not yet claimed.

The accepted `0.5.0` package must not be modified or republished under the same version because its source/tag/package SHA is already frozen. The submission line therefore advances to `0.5.1`.

```text
[x] 0.5.0 immutable release identity preserved
[x] stale packaged readme statement identified before WordPress.org upload
[x] 0.5.1 selected as minimal submission-hardening patch
[x] Plugin URI / Author URI same-value rejection class explicitly prevented
[x] current header intentionally keeps both URI fields absent
[x] MIT confirmed as GPL-compatible for directory policy
[x] Tested up to 7.1 matches current stable WordPress major
[x] local-first / no-silent-telemetry boundary preserved
[x] external Kairoseth Custom Requests service remains explicitly documented
[x] no WordPress.org availability claim made
```

Canonical contract: [`PHASE5C_WORDPRESS_ORG_SUBMISSION.md`](PHASE5C_WORDPRESS_ORG_SUBMISSION.md).

### 5C.1 — exact 0.5.1 submission package — next

WordPress.org upload is blocked until:

```text
[ ] plugin Version = 0.5.1
[ ] connector version constant = 0.5.1
[ ] Stable tag = 0.5.1
[ ] stale 0.5.0 pre-publication statement removed from packaged readme.txt
[ ] concise 0.5.1 changelog entry added
[ ] no Plugin URI / Author URI equality hazard
[ ] readme/external-service policy review complete
[ ] package contents PASS
[ ] WPCS + PHPCompatibilityWP PASS
[ ] official Plugin Check PASS
[ ] WP 5.6 / PHP 7.4 PASS
[ ] WP 6.8 / PHP 8.2 PASS
[ ] WP 7.1 / PHP 8.3 PASS
[ ] Multisite + WooCommerce PASS
[ ] real browser EN/ES PASS
[ ] production CTA preflight PASS
[ ] clean install 0.5.1 PASS
[ ] 0.5.0 -> 0.5.1 upgrade PASS with expected state preserved
[ ] preserve/reinstall/delete lifecycle PASS
[ ] byte-reproducible 0.5.1 package PASS
[ ] immutable GitHub 0.5.1 tag/release published
[ ] exact 0.5.1 package SHA recorded
[ ] WordPress.org submission uses that exact ZIP
[ ] external WordPress.org review/approval completes successfully
[ ] directory listing is actually published
[ ] only then customer/catalog copy may claim WordPress.org availability
```

`ai-search-optimizer` remains the target directory slug until actually accepted/reserved.

## Claims gate

No customer-facing release may guarantee ranking, citation, indexing, crawling, AI ingestion, training inclusion or endorsement by external providers.
