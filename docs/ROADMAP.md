# AI Search Optimizer — Roadmap

Status: **Phase 5B complete; Phase 5C.0 and 5C.1 complete; exact `0.5.1` package accepted on PR + post-merge main; Phase 5C.2 immutable GitHub release is next; WordPress.org submission has not started**  
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
  3B     contextual support + custom CTA           COMPLETE
  3C     support/privacy + directory hardening     COMPLETE
Phase 4  Extensions catalog integration            COMPLETE
Phase 5  stable public distribution / WordPress.org IN PROGRESS
  5A     stable candidate identity                 COMPLETE
  5B     GitHub release + lifecycle proof          COMPLETE
  5C     WordPress.org submission/review           IN PROGRESS
    5C.0 submission-hardening contract             COMPLETE
    5C.1 0.5.1 package hardening                   COMPLETE
    5C.2 immutable 0.5.1 GitHub release            NEXT
    5C.3 WordPress.org exact-ZIP submission         BLOCKED ON 5C.2
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

### 5C — WordPress.org submission/review — in progress

#### 5C.0 — submission-hardening contract — complete

The Phase 5C preflight found that immutable public `0.5.0` still contains stale pre-publication readme wording. That release remains immutable, so WordPress.org submission moved to the minimal `0.5.1` submission-hardening line.

#### 5C.1 — exact 0.5.1 package hardening — complete

The patch aligns Version/connector/Stable tag at `0.5.1`, removes stale packaged readme wording, preserves the absent Plugin URI/Author URI safety choice and changes no customer feature, REST namespace, schema, authorization rule or outbound-data policy.

Accepted identity:

```text
version                   0.5.1
package                   ai-search-optimizer-0.5.1.zip
package bytes             29560
package entries           13
package SHA-256           2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
PR                        #32
PR head                   78f36816bd7bedc5f907f2d6ab9ad4fbf5898d4c
final PR CI               #107 / run 34692689075 — PASS
merge SHA                 c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
accepted source tree      e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
post-merge CI             #108 / run 34692826856 — PASS
```

The exact candidate passed metadata alignment, WPCS/PHPCompatibility, official Plugin Check, WP 5.6/PHP 7.4, WP 6.8/PHP 8.2, WP 7.1/PHP 8.3, Multisite/WooCommerce, real-browser EN/ES, production CTA EN/ES × both request types, clean install, `0.5.0 -> 0.5.1` upgrade, preserve/reinstall/delete lifecycle and reproducible packaging. Final PR CI #107 and post-merge main CI #108 both reproduced SHA-256 `2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b` with 29560 bytes and 13 entries.

CI #104's CTA 403 is retained as a structured incident. Subsequent CI proved both curl-default and browser-equivalent HTTP 200 without Kairoseth application-code or packaged-product changes; the exact upstream edge condition behind the earlier 403 remains unconfirmed rather than being mislabeled as a version defect.

Canonical contract/evidence: [`PHASE5C_WORDPRESS_ORG_SUBMISSION.md`](PHASE5C_WORDPRESS_ORG_SUBMISSION.md). Incident evidence: [`CI_INCIDENTS.md`](CI_INCIDENTS.md).

**Phase 5C.1 is closed.**

#### 5C.2 — immutable 0.5.1 GitHub release — next

Publish an immutable GitHub `0.5.1` tag/release from the accepted package identity and prove the released ZIP SHA remains exactly `2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b`. Publication must fail closed on source/tree/package drift.

#### 5C.3+ — external WordPress.org gate

Only after 5C.2 may the exact accepted/released ZIP be submitted to WordPress.org. External review, requested changes, approval and actual directory publication remain separate gates. `ai-search-optimizer` remains only the target directory slug until accepted/reserved, and no customer-facing copy may claim WordPress.org availability before the directory listing is genuinely live.

Phase 5 continues to follow feature branch → PR → CI → merge → verification.

## Post-v1 candidates

Demand-led only: monitoring/drift, richer WooCommerce representations, agency/multi-site operations, additional AI Search diagnostics and reusable advanced capabilities.