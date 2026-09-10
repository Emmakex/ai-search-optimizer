# AI Search Optimizer — Engineering rules

These rules inherit the Kairoseth global engineering baseline and apply to this standalone WordPress extension.

1. **Least privilege.** Request only WordPress permissions required by the promised operation. Do not require Administrator as the normal connected deployment identity.
2. **Server-authoritative cloud access.** The plugin/browser/model cannot grant Kairoseth roles, organizations, entitlements, credentials or deployment authority.
3. **Secrets stay out of distributed code.** No provider API key, Kairoseth production secret, encryption key or customer credential is committed or packaged.
4. **Tenant/site isolation.** Kairoseth-connected operations resolve organization/product server-side; WordPress operations are pinned to the exact site/blog/network identity.
5. **Explicit mutation authority.** Publication/destructive actions require clear user/operator intent; background/model output never authorizes them.
6. **Integrity before trust.** Managed artifacts preserve deterministic hash validation and remote-state conflict protection where applicable.
7. **EN/ES together.** Kairoseth-owned customer-facing WordPress UI ships English and Spanish in the same change.
8. **Responsive/accessibility acceptance.** Customer-facing UI passes the host-appropriate responsive, keyboard/focus and accessibility checks affected by the change.
9. **Minimum sufficient validation.** Run the host/product gates required by the changed contract, not unrelated Kairoseth suites.
10. **Finish before advancing.** A dependent roadmap phase does not begin until implementation, required CI/acceptance, blockers and documentation for its dependency are complete.
11. **Feature branch → PR → CI → merge → release verification.** No release-only shortcut.
12. **Independent repository CI.** This repository owns PHP/static tests, package validation and WordPress-specific acceptance.
13. **No false release truth.** Source on `main` is not automatically an Available product, WordPress.org listing or stable public release.
14. **Learn from failures.** Non-obvious build/test/runtime/WordPress failures and their verified fixes are recorded before related work advances.
15. **Actionable diagnostics.** Failures should produce product/version, host version, operation, primary error, normalized signature, root-cause status, recovery/fix and validation evidence.
16. **No hidden telemetry.** Remote transmission/analytics must be explicit, necessary for the feature, documented and compliant with host/store policy.
17. **Compatibility is a contract.** Legacy REST/capability/state identifiers are not renamed casually; breaking changes require migration, versioning and regression evidence.
18. **Package provenance.** Release ZIPs come from repository source/CI and are tied to an immutable tag/commit with checksum when releases begin.
19. **Claims remain evidence-bound.** Never guarantee ranking, indexing, citations, AI ingestion, training inclusion or provider endorsement.
20. **WordPress.org is a separate gate.** Directory policy, Plugin Check, stable tag/readme, licensing, assets and submission acceptance are verified before claiming directory availability.
