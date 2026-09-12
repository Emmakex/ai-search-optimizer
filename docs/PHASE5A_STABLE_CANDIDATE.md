# AI Search Optimizer — Phase 5A Stable Candidate

Status: **ACCEPTED — exact `0.5.0` stable-candidate identity frozen**  
Accepted: **12 September 2026**  
Distribution state: **stable candidate only; no WordPress.org availability claim**

## Purpose

Phase 5A converted the accepted `0.5.0-dev` development line into a deliberate stable `0.5.0` candidate suitable for final public-distribution validation.

This phase does **not** publish the plugin on WordPress.org or create a WordPress.org availability claim. It preserves every accepted Phase 2–4 security, privacy, runtime and local-Free contract.

## Accepted release truth

```text
source version          0.5.0
WordPress Stable tag    0.5.0
channel                 stable candidate
Git tag                 not yet created — Phase 5B
GitHub Release          not yet published — Phase 5B
WordPress.org           not yet submitted/approved
Kairoseth catalog       must not claim WordPress.org availability
```

`0.4.0` remains historical accepted release-candidate evidence and is not overwritten or redefined.

## Exact accepted candidate identity

The accepted Phase 5A identity is the post-merge `main` source and reproducible package below:

```text
version                 0.5.0
source commit           b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree             6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package                 ai-search-optimizer-0.5.0.zip
package bytes           29397
package entries         13
package SHA-256         0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
CI artifact ID          10290013554
```

The release-candidate builder produced the ZIP twice with the same SHA-256 before acceptance, proving byte-for-byte reproducibility for this source tree.

## Implemented release-contract changes

Phase 5A.1 changed the release contract as one unit:

- plugin header version `0.5.0-dev` → `0.5.0`;
- connector version constant aligned to `0.5.0`;
- WordPress `readme.txt` Stable tag aligned to `0.5.0`;
- WordPress changelog entry promoted to `0.5.0`;
- repository README/CHANGELOG/SECURITY moved from development-line wording to stable-candidate wording;
- release metadata regression rejects stale development/prerelease state;
- stable package builder rejects `-dev`, alpha, beta and RC version strings;
- CI final package evidence uses the reproducible stable-candidate builder;
- release manifest/checksum/artifact naming identify the candidate and exact source commit/tree.

No product behavior, connector protocol, entitlement model, local-Free functionality or privacy boundary changed.

## Acceptance evidence

```text
implementation PR                 #26
PR head                           4a1383ed344ef88b92689608403472b31a9bc4ca
PR CI                             #87 / run 34670016667 — PASS
PR synthetic merge SHA            43003069b44a2623a5f880f5db488ba268a5c696
main merge SHA                    b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
post-merge CI                     #88 / run 34670143261 — PASS on attempt 2
blocking Phase 5A defects         0
```

Required gates passed:

- PHP syntax;
- shell syntax;
- connector contract/security regression;
- local Free analysis regression;
- safe local publication regression;
- lifecycle/uninstall regression;
- responsive/accessibility regression;
- Kairoseth contextual-support privacy regression;
- stable release metadata alignment;
- WordPress Coding Standards + PHPCompatibilityWP;
- official WordPress Plugin Check;
- WordPress 5.6 / PHP 7.4 runtime;
- WordPress 6.8 / PHP 8.2 runtime;
- WordPress 7.1 / PHP 8.3 runtime;
- Multisite + WooCommerce runtime;
- real-browser EN/ES admin UX;
- byte-reproducible stable package + checksum + manifest.

## CI #88 incident and durable diagnosis

The first post-merge attempt failed only in `Runtime WP 5.6 / PHP 7.4` while pulling the WordPress Docker image. The package had already built successfully with the accepted SHA-256.

```text
pipeline/run          CI #88 / 34670143261 attempt 1
job                  Runtime WP 5.6 / PHP 7.4
step                 Packaged WordPress runtime acceptance
command              bash scripts/ci-run.sh "WordPress $WP_VERSION / PHP $PHP_VERSION runtime" bash scripts/runtime-wordpress.sh
exit code            125
primary error        Docker pull of wordpress:5.6-php7.4-apache failed while contacting auth.docker.io: connection reset by peer
file/line            not applicable — external registry/network failure
error signature      bf51ce903a3c0225ead510f42cb6594f4119f069df93e762f9d6c2edab72a8a5
root cause status    confirmed
root cause           transient Docker Hub authentication/registry connectivity failure before the WordPress container started
code fix             none
recovery             rerun only the failed runtime job
validation           WP 5.6/PHP 7.4 PASS; final stable-candidate package evidence PASS; CI #88 overall PASS on attempt 2
```

This is classified as an external infrastructure failure, not a product regression. The strict runtime gate remains unchanged.

The canonical reusable incident record is maintained in [`CI_INCIDENTS.md`](CI_INCIDENTS.md).

## Acceptance decision

All Phase 5A acceptance conditions are satisfied:

1. implementation PR green;
2. release metadata/package identify `0.5.0` consistently;
3. exact source commit/tree/package bytes/entries/SHA-256 recorded;
4. PR merged through the required branch → PR → CI → merge flow;
5. post-merge `main` CI green;
6. no blocking security/privacy/accessibility/WordPress.org-policy defect remains in this phase.

**Decision: Phase 5A accepted.**

## Next permitted workstream — Phase 5B

Phase 5B may now proceed with:

- immutable `0.5.0` Git tag;
- GitHub Release tied to the accepted source;
- release ZIP + checksum publication from repository/CI evidence;
- final install/upgrade/deactivate/uninstall proof using the release package;
- verification that release/package/tag identities cannot drift.

WordPress.org submission/review remains Phase 5C. Until external approval exists, no documentation or customer surface may claim **Available on WordPress.org**.

## Engineering rule

Any Phase 5 CI/build/test failure must emit the global structured diagnosis contract: failing pipeline/job/step, command, exit code, principal error/assertion, file/line when available, minimal context, error signature, confirmed root cause or marked hypothesis, applied fix/recovery, validation and regression evidence.
