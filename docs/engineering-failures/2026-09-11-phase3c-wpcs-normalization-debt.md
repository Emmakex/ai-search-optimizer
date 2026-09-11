# Phase 3C — WPCS normalization debt exposed by the new quality gate

Date: **11 September 2026**  
PR: **#20 — Phase 3C WordPress quality gate**

## Failure

```text
pipeline: CI
job: WordPress coding standards + PHPCompatibility
step: Run WPCS and PHPCompatibility
command: vendor/bin/phpcs --standard=phpcs.xml.dist
exit code: 1
primary error: production PHP did not satisfy the newly enabled WordPress Coding Standards ruleset
initial findings: 3401 errors, 394 warnings, 3656 fixable
post-PHPCBF findings: 138 errors, 1 warning, 0 fixable
error signature: phase3c-wpcs-historical-normalization-debt
```

Affected production scope:

- `ai-search-optimizer.php`
- `uninstall.php`
- `includes/*.php`

The post-PHPCBF non-fixable findings were reduced to four concrete categories: 67 Yoda-condition errors, 62 missing function docblocks, 8 missing file docblocks, 1 missing package tag, plus one `json_encode()` warning.

## Root cause

**Confirmed.** Phase 3C introduced a blocking WPCS + PHPCompatibilityWP gate over production PHP that had historically been written with a different formatting/documentation discipline. The gate correctly exposed existing normalization debt; the failure was not caused by a new runtime regression.

The original GitHub check annotations understated the scale of the problem. They were check annotations, not the complete PHPCS finding count. Structured PHPCS JSON was therefore added to CI so future failures expose exact files, lines, sniffs and messages without searching raw logs.

## Fix

The production PHP was normalized without disabling, ignoring or baselining quality rules:

- PHPCBF applied all 3,656 safe automatic fixes;
- remaining Yoda comparisons were normalized;
- production file and function documentation required by the configured standard was added;
- the main plugin file received its package metadata;
- native `json_encode()` usage in the flagged WordPress path was replaced with `wp_json_encode()`;
- all modified production PHP was syntax-checked;
- one-shot remediation tooling was removed after the source was clean.

The permanent CI workflow retains structured PHPCS diagnostics and remediation evidence as artifacts when this quality gate fails.

## Secondary regression-test failures

Source normalization then exposed regression tests that were coupled to PHP formatting rather than the contract they intended to protect. These were test-harness defects, not production regressions.

### Contract/security source literals

```text
pipeline: CI
job: validate
step: Contract and security regression
command: php tests/contract-check.php
exit code: 1
primary error: required contracts reported missing after WPCS whitespace/Yoda normalization
signature: 1fef1f92ccbfe514a4fb5f5928468e9db97079a82671439a448ce3234cb7fb79
root cause: confirmed — exact source strings encoded formatter layout
fix: compare behaviorally significant positive contracts through whitespace-normalized source; keep dangerous forbidden-pattern checks explicit
```

### Local Free source literals

```text
pipeline: CI
job: validate
step: Local Free analysis regression
command: php tests/local-free-check.php
exit code: 1
primary error: FAIL: missing local Free admin contract: function kairoseth_aiwr_local_inventory($limit = 100)
signature: 0e528c50e45bb8e7f18e45cad8f13da23cae6ff7c4c35746d643ad4853767664
root cause: confirmed — function-signature assertion depended on formatter whitespace
fix: normalize source layout for positive contract checks
```

### WordPress API missing from standalone harness

```text
pipeline: CI #72
job: validate
step: Safe local publication regression
command: php tests/local-publication-check.php
exit code: 255
primary error: PHP Fatal error: Uncaught Error: Call to undefined function wp_json_encode()
file/line: includes/local-publish.php:78
signature: 9de52e4102f8d2923d4531091d06df09d28148aa0746351091ca53894fb5d7e3
root cause: confirmed — production correctly moved to wp_json_encode(), but the standalone regression harness did not stub that WordPress API
fix: add a bounded wp_json_encode() test stub delegating to json_encode() and keep production on the WordPress API
```

### Uninstall Yoda comparison

```text
pipeline: CI #73
job: validate
step: Lifecycle and uninstall regression
command: php tests/lifecycle-check.php
exit code: 1
primary error: FAIL: missing uninstall contract: if ($mode === 'delete')
signature: b80cf5ec715599417f90a52488daa993bc47dd39bc07b497597f44e6aea3f83f
root cause: confirmed — WPCS preserved the semantic guard as if ( 'delete' === $mode ), while the test required one comparison orientation
fix: assert the explicit delete-mode guard semantically while accepting formatter-selected comparison orientation
```

## Prevention

When a new static-analysis gate is introduced over historical code, first produce a machine-readable full report and classify findings as auto-fixable versus semantic/manual. Do not infer problem size from GitHub annotation count and do not weaken the ruleset to make the gate green.

Regression tests that inspect source code must assert behaviorally significant tokens or normalized syntax, not indentation, alignment or comparison orientation produced by a formatter. Forbidden dangerous mechanisms should continue to be checked explicitly. Standalone test harnesses must also stub the WordPress APIs used by the production unit under test.

CI failures must continue to expose actionable structured evidence: pipeline/job/step, command, exit code, primary error, file/line and sniff where available, error signature, confirmed root cause, applied fix and validation.

## Validation

```text
Phase 3C remediation run 34635584693
PHPCBF: no violations found
PHPCS:  0 errors, 0 warnings, 0 fixable
PHP syntax: PASS for ai-search-optimizer.php, uninstall.php and every includes/*.php file

final PR head: 384c52d9ba0d1cc735e4ab48fe4ea966b7ecdfb2
PR CI #74 / run 34641140242: PASS
merge SHA: 393c35e67724b69ed6c7a4728b7d5a8595ee8169
post-merge CI #75 / run 34641355039: PASS
WPCS + PHPCompatibility: PASS
WordPress Plugin Check: PASS
WP 5.6/PHP 7.4, WP 6.8/PHP 8.2, WP 7.1/PHP 8.3: PASS
Multisite + WooCommerce: PASS
real browser EN/ES: PASS
reproducible development package: PASS
```

The failure chain is closed and retained as regression memory. The lesson is twofold: production quality gates should remain strict, and tests that protect contracts must not mistake formatter output for product behavior.
