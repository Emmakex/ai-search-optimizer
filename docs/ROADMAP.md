# AI Search Optimizer — Roadmap

Status: **Phase 3 in progress — 3A optional Kairoseth connection readiness under acceptance**  
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
Phase 3  Kairoseth-connected customer UX        IN PROGRESS
  3A     connection readiness + guided handoff  IN PROGRESS
  3B     coordinated Kairoseth onboarding UX    BLOCKED by 3A
  3C     connected-flow hardening/acceptance    BLOCKED by 3B
Phase 4  Custom Request + share + catalog       BLOCKED by shared/platform dependencies
Phase 5  public distribution / WordPress.org    UNBLOCKED by Phase 2; distribution gates pending
```

## Phase 0 — product foundation — complete

Accepted: dedicated public repository, MIT license, canonical name/slug, product/architecture/roadmap/acceptance/security/provenance docs, engineering rules, and no false release/Available claims.

Canonical closure: [`FOUNDATION_CLOSURE.md`](FOUNDATION_CLOSURE.md).

## Phase 1 — standalone extraction — complete

The accepted WordPress connector 0.3.2 became the standalone line while preserving protocol/state compatibility.

```text
PR #1                                    merged
merge SHA                                2b9d0df93df99ccc0cd4e99f708a3a5a72bd4212
PR CI #1                                 PASS
post-merge CI #2                         PASS
blocking extraction defects              0
```

## Phase 2 — useful Free local workflow — complete

The core Free edition is accepted as useful without a Kairoseth account and does not silently transmit local site content to Kairoseth, AI providers or third-party analytics.

### 2A — local analysis + deterministic preview — complete

Accepted EN/ES admin readiness, public WordPress/WooCommerce inventory, deterministic source-grounded `llms.txt`, validation, exact SHA-256, and a read-only analysis path.

```text
PR #3                                    merged
PR CI #5                                 PASS
merge SHA                                61b33412484a20a505726c808ec64bc9dc8953a3
post-merge CI #6                         PASS
blocking Phase 2A defects                0
```

Canonical closure: [`PHASE2A_CLOSURE.md`](PHASE2A_CLOSURE.md).

### 2B — selection + safe local publication — complete

Accepted explicit selection, server-side rebuild, nonce/capability-gated publication, validation-before-write, compare-before-write, idempotence, independent public read-back and exact generated/stored/public SHA-256 verification.

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

### 2C — Free release hardening — complete

#### 2C1 — lifecycle + data retention — complete

Preserve/delete uninstall policy, preserve-by-default behavior, site-local Multisite cleanup and no outbound uninstall activity are accepted.

```text
PR #7                                    merged
PR CI #14                                PASS
merge SHA                                ac102413f55e15ce8ae93a0a9e78cb545d7d26e5
post-merge CI #15                        PASS
```

Canonical policy: [`DATA_RETENTION.md`](DATA_RETENTION.md). Canonical closure: [`PHASE2C1_CLOSURE.md`](PHASE2C1_CLOSURE.md).

#### 2C2 — WordPress/PHP runtime compatibility — complete

```text
WordPress 5.6 / PHP 7.4                  PASS
WordPress 6.8 / PHP 8.2                  PASS
WordPress 7.1 / PHP 8.3                  PASS
CI #18                                   FAIL — historical WordPress fixture self-update race
CI #18 signature                         b4edb0c72807e8a6dd35cc3285aac513735bf810c442dbfd5f7b1f420b99e640
CI #19                                   PASS
merge SHA                                675f1f3bc9ed2572a94c497f21047c6a8c38a4e0
post-merge CI #20                        PASS
```

Canonical matrix: [`RUNTIME_COMPATIBILITY.md`](RUNTIME_COMPATIBILITY.md). Canonical closure: [`PHASE2C2_CLOSURE.md`](PHASE2C2_CLOSURE.md).

#### 2C3 — Multisite/WooCommerce + UX hardening — complete

Real Multisite isolation, WooCommerce 11.1.0 behavior and Chromium EN/ES desktop/mobile acceptance are accepted.

```text
PR #11                                   merged
CI #23                                   FAIL — unsupported wp site get harness assumption
CI #23 signature                         6f27a415ed0943186949a4096cb8d9e02665b1f629d2ade98ca11426cc4e6bab
CI #24                                   PASS — 6/6 jobs
merge SHA                                1f8e5a419357d873bf3dda4403a45ee9e9a3eabe
post-merge CI #25                        PASS — 6/6 jobs
closure PR #12 CI #26                    PASS — 6/6 jobs
closure merge SHA                        53f804ecebc49db90cb1c9ed098199ae43aa288a
closure post-merge CI #27                PASS — 6/6 jobs
```

Canonical closure: [`PHASE2C3_CLOSURE.md`](PHASE2C3_CLOSURE.md).

#### 2C4 — release package + final acceptance — complete

The Free 0.4.0 release candidate is accepted from an exact source tree with deterministic package evidence.

```text
PR #13                                   merged
PR CI #28                                PASS — 7/7 jobs
accepted source commit                   4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
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
closure PR #14 CI #30                    PASS — 7/7 jobs
closure merge SHA                        de8b46f10827667b937607d0bed864a144fbb654
closure post-merge CI #31                PASS — 7/7 jobs
```

Canonical closure: [`PHASE2C4_CLOSURE.md`](PHASE2C4_CLOSURE.md).

The accepted `0.4.0` package identity is immutable. New product development does not reuse that version number.

## Phase 3 — optional Kairoseth connection — in progress

Phase 3 adds task-oriented EN/ES UX for customers who choose to connect the standalone plugin to Kairoseth AI Search Optimizer. The local Free workflow remains independent and usable without a Kairoseth account.

Canonical contract: [`KAIROSETH_CONNECTION.md`](KAIROSETH_CONNECTION.md).

### Phase 3A — connection readiness + guided handoff — in progress

Current implementation on the `0.5.0-dev` line:

- dedicated **Tools → AI Search Optimizer · Kairoseth** screen;
- local HTTPS readiness check for exact WordPress home URL;
- native WordPress Application Password availability check;
- dedicated deployer role/capability readiness check;
- exact Blog ID / Network ID / home URL / REST connection endpoint / `llms.txt` target display;
- explicit least-privilege setup guide in EN/ES;
- fixed user-initiated handoff to `https://kairoseth.com/app` with no query/fragment site or credential data;
- no automatic request to Kairoseth;
- no local Kairoseth token/session/entitlement or Application Password storage;
- existing schema `2`, `kairoseth-ai-web-readiness/v1`, exact site pin and compare-and-set deployment protocol unchanged;
- real browser desktop/mobile EN/ES acceptance required before closure;
- all Phase 2 runtime/security/package regressions required to remain green.

Phase 3A remains **unaccepted until PR CI + merge + post-merge CI are green and its closure record is committed**.

### Phase 3B — coordinated Kairoseth onboarding UX — blocked by 3A

After 3A closes, reduce the manual handoff from WordPress into the correct authorized Kairoseth site workflow without creating browser-authoritative access or a second authentication protocol.

The current Kairoseth Platform remains authoritative for:

- authenticated user/session;
- organization/product access;
- WordPress connection validation;
- encrypted WordPress credential storage;
- exact site identity pin;
- managed publication authority and audit.

Any future one-time pairing/prefill mechanism must be specified and threat-modeled before implementation.

### Phase 3C — connected-flow hardening/acceptance — blocked by 3B

Require failure isolation, EN/ES responsive acceptance, credential rotation/disconnect guidance, exact site pin preservation, audit/diagnostic coverage and full regression before declaring the connected workflow accepted.

## Phase 4 — Extensions integration

Before the extension is marked Available in Kairoseth Extensions, require canonical product registry/page, contextual Custom Request, user-initiated share, truthful packaging and platform CI/production verification. The product may remain registered as **Building** before these gates complete.

## Phase 5 — public distribution

Phase 2 no longer blocks distribution, but Phase 5 has independent gates: deliberate immutable public version/tag/release, accepted package/checksum publication, WordPress Plugin Check before directory submission, WordPress.org policy/license/readme compliance, real install/download acceptance and zero blocking distribution defects.

`ai-search-optimizer` remains only the target WordPress.org slug until actually accepted/reserved.

## Post-v1 candidates

Demand-led only: drift monitoring, scheduled checks, richer WooCommerce representations, agency/multi-site operations, additional AI Search diagnostics and reusable advanced capabilities.