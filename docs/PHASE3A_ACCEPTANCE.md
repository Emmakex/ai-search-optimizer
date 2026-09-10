# AI Search Optimizer — Phase 3A Acceptance

Status: **Implementation complete; acceptance pending PR CI + post-merge CI**  
Date: **10 September 2026**

Phase 3A adds an explicit, optional WordPress-side readiness and handoff surface for connecting AI Search Optimizer to Kairoseth. It does not create a second authentication protocol and does not make the Free local workflow dependent on Kairoseth.

## Acceptance contract

Phase 3A is accepted only when all of the following are true:

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
[ ] PR CI PASS
[ ] merge to main
[ ] post-merge CI PASS
[ ] blocking Phase 3A defects = 0
```

## Existing cloud authority retained

Kairoseth Platform remains authoritative for organization/product access and the existing WordPress connection lifecycle. The current platform flow validates the dedicated WordPress username + Application Password server-side, pins the exact WordPress identity, encrypts the credential server-side, and uses the inherited connection/deployment endpoints for safe managed publication.

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

## Validation required for closure

The Phase 3A PR must pass the repository CI gates selected by the changed contracts, including:

- PHP syntax;
- connector/security regression;
- local Free analysis/publication/lifecycle regressions;
- Phase 3A connection-readiness regression;
- generated ZIP content contract;
- representative WordPress/PHP packaged runtimes;
- Multisite + WooCommerce packaged runtime;
- real Chromium EN/ES desktop/mobile admin UX;
- deterministic development-package evidence.

Phase 3B cannot begin until this acceptance record is closed with the real PR CI, merge SHA and post-merge CI evidence.