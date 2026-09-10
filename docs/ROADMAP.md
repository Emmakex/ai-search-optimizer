# AI Search Optimizer — Roadmap

Status: **Phase 2 complete — Free 0.4.0 release candidate accepted; Phase 3 optional Kairoseth connection is the next product-development boundary**  
Last reviewed: **10 September 2026**

```text
Phase 0  product/repository foundation          COMPLETE
Phase 1  standalone connector extraction       COMPLETE
Phase 2  useful local Free workflow             COMPLETE
  2A     local analysis + deterministic preview COMPLETE
  2B     selection + safe local publication     COMPLETE
  2C     Free release hardening                 COMPLETE
    2C1  lifecycle + data retention             COMPLETE
    2C2  WordPress/PHP runtime compatibility    COMPLETE
    2C3  Multisite/WooCommerce + UX hardening   COMPLETE
    2C4  release package + final acceptance     COMPLETE
Phase 3  Kairoseth-connected customer UX        NEXT
Phase 4  Custom Request + share + catalog       BLOCKED by shared/platform dependencies
Phase 5  public distribution / WordPress.org    UNBLOCKED by Phase 2; distribution gates pending
```

## Phase 0 — product foundation — complete

Accepted:

- dedicated public repository;
- MIT license;
- canonical name/slug/SEO contract;
- product/architecture/roadmap/acceptance/security/provenance docs;
- engineering rules adapted from Kairoseth;
- no false Available/release claims.

## Phase 1 — standalone extraction — complete

The accepted WordPress connector 0.3.2 became the standalone 0.4.0 line with protocol/state compatibility preserved.

```text
PR #1                                    merged
merge SHA                                2b9d0df93df99ccc0cd4e99f708a3a5a72bd4212
PR CI #1                                 PASS
post-merge CI #2                         PASS
blocking extraction defects              0
```

Canonical closure: [`FOUNDATION_CLOSURE.md`](FOUNDATION_CLOSURE.md).

## Phase 2 — useful Free local workflow — complete

The core Free edition is accepted as useful without a Kairoseth account and does not silently transmit local site content to Kairoseth, AI providers or third-party analytics.

### Phase 2A — local analysis + deterministic preview — complete

Accepted:

- EN/ES WordPress admin workspace;
- robots/search-visibility, sitemap and `llms.txt` readiness;
- eligible published public WordPress content inventory;
- WooCommerce public-product awareness;
- deterministic source-grounded `llms.txt` generation;
- structure/size/duplicate/same-site validation;
- exact preview SHA-256;
- no mutation or remote content transmission in the analysis path.

```text
PR #3                                    merged
PR CI #5                                 PASS
merge SHA                                61b33412484a20a505726c808ec64bc9dc8953a3
post-merge CI #6                         PASS
blocking Phase 2A defects                0
```

Canonical closure: [`PHASE2A_CLOSURE.md`](PHASE2A_CLOSURE.md).

### Phase 2B — selection + safe local publication — complete

Accepted:

- explicit resource selection;
- server-side rebuild from current eligible inventory;
- nonce/capability-gated explicit publication;
- validation before write;
- compare-before-write state protection;
- idempotent same-content publication;
- site-local stored deployment;
- independent public `/llms.txt` read-back;
- exact generated/stored/public SHA-256 verification;
- recoverable EN/ES diagnostics.

```text
PR #5                                    merged
CI #9                                    FAIL — test fixture interpolation only
CI #9 signature                          d48cb3aba4e635dfa5f275bf554bd46ca36a586923f5cc4a654d357cf2475126
CI #10                                   PASS
merge SHA                                35251c3842acaf2c71c72aa106bc855cd09fe2a9
post-merge CI #11                        PASS
blocking Phase 2B defects                0
```

Canonical closure: [`PHASE2B_CLOSURE.md`](PHASE2B_CLOSURE.md).

### Phase 2C — Free release hardening — complete

#### Phase 2C1 — lifecycle + data retention — complete

Accepted:

- EN/ES Data & uninstall surface;
- explicit `preserve` / `delete` policy;
- preserve-by-default/fail-safe behavior;
- deactivation preserves deployment;
- uninstall cleans setup/security state;
- Multisite cleanup is site-local;
- no outbound uninstall request or arbitrary filesystem write.

```text
PR #7                                    merged
PR CI #14                                PASS
merge SHA                                ac102413f55e15ce8ae93a0a9e78cb545d7d26e5
post-merge CI #15                        PASS
blocking Phase 2C1 defects               0
```

Canonical policy: [`DATA_RETENTION.md`](DATA_RETENTION.md). Canonical closure: [`PHASE2C1_CLOSURE.md`](PHASE2C1_CLOSURE.md).

#### Phase 2C2 — WordPress/PHP runtime compatibility — complete

Accepted generated-ZIP runtime matrix:

```text
WordPress 5.6 / PHP 7.4                  PASS
WordPress 6.8 / PHP 8.2                  PASS
WordPress 7.1 / PHP 8.3                  PASS
PR #9                                    merged
CI #18                                   FAIL — historical WordPress fixture self-update race
CI #18 signature                         b4edb0c72807e8a6dd35cc3285aac513735bf810c442dbfd5f7b1f420b99e640
CI #19                                   PASS
merge SHA                                675f1f3bc9ed2572a94c497f21047c6a8c38a4e0
post-merge CI #20                        PASS
blocking Phase 2C2 defects               0
```

Canonical matrix: [`RUNTIME_COMPATIBILITY.md`](RUNTIME_COMPATIBILITY.md). Canonical closure: [`PHASE2C2_CLOSURE.md`](PHASE2C2_CLOSURE.md).

#### Phase 2C3 — Multisite/WooCommerce + UX hardening — complete

Accepted:

- real WordPress 7.1/PHP 8.3 Multisite network activation;
- new-subsite initialization while network active;
- independent blog identity/deployment/public `llms.txt` state;
- independent network lifecycle and uninstall policy per site;
- WooCommerce 11.1.0 public-product behavior without API keys;
- exclusion of draft/private/password-protected products;
- real Chromium EN/ES acceptance at 1280×900 and 390×844;
- no page-level horizontal overflow, accessible native controls, visible focus and touch-friendly mobile actions.

```text
PR #11                                   merged
CI #23                                   FAIL — unsupported wp site get harness assumption
CI #23 signature                         6f27a415ed0943186949a4096cb8d9e02665b1f629d2ade98ca11426cc4e6bab
fix commit                               ae3c0afb56e549de00607c0617b4d8698d21ce18
CI #24                                   PASS — 6/6 jobs
merge SHA                                1f8e5a419357d873bf3dda4403a45ee9e9a3eabe
post-merge CI #25                        PASS — 6/6 jobs
closure PR #12 CI #26                    PASS — 6/6 jobs
closure merge SHA                        53f804ecebc49db90cb1c9ed098199ae43aa288a
closure post-merge CI #27                PASS — 6/6 jobs
blocking Phase 2C3 defects               0
```

Canonical closure: [`PHASE2C3_CLOSURE.md`](PHASE2C3_CLOSURE.md).

#### Phase 2C4 — release package + final acceptance — complete

The Free 0.4.0 release candidate is accepted from an exact `main` source tree with deterministic package evidence.

```text
PR #13                                   merged
PR CI #28                                PASS — 7/7 jobs
merge/source commit                      4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree                              472e8c5e5bc20ed8f4eed412ab5515561b89ff16
post-merge CI #29                        PASS — 7/7 jobs
package                                  ai-search-optimizer-0.4.0.zip
package bytes                            21745
package entries                          11
package SHA-256                          27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
post-merge CI artifact id                10155308031
reproducible build                       PASS
blocking Phase 2 defects                 0
Free release-candidate decision          GO for later public distribution
```

The final CI job runs only after static validation, all three WordPress/PHP runtimes, Multisite/WooCommerce and real-browser EN/ES acceptance. It builds the package twice and requires byte-identical ZIPs before emitting checksum/manifest evidence.

Canonical closure: [`PHASE2C4_CLOSURE.md`](PHASE2C4_CLOSURE.md).

No GitHub Release, public Git tag, WordPress.org listing or Kairoseth Extensions `Available` status is implied by Phase 2 completion.

## Phase 3 — optional Kairoseth connection — next

Add task-oriented EN/ES UX for connecting the standalone plugin to Kairoseth AI Search Optimizer while preserving the accepted connector protocol and server-authoritative organization/product access.

Required design boundaries before implementation:

- local Free workflow remains useful without an account;
- connecting to Kairoseth is explicit and optional;
- exact WordPress site identity is server-validated;
- least-privilege WordPress credentials only;
- no Kairoseth/provider secrets exposed to browser/model context;
- local state cannot grant cloud roles/entitlements;
- cloud outage must not break accepted local Free behavior;
- existing `kairoseth-ai-web-readiness/v1` compatibility remains intact.

Advanced cloud capabilities may include whole-site analysis, Importance / AI Readiness, curation, approved revisions/history, optional AI assistance and managed publication verification.

## Phase 4 — Extensions commercial integration

Before the extension is marked Available in Kairoseth Extensions:

- canonical product registry entry;
- Kairoseth product page;
- contextual Custom Request end-to-end through the shared module;
- user-initiated share using canonical Kairoseth URL;
- accurate Free/Custom boundary;
- platform CI for changed catalog/shared contracts.

The product may be registered earlier as **Building** without implying availability. Pro remains deferred unless repeated reusable demand justifies it.

## Phase 5 — public distribution

Phase 2 no longer blocks distribution, but Phase 5 has its own independent gates. Target channels can include GitHub Releases and WordPress.org.

Before public distribution:

- create the deliberate immutable public version/tag/release action;
- publish the accepted package/checksum through the chosen channel;
- run WordPress Plugin Check before directory submission;
- verify WordPress.org policy/license/readme compliance;
- complete real install/download acceptance from the public channel;
- keep release docs/changelog synchronized;
- blocking distribution defects = 0.

`ai-search-optimizer` remains only the target WordPress.org slug until actually accepted/reserved.

## Post-v1 candidates

Demand-led only: drift monitoring, scheduled checks, richer WooCommerce product representations, agency/multi-site operations, additional AI Search diagnostics and optional reusable Pro capabilities.
