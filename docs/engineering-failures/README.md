# AI Search Optimizer — Engineering failure memory

This directory records non-obvious CI, build, runtime and WordPress failures together with their verified fixes so the same class of failure is less likely to recur.

Each record should include the failing pipeline/job/step, command, exit code, primary error, file/contract affected, normalized signature, root cause, fix and validation evidence.

Current records:

- [`2026-09-10-ci32-version-coupled-contract-fixture.md`](2026-09-10-ci32-version-coupled-contract-fixture.md) — Phase 3A CI fixture incorrectly pinned the accepted 0.4.0 version instead of testing invariant compatibility contracts.
- [`2026-09-10-ci35-application-password-readiness-substring.md`](2026-09-10-ci35-application-password-readiness-substring.md) — Phase 3A security regression treated the safe `applicationPasswords` readiness key as if it were a collected secret.
