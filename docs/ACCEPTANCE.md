# AI Search Optimizer — Acceptance

Status: **Canonical acceptance definition — Phase 2 / Free 0.4.0 release candidate accepted; public distribution not yet performed**  
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

This closes extraction only. It does **not** by itself mark AI Search Optimizer Available.

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

Canonical Phase 2A record: [`PHASE2A_CLOSURE.md`](PHASE2A_CLOSURE.md).

## Phase 2B — selection + safe local publication — accepted

```text
[x] explicit per-resource selection controls
[x] explicit empty selection remains empty
[x] submitted resource IDs cannot introduce arbitrary URLs/content
[x] selected artifact is rebuilt from current eligible WordPress inventory
[x] preview action performs no mutation
[x] publish action is explicit and nonce protected
[x] inherited least-privilege capability still gates the admin workspace
[x] validator runs before any write
[x] stale-page/current-state mismatch stops publication
[x] same-content publish is idempotent and avoids unnecessary rewrites
[x] local publication uses one bounded deployment mutation point
[x] inherited deployment option / public llms.txt route remain compatible
[x] local publication origin is recorded without breaking REST schema
[x] stored content integrity is rechecked immediately after mutation
[x] public verification performs an independent HTTP read-back
[x] public verification does not follow redirects
[x] public body SHA-256 must exactly equal stored/generated SHA-256
[x] verification can be retried without changing stored content
[x] failed public verification leaves stored content recoverable
[x] state-change / validation / storage / verification failures are actionable in EN/ES
[x] no provider credentials or arbitrary filesystem writes introduced
[x] compatibility/security + Phase 2A regressions remain green
[x] plugin package contains the publication module
[x] dedicated Phase 2B regression PASS
[x] PR CI #10 PASS
[x] post-merge CI #11 PASS
[x] blocking Phase 2B defects = 0
```

CI #9 was a regression-fixture interpolation failure, not a product defect. Signature: `d48cb3aba4e635dfa5f275bf554bd46ca36a586923f5cc4a654d357cf2475126`.

Canonical Phase 2B record: [`PHASE2B_CLOSURE.md`](PHASE2B_CLOSURE.md).

## Phase 2C1 — lifecycle + data retention — accepted

```text
[x] EN/ES data/uninstall settings surface exists
[x] retention values are bounded to preserve/delete
[x] default and invalid values fail safe to preserve
[x] retention setting change is capability-gated and nonce-protected
[x] deactivation preserves stored deployment content
[x] deactivation preserves uninstall preference
[x] uninstall always removes setup marker
[x] uninstall always removes retention preference
[x] uninstall removes administrator deployment capability
[x] uninstall removes deployer role assignments and role
[x] stored deployment deletion occurs only for explicit delete mode
[x] preserve mode leaves stored deployment recoverable after reinstall
[x] Multisite cleanup executes in each site context
[x] no network-global deployment deletion is used
[x] uninstall performs no outbound request
[x] uninstall performs no arbitrary filesystem write
[x] uninstall.php and lifecycle module are included in package
[x] README/readme/SECURITY/CHANGELOG reflect implemented lifecycle behavior
[x] dedicated lifecycle regression PASS
[x] PR CI #14 PASS
[x] post-merge CI #15 PASS
[x] blocking Phase 2C1 defects = 0
```

Canonical policy: [`DATA_RETENTION.md`](DATA_RETENTION.md). Canonical closure: [`PHASE2C1_CLOSURE.md`](PHASE2C1_CLOSURE.md).

## Phase 2C2 — WordPress/PHP runtime compatibility — accepted

Representative runtime evidence uses the generated ZIP, not the repository source tree.

```text
[x] packaged ZIP installs on WordPress 5.6 / PHP 7.4
[x] packaged ZIP installs on WordPress 6.8 / PHP 8.2
[x] packaged ZIP installs on WordPress 7.1 / PHP 8.3
[x] activation succeeds and grants expected setup/capability state
[x] real public WordPress content generates valid deterministic llms.txt
[x] local publication stores the exact expected SHA-256
[x] public /llms.txt returns the stored content
[x] independent public read-back/hash verification passes
[x] deactivation preserves deployment and uninstall preference
[x] reactivation restores setup and public verification
[x] uninstall preserve retains deployment data while cleaning plugin state
[x] uninstall delete removes deployment data and plugin state
[x] runtime harness freezes WordPress core to prevent fixture self-update races
[x] prior contract/2A/2B/2C1 gates remain green
[x] CI #19 PASS
[x] post-merge CI #20 PASS
[x] blocking Phase 2C2 defects = 0
```

CI #18 was a historical WordPress 5.6 fixture self-update race before plugin installation, not a plugin defect. Signature: `b4edb0c72807e8a6dd35cc3285aac513735bf810c442dbfd5f7b1f420b99e640`.

Canonical matrix: [`RUNTIME_COMPATIBILITY.md`](RUNTIME_COMPATIBILITY.md). Canonical closure: [`PHASE2C2_CLOSURE.md`](PHASE2C2_CLOSURE.md).

## Phase 2C3 — Multisite/WooCommerce + UX hardening — accepted

```text
[x] packaged plugin network-activates on real WordPress 7.1 / PHP 8.3 Multisite
[x] main site receives independent setup/deployment state
[x] subsite created after network activation receives site-local setup
[x] exact Multisite blog identity is preserved for main and non-main sites
[x] main-site and subsite public llms.txt artifacts are independently generated and verified
[x] each site has a distinct stored/public SHA-256
[x] publishing on the subsite cannot mutate the main-site deployment
[x] network deactivation preserves each site's deployment state
[x] network reactivation restores public verification for each site
[x] network uninstall applies preserve/delete policy independently per site
[x] WooCommerce 11.1.0 installs and activates on the supported current runtime
[x] WooCommerce is activated only in the target subsite during isolation test
[x] public published products appear in local inventory
[x] draft/private/password-protected products are excluded
[x] WooCommerce detection requires no consumer/API keys
[x] EN/ES admin copy remains complete for customer actions
[x] real Chromium acceptance runs in English and Spanish
[x] admin workflow passes 1280x900 desktop viewport
[x] admin workflow passes 390x844 narrow/mobile viewport
[x] controls have accessible names and native focusable semantics
[x] keyboard focus remains visibly styled
[x] mobile primary controls remain touch-friendly
[x] primary workflow has no page-level horizontal overflow
[x] wide inventory is contained on narrow screens
[x] prior runtime/security/2A/2B/2C1/2C2 gates remain green
[x] CI #24 PASS — 6/6 jobs
[x] post-merge CI #25 PASS — 6/6 jobs
[x] blocking Phase 2C3 defects = 0
```

CI #23 failed because pinned WP-CLI 2.12.0 did not register `wp site get`; the product had not failed. Signature: `6f27a415ed0943186949a4096cb8d9e02665b1f629d2ade98ca11426cc4e6bab`. The harness now resolves the validated numeric blog ID through WordPress core `get_site_url()`.

Canonical Phase 2C3 record: [`PHASE2C3_CLOSURE.md`](PHASE2C3_CLOSURE.md).

## Phase 2C4 — release package + final acceptance — accepted

```text
[x] final plugin header/version/Stable tag agree at 0.4.0
[x] connector version constant agrees at 0.4.0
[x] WordPress minimum 5.6 and PHP minimum 7.4 agree across metadata
[x] Tested up to 7.1 matches accepted current runtime evidence
[x] README/readme/CHANGELOG describe implemented Free workflow, not planned behavior
[x] SECURITY/privacy/data-retention docs match release candidate
[x] dependency and external-service claims are accurate
[x] MIT licensing remains internally consistent and GPL-compatible for future WordPress.org review
[x] exact release-candidate source commit recorded
[x] exact source tree recorded
[x] deterministic package build normalizes permissions/timestamps/entry order
[x] release builder requires two consecutive byte-identical ZIP builds
[x] package manifest recorded in CI evidence
[x] standalone .sha256 generated and verified
[x] release-candidate ZIP SHA-256 recorded
[x] CI artifact contains ZIP + checksum + manifest
[x] complete validate + WP/PHP matrix + Multisite/WooCommerce + browser EN/ES gates PASS on PR source
[x] complete suite PASS again on main merge commit
[x] CI #28 PASS — 7/7 jobs
[x] post-merge CI #29 PASS — 7/7 jobs
[x] blocking Phase 2 defects = 0
[x] formal Free release-candidate decision = GO for later public distribution
```

Accepted release-candidate identity:

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

The same source tree produced the same plugin ZIP SHA-256 in PR CI #28 and post-merge CI #29. The Actions artifact is time-limited supplemental evidence, not the permanent release channel.

Canonical Phase 2C4 record: [`PHASE2C4_CLOSURE.md`](PHASE2C4_CLOSURE.md).

## Public Free release-candidate acceptance — complete

```text
[x] useful account-free local Free workflow
[x] robots.txt / sitemap / llms.txt readiness state
[x] public WordPress content inventory/selection
[x] deterministic source-grounded llms.txt generation
[x] validator + actionable findings
[x] explicit local publication
[x] local public verification contract
[x] Multisite site isolation runtime acceptance
[x] WooCommerce behavior runtime acceptance where claimed
[x] EN/ES customer UI baseline
[x] accessibility/responsive acceptance where UI is affected
[x] install/activate/update/deactivate/uninstall policy tested in real runtime
[x] retained/deleted data documented
[x] no silent telemetry/content transmission in local Free workflow
[x] security/privacy disclosure covers current Free lifecycle behavior
[x] diagnostics are structured and secret-free at contract level
[x] changelog/version/WordPress Stable tag aligned for release candidate
[x] reproducible package/checksum/manifest evidence recorded
[x] representative WordPress/PHP compatibility evidence
[x] blocking Phase 2 defects = 0
```

**Decision: GO for a later public-distribution action.** This acceptance does not itself create a GitHub Release, public Git tag, WordPress.org listing or Kairoseth Extensions `Available` state.

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

The accepted Phase 5B WordPress evidence is regression evidence for the inherited connector contract, not automatic acceptance of future standalone cloud features.

## Kairoseth Extensions Available gate

Before the Kairoseth catalog says Available, also require:

- canonical registry/product page;
- real public distribution action;
- contextual Custom Request flow through shared Kairoseth module;
- user-initiated share action;
- truthful Free/Pro/Custom presentation;
- required platform CI and production verification.

A missing shared Custom Requests implementation blocks catalog Available even though the Free release candidate is technically accepted.

## WordPress.org gate

Before directory submission:

- run WordPress Plugin Check;
- use a GPL-compatible license declaration consistently;
- `readme.txt` and plugin version/Stable tag agree;
- no prohibited tracking/trialware/deceptive claims;
- SaaS dependency, if used, is described accurately;
- code/assets/third-party dependencies have compatible licensing;
- plugin is complete and functional at submission time.

## Claims gate

No customer-facing release may guarantee ranking, citation, indexing, crawling, AI ingestion, training inclusion or endorsement by external providers.
