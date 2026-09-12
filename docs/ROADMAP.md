# AI Search Optimizer — Roadmap

Status: **Phase 5B complete — public GitHub Release `0.5.0` verified; Phase 5C WordPress.org submission/review is next**  
Last reviewed: **12 September 2026**

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
Phase 5  stable public distribution / WordPress.org IN PROGRESS
  5A     stable candidate identity                 COMPLETE
  5B     GitHub release + lifecycle proof          COMPLETE
  5C     WordPress.org submission/review           NEXT
```

## Product model

The canonical customer model remains:

```text
useful local Free plugin
→ optional explicit Kairoseth CTA
→ support / improvement / custom development when requested
```

The local Free plugin is not a trial, license shell or mandatory cloud onboarding funnel. Kairoseth is optional and does not unlock or license accepted local functionality.

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

The local Free product is useful without a Kairoseth account and includes readiness inspection, eligible public-content inventory, WooCommerce awareness, deterministic `llms.txt` generation, validation, explicit publication, public read-back, exact SHA-256 verification, EN/ES responsive UX, Multisite isolation, explicit uninstall retention and reproducible package evidence.

Historical accepted 0.4.0 candidate:

```text
source commit          4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree            472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256        27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
Phase 2 blockers       0
```

Canonical closures: [`PHASE2A_CLOSURE.md`](PHASE2A_CLOSURE.md), [`PHASE2B_CLOSURE.md`](PHASE2B_CLOSURE.md), [`PHASE2C1_CLOSURE.md`](PHASE2C1_CLOSURE.md), [`PHASE2C2_CLOSURE.md`](PHASE2C2_CLOSURE.md), [`PHASE2C3_CLOSURE.md`](PHASE2C3_CLOSURE.md), [`PHASE2C4_CLOSURE.md`](PHASE2C4_CLOSURE.md).

## Phase 3 — optional support / custom-development UX — complete

### 3A — connection-readiness technical slice

The inherited managed REST connector remains available for separately configured integrations, but it is not the primary Free customer journey. Detailed evidence remains in [`PHASE3A_ACCEPTANCE.md`](PHASE3A_ACCEPTANCE.md).

### 3B — contextual support + custom CTA

Accepted customer flow:

```text
Tools → AI Search Optimizer Support
page load → zero Kairoseth request

Improve with Kairoseth
→ requestType=implementation_support

Request custom development
→ requestType=business_customization

explicit click
→ https://kairoseth.com/custom-requests
→ bounded product/technical query only
→ user chooses what information to submit
```

Automatic context is limited to `source`, `extensionSlug`, `extensionName`, `extensionVersion`, `hostPlatform`, `hostPlatformVersion`, `locale` and `requestType`. Site URL, llms.txt content/hash, inventory, administrator identity, WooCommerce content, credentials, tokens, prompts, conversations, logs, database data and arbitrary options are not attached automatically.

Canonical acceptance: [`PHASE3B_CONTEXTUAL_SUPPORT.md`](PHASE3B_CONTEXTUAL_SUPPORT.md).

### 3C — WordPress.org support/privacy hardening

WPCS, PHPCompatibilityWP, official Plugin Check, the WordPress/PHP runtime matrix, Multisite/WooCommerce, real-browser EN/ES UX and lifecycle/security regressions are blocking CI gates.

Canonical acceptance: [`PHASE3C_ACCEPTANCE.md`](PHASE3C_ACCEPTANCE.md).

**Phase 3 is closed.**

## Phase 4 — Kairoseth Extensions integration — complete

The canonical product route `https://kairoseth.com/products/ai-search-optimizer`, EN/ES product copy, sitemap/SEO coverage and server-side Custom Requests allow-list were integrated and verified in Kairoseth Platform. No WordPress.org availability was claimed.

Canonical acceptance: [`PHASE4_EXTENSIONS_INTEGRATION.md`](PHASE4_EXTENSIONS_INTEGRATION.md).

**Phase 4 is closed.**

## Phase 5 — stable public distribution / WordPress.org — in progress

### 5A — exact stable candidate identity — complete

Accepted `0.5.0` identity:

```text
source commit          b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree            6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package                ai-search-optimizer-0.5.0.zip
package bytes          29397
package entries        13
package SHA-256        0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
implementation PR      #26
PR CI                  #87 / run 34670016667 — PASS
post-merge CI          #88 / run 34670143261 — PASS on attempt 2
blocking defects       0
```

Canonical acceptance: [`PHASE5A_STABLE_CANDIDATE.md`](PHASE5A_STABLE_CANDIDATE.md).

**Phase 5A is closed.**

### 5B — public GitHub release + final package lifecycle proof — complete

Phase 5B permanently added real release-package lifecycle/upgrade acceptance, a fail-closed one-shot publisher and a production CTA gate before any public release mutation.

```text
lifecycle PR                    #28 merged
PR CI                           #93 / run 34671385877 — PASS
lifecycle merge SHA             6c47abe32152835debbc9a76869ea5af037f0501
post-merge CI                   #94 / run 34671531167 — PASS on attempt 2

publication PR                  #29 merged
PR CI                           #98 / run 34680787497 — PASS
publication tooling merge SHA   83c4cbcc21971e9cb28b099c64a05af18a9ba29d
post-merge CI                   #99 / run 34680928053 — PASS
publication run                 34681042749 — PASS
```

Public release identity:

```text
tag                              0.5.0
annotated tag object             6433cca08a8d8a213f0c0326447910c5ee732ff5
tag target                       b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
GitHub Release ID                387492480
release published                2026-09-12T07:34:35Z
package                          ai-search-optimizer-0.5.0.zip
package SHA-256                  0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
blocking Phase 5B defects        0
```

Before publication, the production CTA gate returned HTTP 200 for both request types in both EN and ES and verified the canonical `https://kairoseth.com/custom-requests` route, canonical AI Search Optimizer identity and privacy-bounded context. The publisher then rebuilt the accepted package, ran lifecycle proof, created a draft release, downloaded its assets back from GitHub, verified byte identity/SHA, reran lifecycle proof against the downloaded ZIP and only then published the release.

Canonical acceptance: [`PHASE5B_GITHUB_RELEASE.md`](PHASE5B_GITHUB_RELEASE.md). Durable CI incident history: [`CI_INCIDENTS.md`](CI_INCIDENTS.md).

**Phase 5B is closed.**

### 5C — WordPress.org submission/review — next

Required before any WordPress.org availability claim:

- final directory-policy/readme/external-service review;
- compatible code/assets/licenses;
- official Plugin Check remains PASS on the exact release line;
- submission uses the accepted `0.5.0` release package/metadata;
- WordPress.org external review/approval completes successfully;
- only after real approval/publication may Kairoseth/catalog/readme copy claim directory availability.

`ai-search-optimizer` remains only the target WordPress.org slug until actually accepted/reserved.

Phase 5 continues to follow feature branch → PR → CI → merge → verification. GitHub publication is now real; WordPress.org publication remains an external gate.

## Post-v1 candidates

Demand-led only: monitoring/drift, richer WooCommerce representations, agency/multi-site operations, additional AI Search diagnostics and reusable advanced capabilities.
