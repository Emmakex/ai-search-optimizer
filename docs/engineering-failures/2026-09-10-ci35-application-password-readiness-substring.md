# CI #35 — Application Password readiness substring false positive

Date: **10 September 2026**  
PR: **#15 — Phase 3A Kairoseth connection readiness**

## Failure

```text
pipeline: CI #35
job: validate
step: Kairoseth connection readiness regression
command: php tests/kairoseth-connection-readiness-check.php
exit code: 1
primary error:
  FAIL: Phase 3A must not collect or store an Application Password
signature: b72759786f26644eb79ab26c49f40150ee5e62769b0bd19bfb461608e31a66a6
```

## Root cause

**Confirmed.** The regression test prohibited the raw substring `applicationPassword` anywhere in the Phase 3A module. The legitimate local readiness state key `applicationPasswords` contains that substring, so the assertion reported a secret-handling violation even though the page did not render a password field, read a credential from request data, persist a secret, or send one remotely.

## Fix

The test now checks concrete secret-handling mechanisms instead of a vocabulary substring:

- no `type="password"` input;
- no `applicationPassword` / `application_password` field name;
- no Application Password reads from `$_POST` or `$_REQUEST`;
- no option persistence in the Phase 3A module;
- no automatic WordPress HTTP/cURL request;
- no cloud access/refresh token storage.

The legitimate `applicationPasswords` readiness key remains allowed.

## Prevention

Security regressions should assert the dangerous mechanism or data flow, not an ambiguous substring that can appear in safe status labels, variable names or explanatory copy.

## Validation

Pending on the corrected PR CI run. Closure evidence should record the first subsequent green run.