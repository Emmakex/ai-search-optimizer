# AI Search Optimizer — Phase 3A Acceptance

Status: **Accepted / closed — blocking Phase 3A defects: 0**  
Date: **10 September 2026**

Phase 3A adds an explicit, optional WordPress-side readiness and handoff surface for connecting AI Search Optimizer to Kairoseth. It does not create a second authentication protocol and does not make the Free local workflow dependent on Kairoseth.

## Acceptance contract

```text
[x] accepted `kairoseth-ai-web-readiness/v1` REST namespace preserved
[x] connector schema `2` preserved
[x] dedicated least-privilege deployment capability/role preserved
[x] exact WordPress Blog ID / Network ID / home URL identity reused
[x] WordPress-side readiness checks HTTPS
[x] WordPress-side readiness checks Application Password availability
[x] WordPress-side readiness checks least-privilege deployer role/capability
[x] exact inherited connection endpoint is shown locally
[x] exact site-local llms.txt target is shown locally
[x] EN/ES guided connection steps are present
[x] `Ready to connect` is explicitly not represented as `Connected`
[x] Kairoseth handoff is user initiated
[x] handoff URL is the canonical `https://kairoseth.com/app`
[x] handoff URL contains no site, user, credential, token or organization query data
[x] readiness page makes no automatic request to Kairoseth
[x] readiness page stores no Kairoseth token/credential/connection state
[x] local Free analysis/publication remains independent from Kairoseth availability
[x] accepted 0.4.0 release-candidate identity is not reused for new code
[x] development line is `0.5.0-dev`
[x] development package remains deterministic/reproducible
[x] static Phase 3A regression exists
[x] real-browser EN/ES desktop/mobile acceptance covers the new page
[x] generated plugin package contract includes the Phase 3A readiness module
[x] PR CI PASS
[x] merge to main
[x] post-merge CI PASS
[x] blocking Phase 3A defects = 0
```

## Existing cloud authority retained

Kairoseth Platform remains authoritative for organization/product access and the existing WordPress connection lifecycle. The platform validates the dedicated WordPress username + Application Password server-side, pins the exact WordPress identity, encrypts the credential server-side, and uses the inherited connection/deployment endpoints for safe managed publication.

The standalone plugin does not infer or grant Kairoseth roles, entitlements, organizations, products or provider access from local WordPress state.

## Development version boundary

The accepted Free release candidate remains immutable evidence:

```text
version            0.4.0
source commit      4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree        472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256    27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

Phase 3 development uses `0.5.0-dev`; a development package must never be described as the accepted 0.4.0 release candidate.

## Validation evidence

```text
PR                                      #15
PR head                                 dfab5839d549b2a1da48612f8bc23e125b725eca
PR CI                                   #38 PASS — 7/7 jobs
merge SHA                               6b771f3b54915a57d246d556638c3eefc9755208
post-merge CI                           #39 PASS — 7/7 jobs
post-merge source tree                  caab5d91799a622540fff3b7403838a2c63799e4
development package                     ai-search-optimizer-0.5.0-dev.zip
package bytes                           26652
package entries                         12
package SHA-256                         e62860eea41b364a869ef2762e6be1583a9eaac4212b3ffd30eaec30b005c7f2
post-merge CI artifact id               10160373958
reproducible build                      PASS
```

CI #38 and #39 passed:

- PHP and shell syntax;
- connector/security compatibility regression;
- local Free analysis, publication and lifecycle regressions;
- responsive/accessibility source regression;
- Phase 3A Kairoseth connection-readiness regression;
- development/release metadata alignment;
- generated ZIP content contract;
- WordPress 5.6 / PHP 7.4 runtime;
- WordPress 6.8 / PHP 8.2 runtime;
- WordPress 7.1 / PHP 8.3 runtime;
- Multisite + WooCommerce runtime;
- real Chromium EN/ES desktop/mobile acceptance;
- deterministic development-package evidence.

## Failures found and learned during acceptance

Two CI failures were fixture defects rather than product defects and were fixed without bypassing the affected gates:

```text
CI #32  contract/security fixture pinned Version 0.4.0
signature 5056f757cdbd7ba2b2beb7631fa9e155b8205caf594c4488d0be59cf4650eaff
fix: separate invariant compatibility contracts from release-version metadata

CI #35  Application Password readiness substring false positive
signature b72759786f26644eb79ab26c49f40150ee5e62769b0bd19bfb461608e31a66a6
fix: test concrete secret-handling mechanisms instead of ambiguous vocabulary substring
```

The detailed records live under [`engineering-failures/`](engineering-failures/README.md).

## Closure decision

**Phase 3A is accepted and closed.** Phase 3B — coordinated Kairoseth onboarding UX — is now the next permitted dependent milestone. Its implementation must preserve the Phase 3A guarantees and must not introduce browser-authoritative access or a second authentication protocol.