# AI Search Optimizer — Acceptance

Status: **Canonical acceptance definition — Phase 2 accepted; Phase 3A historical/superseded; Phase 3B WordPress.org-first contextual support in progress**  
Last reviewed: **10 September 2026**

## Engineering inheritance

This repository inherits the Kairoseth rules for minimum-sufficient validation, finish-before-advance, EN/ES customer surfaces, least privilege, actionable diagnostics, durable failure learning and feature branch → PR → CI → merge → post-merge verification.

For WordPress.org-facing work, current directory policy and official WordPress Plugin Check are blocking requirements. Canonical policy: [`WORDPRESS_ORG_POLICY.md`](WORDPRESS_ORG_POLICY.md).

## Accepted foundation and Free product

Phases 0, 1 and 2 are accepted. The plugin already provides a useful account-free local workflow:

```text
inspect local AI Search readiness
→ inventory/select eligible public WordPress content
→ include public WooCommerce products when available
→ build deterministic source-grounded llms.txt
→ validate
→ explicitly publish
→ independently read back public /llms.txt
→ verify exact SHA-256
```

Accepted safeguards include:

- dedicated WordPress capability/least-privilege deployment role;
- exact single-site/Multisite identity and site-local state;
- no arbitrary filesystem writes;
- deterministic generation without generated timestamps;
- validator for structure/size/duplicates/site scope;
- nonce/capability-gated mutation;
- compare-before-write and idempotent same-content publication;
- stored-content integrity checks;
- public verification with redirects disabled;
- preserve/delete uninstall policy with safe `preserve` default;
- real WordPress/PHP runtime matrix;
- real Multisite + WooCommerce isolation/runtime acceptance;
- real EN/ES desktop/mobile browser acceptance;
- reproducible ZIP/checksum/manifest evidence;
- no silent transmission of local site content to Kairoseth, AI providers or third-party analytics.

Canonical Phase 2 closure records:

- [`PHASE2A_CLOSURE.md`](PHASE2A_CLOSURE.md)
- [`PHASE2B_CLOSURE.md`](PHASE2B_CLOSURE.md)
- [`PHASE2C1_CLOSURE.md`](PHASE2C1_CLOSURE.md)
- [`PHASE2C2_CLOSURE.md`](PHASE2C2_CLOSURE.md)
- [`PHASE2C3_CLOSURE.md`](PHASE2C3_CLOSURE.md)
- [`PHASE2C4_CLOSURE.md`](PHASE2C4_CLOSURE.md)

## Accepted Free 0.4.0 release-candidate identity

```text
version                                   0.4.0
source commit                             4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree                               472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package                                   ai-search-optimizer-0.4.0.zip
package bytes                             21745
package entries                           11
package SHA-256                           27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
post-merge CI artifact id                 10155308031
```

This is internal release-candidate evidence only. It is **not** a claim of GitHub Release or WordPress.org availability.

## Historical Phase 3A — technically accepted, customer direction superseded

Phase 3A implemented a non-authoritative Kairoseth connection-readiness screen on the `0.5.0-dev` line and passed its technical acceptance:

```text
PR #15                                   merged
PR CI #38                                PASS — 7/7 jobs
merge SHA                                6b771f3b54915a57d246d556638c3eefc9755208
post-merge CI #39                        PASS — 7/7 jobs
blocking Phase 3A defects                0
```

The evidence remains valid engineering history. However, before any stable/public release the product strategy changed to the same WordPress.org-first model used by `Emmakex/AI-Transparency`.

Therefore the Phase 3A customer-facing cloud-onboarding surface is **superseded**, not the target directory experience. `kairoseth-platform` PR #223 was intentionally closed without merge.

Canonical historical record: [`PHASE3A_ACCEPTANCE.md`](PHASE3A_ACCEPTANCE.md).

## Phase 3B — contextual support + custom improvement — current acceptance

Canonical detailed checklist: [`PHASE3B_ACCEPTANCE.md`](PHASE3B_ACCEPTANCE.md).

Blocking contract:

```text
[ ] Tools → AI Search Optimizer Support exists in EN/ES
[ ] administrator authority required
[ ] page load performs zero Kairoseth requests
[ ] support page performs no local product-state mutation
[ ] explicit support CTA
[ ] explicit custom-development/improvement CTA
[ ] exact destination https://kairoseth.com/custom-requests
[ ] destination validation fails closed for unsafe variants
[ ] exact bounded query-key allow-list
[ ] requestType allow-list
[ ] no automatic site/home URL transmission
[ ] no automatic administrator/customer identity transmission
[ ] no automatic llms.txt body/resources/findings transmission
[ ] no automatic WooCommerce customer/order transmission
[ ] no automatic credentials/tokens/Application Password transmission
[ ] no automatic prompts/conversations/logs/database/options transmission
[ ] no tracking/telemetry/click tracking
[ ] no dashboard-wide advertising or non-contextual nags
[ ] Free local workflow remains complete without Kairoseth
[ ] real Chromium EN/ES desktop/mobile PASS
[ ] official WordPress Plugin Check PASS
[ ] supported WordPress/PHP runtime matrix PASS
[ ] Multisite + WooCommerce runtime PASS
[ ] reproducible development package PASS
[ ] PR CI PASS
[ ] post-merge CI PASS
[ ] blocking defects = 0
```

### Exact contextual allow-list

```text
source=extension
extensionSlug=ai-search-optimizer
extensionName=AI Search Optimizer
extensionVersion=<real plugin version>
hostPlatform=wordpress
hostPlatformVersion=<real WordPress version>
locale=<en|es>
requestType=<allow-listed value>
```

WordPress UI request types:

```text
implementation_support
business_customization
```

The user decides what additional personal, business or technical information to enter after navigating to Kairoseth.

## WordPress.org product boundary

The directory plugin must remain a complete useful Free product. Kairoseth is not a license server, entitlement dependency, trial controller or local feature unlock.

The plugin must not introduce:

```text
trial expiry
usage quota for local features
paid locks around code shipped locally
silent telemetry/tracking
remote executable-code delivery
automatic lead creation from WordPress
public-site promotional links without opt-in
dashboard hijacking or persistent non-contextual nags
```

Optional external service/support behavior must be user initiated and accurately disclosed in `readme.txt`.

## Phase 3C — WordPress.org compliance parity — next after 3B

Before directory submission, reach the release-engineering parity already used by AI Transparency:

- official WordPress Plugin Check (`plugin_repo`, security, accessibility, performance);
- WordPress Coding Standards;
- PHPCompatibility across the declared support range;
- WordPress-native i18n/gettext with EN/ES parity and compiled Spanish catalog where applicable;
- real packaged WordPress runtime acceptance;
- real responsive/accessibility acceptance;
- real Multisite isolation/lifecycle;
- WooCommerce runtime acceptance where claimed;
- upgrade path acceptance;
- uninstall/data-retention acceptance;
- reproducible stable ZIP/checksum/manifest;
- aligned header/version/readme/stable-tag/changelog metadata;
- documented external-service/privacy boundary;
- zero blocking directory-submission defects.

## Inherited managed REST compatibility

The following internal protocol remains solely for backward compatibility with existing accepted Kairoseth Platform deployments:

```text
REST namespace                           kairoseth-ai-web-readiness/v1
GET                                      /connection
GET                                      /deployment
PUT                                      /deployment
connector schema                         2
site pin                                 blogId + networkId + exact homeUrl
safe mutation                            expectedCurrentDeployed + expectedCurrentContentHash
```

It is not a WordPress.org entitlement or commercial onboarding mechanism. Any removal/rename requires a separate versioned compatibility decision.

## Public distribution / Available gate

The plugin may be marked `Available` in Kairoseth Extensions only after truthful public distribution exists and the corresponding registry/public-page acceptance is green.

WordPress.org availability may be claimed only after the external directory has independently approved the plugin and the public listing is live.

## Claims gate

No customer-facing release may guarantee ranking, citation, indexing, crawling, AI/model ingestion, training inclusion or endorsement by external providers.
