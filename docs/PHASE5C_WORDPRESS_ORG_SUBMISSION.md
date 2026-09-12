# Phase 5C — WordPress.org submission contract

Status: **5C.2 ACCEPTED — public GitHub Release `0.5.1` verified; 5C.3 exact released-ZIP WordPress.org submission is next; WordPress.org availability is not claimed.**

Date frozen: 2026-09-12

## Purpose

Phase 5C moves AI Search Optimizer through a truthful WordPress.org submission/review flow while preserving every already published GitHub release identity.

Target directory slug:

```text
ai-search-optimizer
```

No WordPress.org reservation, approval or availability claim is valid until the external directory has actually accepted and published the plugin.

## Why `0.5.1`

Public `0.5.0` contained stale packaged pre-publication wording. Its accepted source/tag/package SHA was already frozen, so it was not modified in place. The submission line advanced to the minimal `0.5.1` hardening patch.

Previous release `0.5.0` remains:

```text
source commit       b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree         6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package SHA-256     0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
GitHub Release ID   387492480
```

## 5C.1 accepted `0.5.1` package

```text
source commit       c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
source tree         e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
package             ai-search-optimizer-0.5.1.zip
package bytes       29560
package entries     13
package SHA-256     2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
final PR CI         #107 / run 34692689075 — PASS
post-merge CI       #108 / run 34692826856 — PASS
```

The package passed WPCS/PHPCompatibilityWP, official Plugin Check, WP 5.6/PHP 7.4, WP 6.8/PHP 8.2, WP 7.1/PHP 8.3, Multisite/WooCommerce, browser EN/ES, live CTA EN/ES × both request types, clean install, `0.5.0 → 0.5.1` upgrade, preserve/reinstall/delete lifecycle and byte reproducibility.

Plugin URI and Author URI remain intentionally absent. MIT remains the declared GPL-compatible license. No new telemetry, license, account or entitlement dependency was introduced.

## 5C.2 accepted public GitHub Release `0.5.1`

```text
publication tooling PR    #34
PR CI                     #111 / run 34695699823 — PASS
publication main          108f276dc0774b6cf9c85d77d14546d01495cfc1
post-merge CI             #112 / run 34695819740 — PASS
publication run           34695973744 — PASS
annotated tag object      32a51daf4e32a8919114b6dc734a54a00952aed0
tag target                c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
GitHub Release ID         387576797
published at              2026-09-12T13:17:34Z
ZIP asset ID              559297134
ZIP digest                sha256:2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
checksum asset ID         559297135
manifest asset ID         559297132
```

The publication sequence was fail-closed:

```text
live CTA gate
→ reconstruct frozen source/package
→ verify SHA + 29560 bytes + 13 entries
→ rebuild exact 0.5.0 baseline
→ lifecycle 0.5.0 → 0.5.1
→ create annotated tag
→ create GitHub Release as draft
→ upload ZIP/checksum/manifest
→ download all three assets back
→ verify checksum/manifest/byte identity/SHA/bytes/entries
→ rerun lifecycle against downloaded ZIP
→ publish draft=false
```

The old `0.5.0` publication workflow also received the branch-create event but its guard correctly skipped its publish job; it did not mutate `0.5.0`.

Canonical 5C.2 evidence: [`PHASE5C2_GITHUB_RELEASE.md`](PHASE5C2_GITHUB_RELEASE.md).

## CTA incident boundary

CI #104 recorded a transient HTTP 403 from the public CTA. Later exact `0.5.1` checks returned HTTP 200 for curl-default and browser-equivalent profiles without Kairoseth application-code or packaged-plugin changes. The upstream edge mechanism remains unconfirmed and is not mislabeled as a version allow-list defect. See [`CI_INCIDENTS.md`](CI_INCIDENTS.md).

## 5C.3 WordPress.org exact-ZIP submission — next

The only acceptable submission package is the released asset with this identity:

```text
file        ai-search-optimizer-0.5.1.zip
bytes       29560
entries     13
SHA-256     2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
asset ID    559297134
```

Before/during submission:

```text
[ ] upload exactly the released ZIP above
[ ] record WordPress.org submission identifier/status/message
[ ] treat every automated/manual reviewer finding as a structured incident
[ ] never silently alter the released 0.5.1 bytes
[ ] if a code/package change is required, create a new patch version and rerun acceptance
[ ] wait for actual WordPress.org approval/publication
[ ] verify the live directory listing and download identity
[ ] only then update customer/catalog copy to claim WordPress.org availability
```

## Phase sequence

```text
5C.0 submission-hardening contract                         COMPLETE
5C.1 exact 0.5.1 package acceptance                       COMPLETE
5C.2 public GitHub Release 0.5.1 + exact evidence         COMPLETE
5C.3 submit exact released ZIP to WordPress.org           NEXT
5C.4 resolve external review findings, if any             FUTURE
5C.5 verify live directory listing and availability claim FUTURE
```
