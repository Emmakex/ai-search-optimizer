# AI Search Optimizer — Acceptance

Status: **Phases 0–4, 5A, 5B, 5C.0, 5C.1 and 5C.2 accepted; public GitHub Release `0.5.1` verified; Phase 5C.3 WordPress.org submission is next; directory availability is not claimed.**  
Last reviewed: **12 September 2026**

## Engineering inheritance

Minimum-sufficient validation, finish-before-advance, EN/ES customer surfaces, least privilege, actionable diagnostics, durable failure learning and feature branch → PR → CI → merge → post-merge verification remain mandatory.

## Accepted product baseline

```text
[x] useful without Kairoseth account/license/entitlement
[x] local robots.txt / sitemap / llms.txt readiness
[x] public WordPress/WooCommerce inventory
[x] deterministic source-grounded llms.txt generation
[x] explicit selection/publication
[x] compare-before-write and idempotence
[x] independent public read-back + exact SHA-256
[x] EN/ES responsive/browser acceptance
[x] single-site/Multisite isolation
[x] explicit preserve/delete uninstall policy
[x] no silent telemetry/content transmission
[x] optional privacy-bounded Kairoseth support CTA
[x] WPCS + PHPCompatibilityWP blocking
[x] official Plugin Check blocking
[x] WordPress/PHP runtime matrix blocking
```

## Phase 5B historical public release `0.5.0`

```text
tag                        0.5.0
source commit              b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree                6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package bytes              29397
package SHA-256            0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
GitHub Release ID          387492480
publication run            34681042749
```

Canonical evidence: [`PHASE5B_GITHUB_RELEASE.md`](PHASE5B_GITHUB_RELEASE.md).

## Phase 5C.1 — exact `0.5.1` package — accepted

```text
version                    0.5.1
source commit              c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
source tree                e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
package                    ai-search-optimizer-0.5.1.zip
package bytes              29560
package entries            13
package SHA-256            2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
final implementation CI    #107 / run 34692689075 — PASS
implementation merge       c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
post-merge main CI         #108 / run 34692826856 — PASS
closure CI                 #109 / run 34693128380 — PASS
closure post-merge CI      #110 / run 34695428487 — PASS
```

```text
[x] Version/connector/Stable tag = 0.5.1
[x] stale packaged pre-publication wording removed
[x] Plugin URI and Author URI remain absent
[x] package contents PASS
[x] WPCS + PHPCompatibilityWP PASS
[x] official Plugin Check PASS
[x] WP 5.6/PHP 7.4 PASS
[x] WP 6.8/PHP 8.2 PASS
[x] WP 7.1/PHP 8.3 PASS
[x] Multisite + WooCommerce PASS
[x] browser EN/ES PASS
[x] CTA production EN/ES × both request types PASS
[x] clean install PASS
[x] 0.5.0 → 0.5.1 upgrade PASS
[x] preserve/reinstall/delete lifecycle PASS
[x] reproducible package PASS
```

## Phase 5C.2 — public GitHub Release `0.5.1` — accepted

```text
publication tooling PR     #34
PR CI                      #111 / run 34695699823 — PASS
publication tooling merge  108f276dc0774b6cf9c85d77d14546d01495cfc1
post-merge main CI         #112 / run 34695819740 — PASS
publication run            34695973744 — PASS
annotated tag object       32a51daf4e32a8919114b6dc734a54a00952aed0
tag target                 c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
GitHub Release ID          387576797
published at               2026-09-12T13:17:34Z
ZIP asset ID               559297134
ZIP asset bytes            29560
ZIP asset digest           sha256:2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
checksum asset ID          559297135
manifest asset ID          559297132
```

Acceptance gates:

```text
[x] no pre-existing 0.5.1 tag/release before publication
[x] trigger branch created from exact green main
[x] live CTA 0.5.1 EN/ES gate PASS before mutation
[x] annotated tag 0.5.1 points exactly to accepted source c93ac68c...
[x] accepted source tree e1cc7c3... verified
[x] exact 0.5.1 SHA/bytes/entries verified before upload
[x] exact accepted 0.5.0 baseline rebuilt for upgrade proof
[x] lifecycle proof PASS before release mutation
[x] GitHub Release created as draft first
[x] ZIP/checksum/manifest downloaded back from GitHub
[x] downloaded ZIP byte-identical to accepted package
[x] downloaded SHA/bytes/entries exact
[x] second lifecycle proof PASS against downloaded ZIP
[x] release made public only after all checks
[x] public release is draft=false and prerelease=false
[x] published ZIP digest equals accepted 5C.1 SHA
[x] WordPress.org availability not falsely claimed
[x] blocking 5C.2 defects = 0
```

Canonical evidence: [`PHASE5C2_GITHUB_RELEASE.md`](PHASE5C2_GITHUB_RELEASE.md).

**Phase 5C.2 is complete.**

## Phase 5C.3 — external WordPress.org gate — next

The next action is to submit the exact released ZIP with SHA-256 `2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b` to WordPress.org. Review/approval and actual directory publication remain external gates.

`ai-search-optimizer` remains only the target slug until the directory accepts/reserves it. No customer-facing copy may claim WordPress.org availability until the listing is genuinely live.

## Claims gate

No customer-facing release may guarantee ranking, citation, indexing, crawling, AI ingestion, training inclusion or endorsement by external providers.
