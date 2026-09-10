# AI Search Optimizer — Acceptance

Status: **Canonical acceptance definition — Phase 2A accepted; Phase 2B in progress; product not released**  
Last reviewed: **10 September 2026**

## Engineering inheritance

This repository inherits the Kairoseth rules for minimum-sufficient validation, finish-before-advance, EN/ES customer surfaces, least privilege, server-authoritative cloud authorization, actionable diagnostics, durable failure learning and feature branch → PR → CI → merge → verification.

## Phase 0 / 1 foundation acceptance

The repository foundation/extraction is accepted:

```text
[x] public dedicated repository exists
[x] MIT root license + plugin header agree
[x] product identity / naming / architecture / roadmap documented
[x] accepted 0.3.2 provenance recorded
[x] standalone 0.4.0 source present
[x] legacy connector schema/REST/capability/state identifiers retained
[x] no platform/provider credentials embedded
[x] PHP syntax PASS
[x] static/contract regression checks PASS
[x] single-site get_site() guard protected
[x] package build PASS
[x] ZIP structure/integrity PASS
[x] PR CI PASS
[x] blocking extraction defects = 0
```

This closes extraction only. It does **not** mark AI Search Optimizer Available.

## Phase 2A — local analysis + deterministic preview — accepted

```text
[x] EN/ES WordPress admin workspace present
[x] local robots/search-visibility readiness shown
[x] local sitemap readiness shown
[x] stored llms.txt deployment readiness shown
[x] published non-password public WordPress inventory generated
[x] WooCommerce public products included when available
[x] current-site Multisite boundary communicated
[x] deterministic source-grounded llms.txt preview generated
[x] unchanged logical inventory order produces byte-identical output
[x] generated preview contains no timestamps
[x] validator covers heading, size and resource presence
[x] validator rejects duplicate resource URLs
[x] validator rejects URLs outside the current site
[x] exact preview SHA-256 exposed
[x] local Phase 2A path performs no publication/state mutation
[x] no content sent to Kairoseth / AI providers / third-party analytics
[x] compatibility/security regression remains green
[x] plugin package includes the local Free modules
[x] PR CI #5 PASS
[x] post-merge CI #6 PASS
[x] blocking Phase 2A defects = 0
```

Accepted implementation evidence:

```text
PR #3                                    merged
PR head                                  828d1f1188aaf282f5b1fcce055fd912021df75b
merge SHA                                61b33412484a20a505726c808ec64bc9dc8953a3
```

Canonical Phase 2A record: [`PHASE2A_CLOSURE.md`](PHASE2A_CLOSURE.md).

## Phase 2B — selection + safe local publication

Phase 2B can close only when all applicable items are true:

```text
[ ] explicit per-resource selection controls
[ ] explicit empty selection remains empty
[ ] submitted resource IDs cannot introduce arbitrary URLs/content
[ ] selected artifact is rebuilt from current eligible WordPress inventory
[ ] preview action performs no mutation
[ ] publish action is explicit and nonce protected
[ ] inherited least-privilege capability still gates the admin workspace
[ ] validator runs before any write
[ ] stale-page/current-state mismatch stops publication
[ ] same-content publish is idempotent and avoids unnecessary rewrites
[ ] local publication uses one bounded deployment mutation point
[ ] inherited deployment option / public llms.txt route remain compatible
[ ] local publication origin is recorded without breaking REST schema
[ ] stored content integrity is rechecked immediately after mutation
[ ] public verification performs an independent HTTP read-back
[ ] public verification does not follow redirects
[ ] public body SHA-256 must exactly equal stored/generated SHA-256
[ ] verification can be retried without changing stored content
[ ] failed public verification leaves stored content recoverable
[ ] state-change / validation / storage / verification failures are actionable in EN/ES
[ ] no provider credentials or arbitrary filesystem writes introduced
[ ] compatibility/security + Phase 2A regressions remain green
[ ] plugin package contains the publication module
[ ] dedicated Phase 2B regression PASS
[ ] PR CI PASS
[ ] post-merge CI PASS
[ ] blocking Phase 2B defects = 0
```

A representative WordPress install/runtime matrix, Multisite/WooCommerce runtime acceptance, responsive/accessibility review and uninstall/update behavior remain Phase 2C release-hardening gates.

## Public Free release acceptance

Before the first public product release:

```text
[ ] useful account-free local Free workflow
[x] robots.txt / sitemap / llms.txt readiness state
[ ] public WordPress content inventory/selection
[x] deterministic source-grounded llms.txt generation
[x] validator + actionable findings
[ ] explicit local publication
[ ] local public verification
[ ] Multisite site isolation
[ ] WooCommerce behavior accurate where claimed
[x] EN/ES customer UI baseline
[ ] accessibility/responsive acceptance where UI is affected
[ ] install/activate/update/deactivate/uninstall policy tested
[ ] retained/deleted data documented
[x] no silent telemetry/content transmission in Phase 2A
[ ] security/privacy disclosure matches final Free implementation
[ ] diagnostics are structured and secret-free
[ ] changelog/version/tag aligned
[ ] immutable package built in CI
[ ] package checksum available
[ ] representative WordPress/PHP compatibility evidence
[ ] blocking defects = 0
```

The partially checked release list records capabilities already established by accepted phases; it does not mean the Free release as a whole is accepted.

## Kairoseth-connected acceptance

Cloud features additionally require:

- organization/product authorization resolved server-side;
- local plugin state cannot grant roles/entitlements;
- exact site identity is server-validated;
- least-privilege WordPress credentials;
- no provider credentials in plugin/browser/model context;
- tenant isolation;
- explicit human publication authority;
- compare-and-set or equivalent safe mutation contract;
- independent public verification for managed publication;
- failure of Kairoseth services fails safely.

The accepted Phase 5B WordPress evidence is regression evidence for the inherited connector contract, not automatic acceptance of future standalone features.

## Kairoseth Extensions Available gate

Before the Kairoseth catalog says Available, also require:

- canonical registry/product page;
- real public distribution action;
- contextual Custom Request flow through shared Kairoseth module;
- user-initiated share action;
- truthful Free/Pro/Custom presentation;
- required platform CI and production verification.

A missing shared Custom Requests implementation blocks catalog Available even if the plugin package itself is technically releasable.

## WordPress.org gate

Before directory submission:

- run WordPress Plugin Check;
- use a GPL-compatible license declaration consistently;
- `readme.txt` and plugin version/stable tag agree;
- no prohibited tracking/trialware/deceptive claims;
- SaaS dependency, if used, is described accurately;
- code/assets/third-party dependencies have compatible licensing;
- plugin is complete and functional at submission time.

## Claims gate

No customer-facing release may guarantee ranking, citation, indexing, crawling, AI ingestion, training inclusion or endorsement by external providers.
