# AI Search Optimizer — Roadmap

Status: **Phase 3 in progress — contextual support/custom-development path is the active workstream; WordPress.org readiness is a blocking release constraint**  
Last reviewed: **10 September 2026**

```text
Phase 0  product/repository foundation              COMPLETE
Phase 1  standalone connector extraction           COMPLETE
Phase 2  useful local Free workflow                COMPLETE
  2A     local analysis + deterministic preview    COMPLETE
  2B     selection + safe local publication        COMPLETE
  2C     Free release hardening                    COMPLETE
Phase 3  optional support / custom-development UX  IN PROGRESS
  3A     connection-readiness technical slice      COMPLETE / SUPERSEDED AS PRIMARY CTA
  3B     contextual support + custom CTA            IN PROGRESS
  3C     support/privacy + directory hardening      BLOCKED by 3B
Phase 4  Extensions catalog integration            BLOCKED by Phase 3 acceptance
Phase 5  stable public distribution / WordPress.org BLOCKED by release gates
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

## Phase 3 — optional support / custom-development UX

### 3A — connection-readiness technical slice — complete, customer direction superseded

Phase 3A proved that the standalone plugin can expose local connection prerequisites without sending secrets or site state. Its technical acceptance remains valid and recorded in [`PHASE3A_ACCEPTANCE.md`](PHASE3A_ACCEPTANCE.md).

The customer-facing strategy changed after comparing the plugin with the accepted AI Transparency WordPress.org model. Connection readiness is **not** the primary growth/support CTA going forward. The inherited REST connector remains for compatible managed integrations, but local Free users are not pushed into cloud onboarding.

### 3B — contextual support + custom CTA — in progress

Goal: provide a small administrator-only, privacy-bounded bridge to Kairoseth while preserving local independence.

Required contract:

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

Automatic context is limited to:

```text
source
extensionSlug
extensionName
extensionVersion
hostPlatform
hostPlatformVersion
locale
requestType
```

Forbidden automatic context includes site URL, llms.txt content/hash, public-content inventory, administrator/customer identity, WooCommerce content, plugin/theme inventory, credentials, tokens, prompts, conversations, logs, database contents and arbitrary WordPress options.

Kairoseth Platform independently allow-lists `ai-search-optimizer` and resolves its canonical product name server-side. Browser/plugin-controlled context cannot select an arbitrary extension identity or recipient mailbox.

Exit gates:

- EN/ES support page and both CTAs;
- exact destination validation and request-type allow-list;
- zero outbound network activity on page load;
- no plugin-side lead submission or telemetry;
- no local feature gating/entitlement dependency;
- real browser desktop/mobile acceptance;
- inherited Phase 2 runtime/security/package gates remain green;
- official WordPress Plugin Check green;
- PR CI + post-merge CI green;
- blockers = 0.

### 3C — WordPress.org support/privacy hardening — blocked by 3B

After 3B acceptance, align the repository with the same release discipline used by AI Transparency. Required work includes:

- WordPress Coding Standards baseline;
- PHPCompatibility across supported PHP versions;
- EN/ES coverage suitable for the final package;
- official WordPress Plugin Check on production-shaped package;
- final external-service/readme review;
- install/update/deactivate/uninstall regression;
- final no-trialware/no-tracking/admin-UX policy review;
- stable-version metadata preparation.

## Phase 4 — Kairoseth Extensions integration

Before the catalog says `Available`:

- canonical Extensions registry/product record;
- public plugin identity and truthful version/distribution state;
- contextual Custom Request destination accepted;
- user-initiated share if included in the shared Extensions contract;
- required platform CI and production verification.

The product may remain `Building` before these gates complete.

## Phase 5 — stable public distribution / WordPress.org

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

## Post-v1 candidates

Demand-led only: monitoring/drift, richer WooCommerce representations, agency/multi-site operations, additional AI Search diagnostics and reusable advanced capabilities.
