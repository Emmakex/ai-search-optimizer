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

The permanent CI workflow now retains structured PHPCS diagnostics and remediation evidence as artifacts when this quality gate fails.

## Prevention

When a new static-analysis gate is introduced over historical code, first produce a machine-readable full report and classify findings as auto-fixable versus semantic/manual. Do not infer problem size from GitHub annotation count and do not weaken the ruleset to make the gate green.

CI failures must continue to expose actionable structured evidence: pipeline/job/step, command, exit code, primary error, file/line and sniff where available, error signature, confirmed root cause, applied fix and validation.

## Validation

```text
Phase 3C remediation run 34635584693
PHPCBF: no violations found
PHPCS:  0 errors, 0 warnings, 0 fixable
PHP syntax: PASS for ai-search-optimizer.php, uninstall.php and every includes/*.php file
```

The normal PR CI remains the authoritative merge gate; PR #20 must not merge until all required jobs pass on the cleaned branch head.
