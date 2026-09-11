# Phase 3C — WordPress.org Support / Privacy Hardening

Status: **Accepted**  
Last reviewed: **11 September 2026**

## Goal

Close the WordPress.org-oriented hardening workstream without weakening the local Free product or changing the accepted privacy boundary.

Phase 3C adds a blocking production-code quality baseline and proves the development package across the supported WordPress/PHP matrix, official Plugin Check, Multisite/WooCommerce, real-browser EN/ES acceptance and reproducible packaging.

This acceptance is **not** a claim that the plugin is published or approved on WordPress.org. `ai-search-optimizer` remains the target directory slug until WordPress.org independently accepts/reserves it.

## Accepted quality contract

```text
production PHP scope
  ai-search-optimizer.php
  uninstall.php
  includes/*.php

quality gates
  WordPress Coding Standards
  PHPCompatibilityWP for PHP 7.4+
  official WordPress Plugin Check
  PHP syntax
  package-content verification
```

No WPCS or PHPCompatibility violation was ignored, baselined or converted into a non-blocking exception to make the gate green.

The CI quality job also writes machine-readable PHPCS evidence so future coding-standard failures expose exact files, lines, sniffs and messages instead of requiring manual searches through raw logs.

## Runtime and UX contract

Accepted packaged-runtime evidence covers:

```text
WordPress 5.6 / PHP 7.4    PASS
WordPress 6.8 / PHP 8.2    PASS
WordPress 7.1 / PHP 8.3    PASS
Multisite + WooCommerce    PASS
real browser EN/ES         PASS
reproducible package       PASS
```

The existing local Free analysis, deterministic llms.txt generation, selection, publication, compare-before-write, SHA-256 verification, lifecycle retention and uninstall guarantees remain green.

Regression tests that inspect PHP source now assert semantic contract markers without depending on formatter-specific whitespace or comparison orientation.

## Privacy / policy boundary retained

Phase 3C does not introduce cloud entitlement, trialware, telemetry or silent external communication.

The accepted support model remains:

```text
useful local Free plugin
→ optional explicit administrator CTA
→ exact https://kairoseth.com/custom-requests destination
→ bounded technical/product context only
→ user chooses what personal/business/request information to submit
```

Page load sends nothing to Kairoseth. Site URL, llms.txt content/hash, content inventory, administrator/customer identity, WooCommerce content, credentials, tokens, prompts, conversations, logs, database contents and arbitrary WordPress options are not attached automatically.

## WPCS remediation evidence

The new quality gate correctly exposed historical source-normalization debt:

```text
initial PHPCS findings     3,401 errors + 394 warnings
fixable                    3,656
post-PHPCBF                138 errors + 1 warning
final PHPCS                0 errors + 0 warnings + 0 fixable
```

The remaining manual categories after PHPCBF were Yoda comparisons, missing file/function documentation, package metadata and one WordPress JSON-encoding warning. Production code was normalized rather than weakening the ruleset.

Canonical retained diagnosis: [`engineering-failures/2026-09-11-phase3c-wpcs-normalization-debt.md`](engineering-failures/2026-09-11-phase3c-wpcs-normalization-debt.md).

## Engineering evidence

```text
implementation PR                     #20
final PR head                          384c52d9ba0d1cc735e4ab48fe4ea966b7ecdfb2
final PR CI                            #74 / run 34641140242 — PASS
merge SHA                              393c35e67724b69ed6c7a4728b7d5a8595ee8169
post-merge CI                          #75 / run 34641355039 — PASS
WPCS + PHPCompatibility                PASS
WordPress Plugin Check                 PASS
WordPress 5.6 / PHP 7.4               PASS
WordPress 6.8 / PHP 8.2               PASS
WordPress 7.1 / PHP 8.3               PASS
Multisite + WooCommerce               PASS
real browser admin UX EN/ES           PASS
reproducible development package      PASS
blocking Phase 3C defects              0
```

Post-merge development-package identity:

```text
version        0.5.0-dev
source commit  393c35e67724b69ed6c7a4728b7d5a8595ee8169
source tree    72121f93a097391c3c30da82cb582259f04748dc
package        ai-search-optimizer-0.5.0-dev.zip
bytes          29365
entries        13
SHA-256        c10b2a780824fc08e43b557def3423a3d25bf313412ac6436ef9f6c53bad0137
artifact ID    10280162508
```

This is development evidence, not a stable public release or WordPress.org package claim.

## Exit gates

```text
[x] production PHP satisfies WPCS
[x] production PHP satisfies PHPCompatibilityWP for supported PHP baseline
[x] machine-readable PHPCS diagnostics retained by CI
[x] official WordPress Plugin Check PASS
[x] WordPress 5.6 / PHP 7.4 packaged runtime PASS
[x] WordPress 6.8 / PHP 8.2 packaged runtime PASS
[x] WordPress 7.1 / PHP 8.3 packaged runtime PASS
[x] Multisite + WooCommerce PASS
[x] real-browser EN/ES desktop/mobile acceptance PASS
[x] local Free regressions PASS
[x] support/privacy boundary regressions PASS
[x] lifecycle/deactivate/uninstall regressions PASS
[x] development/release metadata alignment PASS
[x] reproducible development package PASS
[x] PR CI PASS
[x] merge complete
[x] post-merge main CI PASS
[x] blockers = 0
```

Phase 3C is closed. With Phase 3A, 3B and 3C accepted, **Phase 3 is complete**. Phase 4 — Kairoseth Extensions catalog integration — is the next permitted workstream. Stable public distribution / WordPress.org publication remains a later release-gated milestone.