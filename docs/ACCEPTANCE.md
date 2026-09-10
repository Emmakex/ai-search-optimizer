# AI Search Optimizer — Acceptance

Status: **Canonical acceptance definition — product not released**  
Last reviewed: **10 September 2026**

## Engineering inheritance

This repository inherits the Kairoseth rules for minimum-sufficient validation, finish-before-advance, EN/ES customer surfaces, least privilege, server-authoritative cloud authorization, actionable diagnostics, durable failure learning and feature branch → PR → CI → merge → verification.

## Phase 0 / 1 foundation acceptance

The repository foundation/extraction can close when all applicable items are true:

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

## Phase 2A — local analysis + deterministic preview

Phase 2A can close only when all applicable items are true:

```text
[ ] EN/ES WordPress admin workspace present
[ ] local robots/search-visibility readiness shown
[ ] local sitemap readiness shown
[ ] stored llms.txt deployment readiness shown
[ ] published non-password public WordPress inventory generated
[ ] WooCommerce public products included when available
[ ] current-site Multisite boundary communicated
[ ] deterministic source-grounded llms.txt preview generated
[ ] unchanged logical inventory order produces byte-identical output
[ ] generated preview contains no timestamps
[ ] validator covers heading, size and resource presence
[ ] validator rejects duplicate resource URLs
[ ] validator rejects URLs outside the current site
[ ] exact preview SHA-256 exposed
[ ] local Phase 2A path performs no publication/state mutation
[ ] no content sent to Kairoseth / AI providers / third-party analytics
[ ] compatibility/security regression remains green
[ ] plugin package includes the local Free modules
[ ] PR CI PASS
[ ] post-merge CI PASS
[ ] blocking Phase 2A defects = 0
```

Phase 2B remains blocked until this boundary is accepted.

## Public Free release acceptance

Before the first public product release:

```text
[ ] useful account-free local Free workflow
[ ] robots.txt / sitemap / llms.txt readiness state
[ ] public WordPress content inventory/selection
[ ] deterministic source-grounded llms.txt generation
[ ] validator + actionable findings
[ ] explicit local publication
[ ] local public verification
[ ] Multisite site isolation
[ ] WooCommerce behavior accurate where claimed
[ ] EN/ES customer UI
[ ] accessibility/responsive acceptance where UI is affected
[ ] install/activate/update/deactivate/uninstall policy tested
[ ] retained/deleted data documented
[ ] no silent telemetry/content transmission
[ ] security/privacy disclosure matches implementation
[ ] diagnostics are structured and secret-free
[ ] changelog/version/tag aligned
[ ] immutable package built in CI
[ ] package checksum available
[ ] representative WordPress/PHP compatibility evidence
[ ] blocking defects = 0
```

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
