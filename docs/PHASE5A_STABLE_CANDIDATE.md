# AI Search Optimizer — Phase 5A Stable Candidate

Status: **RELEASE CONTRACT FROZEN — implementation pending**  
Target version: **0.5.0**  
Distribution state: **stable candidate only; no WordPress.org availability claim**

## Purpose

Phase 5A converts the accepted `0.5.0-dev` development line into a deliberate stable `0.5.0` candidate suitable for final public-distribution validation.

This phase does **not** publish the plugin, create a WordPress.org availability claim, or weaken any accepted Phase 2–4 security/privacy/runtime contract.

## Release truth

The allowed state after Phase 5A implementation is:

```text
source version          0.5.0
WordPress Stable tag    0.5.0
channel                 stable candidate
Git tag                 not yet public/immutable until candidate acceptance
GitHub Release          not yet published until candidate acceptance
WordPress.org           not yet submitted/approved
Kairoseth catalog       must not claim WordPress.org availability
```

`0.4.0` remains historical accepted release-candidate evidence and must not be overwritten or redefined.

## Required implementation changes

The implementation PR must change the complete release contract as one unit:

- plugin header version `0.5.0-dev` → `0.5.0`;
- connector version constant aligned to `0.5.0`;
- WordPress `readme.txt` Stable tag aligned to `0.5.0`;
- WordPress changelog entry promoted from `0.5.0-dev` to `0.5.0`;
- repository README/CHANGELOG/SECURITY updated from development-line wording to stable-candidate wording;
- release metadata regression updated to reject stale `-dev` state;
- release package builder must reject development/prerelease version strings;
- CI package evidence must use the reproducible stable/release-candidate builder instead of the development-package builder;
- package manifest, SHA-256 and artifact naming must unambiguously identify the candidate and source commit/tree.

## Mandatory gates

No reduction in coverage is permitted. The candidate must pass all existing accepted gates:

- PHP syntax;
- shell syntax;
- connector contract/security regression;
- local Free analysis regression;
- safe local publication regression;
- lifecycle/uninstall regression;
- responsive/accessibility regression;
- Kairoseth contextual-support privacy regression;
- release metadata alignment;
- WordPress Coding Standards + PHPCompatibilityWP;
- official WordPress Plugin Check;
- WordPress 5.6 / PHP 7.4 runtime;
- WordPress 6.8 / PHP 8.2 runtime;
- WordPress 7.1 / PHP 8.3 runtime;
- Multisite + WooCommerce runtime;
- real-browser EN/ES admin UX;
- byte-reproducible stable package + checksum + manifest.

## Candidate acceptance boundary

Phase 5A is accepted only when all of the following are true:

1. implementation PR is green;
2. release metadata and package evidence identify `0.5.0` consistently;
3. reproducible package evidence records exact source commit, source tree, bytes, entries and SHA-256;
4. PR is merged following feature/release branch → PR → CI → merge;
5. post-merge `main` CI is green;
6. no blocking security/privacy/accessibility/WordPress.org-policy issue remains.

Only after that acceptance may Phase 5B create the immutable public tag/GitHub Release package and perform the final install/upgrade/uninstall release proof.

## Execution sequence

Phase 5 work must advance in small accepted slices:

```text
5A.0  freeze stable-candidate contract
5A.1  promote source/readme metadata to 0.5.0 + switch CI to stable package evidence
5A.2  accept exact reproducible candidate identity on PR and post-merge main
5B    immutable tag + GitHub Release + final packaged install/upgrade/uninstall proof
5C    WordPress.org submission/review/approval and truthful availability update
```

A later slice cannot bypass a failed gate from an earlier slice.

## WordPress.org boundary

WordPress.org submission/approval is a later external gate. Until approval exists, repository documentation, Kairoseth Extensions and release notes must use wording equivalent to **prepared for submission**, **stable candidate**, or **submitted/pending review** as factually applicable.

The project must never claim **Available on WordPress.org** merely because `0.5.0` metadata, a Git tag or a GitHub Release exists.

## Engineering rule

Any Phase 5 CI/build/test failure must emit the global structured diagnosis contract: failing pipeline/job/step, command, exit code, principal error/assertion, file/line when available, minimal context, error signature, confirmed root cause or marked hypothesis, applied fix, validation and regression evidence.
