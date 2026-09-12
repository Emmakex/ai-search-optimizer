# AI Search Optimizer — Phase 5B GitHub Release Acceptance

Status: **ACCEPTED — public GitHub Release `0.5.0` published and independently verified**  
Accepted: **12 September 2026**

## Decision

Phase 5B is complete. The exact Phase 5A package identity was bound to an annotated `0.5.0` Git tag and a public GitHub Release only after lifecycle, compatibility, package-integrity and live CTA production gates passed.

This acceptance does **not** claim WordPress.org publication. WordPress.org submission/review is Phase 5C.

## Frozen release identity

```text
version              0.5.0
tag                  0.5.0
accepted source      b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
accepted tree        6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package              ai-search-optimizer-0.5.0.zip
package bytes        29397
package entries      13
package SHA-256      0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
```

The annotated tag object is `6433cca08a8d8a213f0c0326447910c5ee732ff5` and peels to the accepted source commit `b116ae5df76c7a72ad37ff4e8e80632d6ebb457b`.

The tag is annotated but unsigned. Phase 5B did not require a cryptographic Git-tag signature; release integrity is enforced by the frozen source/tree/package identity, reproducible package build, checksum, release-asset round trip and fail-closed publication workflow.

## Lifecycle gate

Phase 5B first added a permanent blocking release-package lifecycle gate.

```text
implementation PR       #28
PR head                 313607388e861b1ec21b2d7c9ae20c714b28fe99
PR CI                   #93 / run 34671385877 — PASS
main merge SHA          6c47abe32152835debbc9a76869ea5af037f0501
post-merge CI           #94 / run 34671531167 — PASS on attempt 2
```

The gate proves with exact rebuilt packages:

- clean install of `0.5.0`;
- exact historical `0.4.0` package rebuild and SHA verification;
- in-place `0.4.0 → 0.5.0` upgrade;
- preservation of the verified deployment hash across upgrade;
- preserve-uninstall and state recovery after reinstall;
- deliberate delete-uninstall removal;
- exact current and historical package SHA checks before WordPress execution.

### CI #94 browser incident

Attempt 1 failed only in `Real browser admin UX EN/ES` during the second, Spanish login pass:

```text
file/line             scripts/admin-ux.mjs:73
primary error         page.waitForURL: Timeout 30000ms exceeded
exit code             1
signature             1599dfa6cd1067fcd852668922e8e512629e1c0a4f4bac298822a3e6cec249ec
root cause            confirmed transient Playwright/login harness flake
```

English browser acceptance had already passed, the failed Spanish attempt emitted no login POST, WordPress/Apache remained responsive, the identical tree had passed EN/ES minutes earlier in CI #93, and a selective retry passed EN/ES without any code or timeout change. The strict browser gate was retained. The incident is recorded in `CI_INCIDENTS.md`.

## Publication hardening

A separate publication PR added a fail-closed one-shot publisher and production CTA preflight.

```text
publication PR          #29
PR head                 c6fd30f90becca6561c7fd5eee90773ddb5a008f
PR CI                   #98 / run 34680787497 — PASS
main merge SHA          83c4cbcc21971e9cb28b099c64a05af18a9ba29d
post-merge CI           #99 / run 34680928053 — PASS
publication run         34681042749 — PASS
```

Publication behavior:

1. require a one-shot trigger branch created directly from verified `main`;
2. prove the production Kairoseth CTA before any tag/release mutation;
3. reconstruct exact accepted `0.5.0` and historical `0.4.0` packages and verify their SHA-256 values;
4. execute release lifecycle acceptance before publication;
5. create the annotated `0.5.0` tag at the frozen accepted source;
6. create the GitHub Release as a draft;
7. download the uploaded assets back from GitHub;
8. require the downloaded ZIP/checksum/manifest to match the accepted artifacts, including byte identity for the ZIP;
9. rerun lifecycle acceptance against the ZIP downloaded back from GitHub;
10. only then convert the draft to a public release;
11. on any failure before publication, clean temporary draft/tag state rather than leave a partial release.

## CTA production gate

The release was blocked until the actual production destination proved the exact customer path that the plugin generates.

Canonical destination:

```text
https://kairoseth.com/custom-requests
```

All four release preflight cases returned HTTP `200` and retained the bounded AI Search Optimizer context:

```text
en + implementation_support   PASS
en + business_customization   PASS
es + implementation_support   PASS
es + business_customization   PASS
```

The production proof requires canonical `AI Search Optimizer` / `ai-search-optimizer` identity, WordPress host context, version/locale/request type, EN/ES page/form copy, and absence of forbidden automatically attached fields such as site URL, llms.txt/hash, user/email, credentials/tokens or WooCommerce context.

This gate exists specifically so a future release cannot publish while its optional CTA destination is broken, redirected to an incompatible route or no longer accepts the privacy-bounded contract.

## Public GitHub Release

```text
release ID            387492480
release name          AI Search Optimizer 0.5.0
published             2026-09-12T07:34:35Z
draft                 false
prerelease            false
release URL           https://github.com/Emmakex/ai-search-optimizer/releases/tag/0.5.0
```

Published assets:

```text
558839919  ai-search-optimizer-0.5.0.zip     29397 bytes
           sha256:0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
558839916  ai-search-optimizer-0.5.0.sha256  96 bytes
558839915  release-manifest.txt              356 bytes
```

The GitHub-reported ZIP digest exactly matches the accepted Phase 5A package SHA-256.

## Accepted gates

```text
[x] annotated tag 0.5.0 exists
[x] tag peels to accepted source b116ae5d...
[x] public GitHub Release exists and is not a prerelease
[x] exact published ZIP SHA-256 matches accepted package
[x] release checksum and manifest published
[x] uploaded ZIP downloaded back and byte-compared before publication
[x] clean install from exact package PASS
[x] 0.4.0 -> 0.5.0 upgrade PASS
[x] preserve uninstall/reinstall recovery PASS
[x] delete uninstall PASS
[x] WordPress 5.6 / PHP 7.4 PASS
[x] WordPress 6.8 / PHP 8.2 PASS
[x] WordPress 7.1 / PHP 8.3 PASS
[x] Multisite + WooCommerce PASS
[x] WPCS + PHPCompatibilityWP PASS
[x] official WordPress Plugin Check PASS
[x] real browser EN/ES PASS
[x] Kairoseth CTA production EN/ES + both request types PASS
[x] release identity drift fails closed
[x] no false WordPress.org availability claim
[x] blocking Phase 5B defects = 0
```

## Boundary after acceptance

Phase 5B closes GitHub public distribution. The next permitted workstream is **Phase 5C — WordPress.org submission/review**.

Until WordPress.org independently accepts and publishes the plugin, `ai-search-optimizer` remains the target directory slug and no WordPress.org availability claim may be made.
