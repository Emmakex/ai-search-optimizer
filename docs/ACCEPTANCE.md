# AI Search Optimizer — Acceptance

Status: **Canonical acceptance definition — product not released**  
Last reviewed: **10 September 2026**

## Engineering inheritance

This repository inherits the Kairoseth rules for minimum-sufficient validation, finish-before-advance, EN/ES customer surfaces, least privilege, server-authoritative cloud authorization, actionable diagnostics, durable failure learning and feature branch → PR → CI → merge → verification.

## Phase 0 / 1 foundation acceptance

The repository foundation/extraction can close when all applicable items are true:

```text
[ ] public dedicated repository exists
[ ] MIT root license + plugin header agree
[ ] product identity / naming / architecture / roadmap documented
[ ] accepted 0.3.2 provenance recorded
[ ] standalone 0.4.0 source present
[ ] legacy connector schema/REST/capability/state identifiers retained
[ ] no platform/provider credentials embedded
[ ] PHP syntax PASS
[ ] static/contract regression checks PASS
[ ] single-site get_site() guard protected
[ ] package build PASS
[ ] ZIP structure/integrity PASS
[ ] PR CI PASS
[ ] blocking extraction defects = 0
```

This closes extraction only. It does **not** mark AI Search Optimizer Available.

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
