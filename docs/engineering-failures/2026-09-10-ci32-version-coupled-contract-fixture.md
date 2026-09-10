# CI #32 — version-coupled compatibility fixture

Date: **10 September 2026**  
PR: **#15 — Phase 3A Kairoseth connection readiness**

## Failure

```text
pipeline: CI #32
job: validate
step: Contract and security regression
command: php tests/contract-check.php
exit code: 1
primary errors:
  FAIL: missing required contract: Version: 0.4.0
  FAIL: missing required contract: const KAIROSETH_AIWR_CONNECTOR_VERSION = '0.4.0';
signature: 5056f757cdbd7ba2b2beb7631fa9e155b8205caf594c4488d0be59cf4650eaff
```

## Root cause

**Confirmed.** `tests/contract-check.php` mixed two different responsibilities:

1. invariant connector/security compatibility contracts; and
2. the exact version number of the accepted 0.4.0 release candidate.

Phase 3A correctly opened the new `0.5.0-dev` development line so new source would not reuse the immutable 0.4.0 release-candidate identity. The compatibility fixture therefore failed because its hard-coded version expectation was stale, not because the inherited REST/capability/deployment contract changed.

## Fix

`tests/contract-check.php` now:

- requires the connector-version constant to remain present but does not pin it to 0.4.0;
- requires a non-empty plugin Version header and connector version constant;
- continues to pin the actual invariant REST namespace, schema, capability, role, deployment option, site identity, compare-and-set and security constraints;
- leaves exact development/release version policy to `tests/release-metadata-check.php`, whose purpose is specifically metadata/version alignment.

## Prevention

Compatibility/security tests must not hard-code a release number unless that number itself is the contract being tested. Release identity and channel/version alignment belong in release-metadata tests.

## Validation

Pending on the fix commit and subsequent CI run. This record must be updated or superseded by closure evidence once the corrected PR CI passes.