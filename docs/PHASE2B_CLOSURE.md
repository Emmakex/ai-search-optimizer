# AI Search Optimizer — Phase 2B Closure

Status: **ACCEPTED**  
Date: **10 September 2026**

## Scope

Phase 2B adds explicit resource selection and safe site-local `llms.txt` publication on top of the accepted Phase 2A local analysis/preview workflow.

The Free workflow remains account-free and does not send site content to Kairoseth, AI providers or third-party analytics.

## Accepted behavior

- per-resource selection in the EN/ES WordPress admin workspace;
- an explicit empty selection stays empty instead of silently restoring all resources;
- submitted selection keys are filtered against the current eligible public WordPress inventory;
- the server rebuilds the artifact from current WordPress data rather than trusting posted URLs/content;
- Preview performs no mutation;
- Publish and Verify are explicit human actions protected by WordPress nonce plus the inherited least-privilege capability;
- validation runs before mutation;
- compare-before-write state token stops replacement when the stored deployment changed after page load;
- same-content publication is idempotent and avoids an unnecessary rewrite;
- the accepted deployment option/public `/llms.txt` path remains the single source of truth;
- local writes record `source=local-free` without changing the inherited REST schema;
- stored content integrity is rechecked after write;
- public verification performs an HTTP read-back of `/llms.txt`, follows no redirects and requires exact SHA-256 equality;
- verification can be retried without mutating the stored deployment;
- public read-back failures are recoverable and do not erase a successfully stored deployment;
- state-drift, validation, storage and verification diagnostics are exposed in EN/ES;
- no arbitrary filesystem write or provider credential was introduced.

## Evidence

```text
Implementation PR                         #5
Final PR head                             895ba6a22c9f46674d43c4d860a9f14d99f6063c
CI #9                                     FAIL
CI #9 failing step                        Safe local publication regression
CI #9 error                               PHP assertion needle interpolation
CI #9 signature                           d48cb3aba4e635dfa5f275bf554bd46ca36a586923f5cc4a654d357cf2475126
CI #10                                    PASS
Merge SHA                                 35251c3842acaf2c71c72aa106bc855cd09fe2a9
Post-merge CI #11                         PASS
Blocking Phase 2B defects                 0
```

## CI #9 diagnostic

The failed test was `tests/local-publication-check.php`. Double-quoted assertion strings interpolated `$content`, `$record`, `$content_hash` and `$public_hash`, so the regression searched for malformed strings even though the implementation contract was present.

```text
Expected   literal PHP source needles containing $variables
Received   interpolated strings with the variables removed as undefined
Signature  d48cb3aba4e635dfa5f275bf554bd46ca36a586923f5cc4a654d357cf2475126
Root cause test fixture quoting; product code was not failing
Fix        escape the variable markers so assertions inspect literal source
Validation CI #10 PASS + post-merge CI #11 PASS
```

PHP syntax, the inherited connector security/compatibility regression and Phase 2A regression were already green in CI #9.

## Preserved compatibility

Phase 2B does not change the inherited connector namespace, capability, role, deployment option, connector schema, site identity or public `llms.txt` route. Kairoseth Platform compatibility remains protected by the existing contract regression.

## Not accepted by this closure

Phase 2B acceptance is not a public release. It does not claim:

- WordPress.org availability;
- Kairoseth Extensions `Available` status;
- representative WordPress/PHP runtime matrix acceptance;
- final Multisite/WooCommerce runtime acceptance;
- responsive/accessibility acceptance;
- install/update/uninstall/data-retention completion;
- final release package/tag/checksum.

Those items remain in Phase 2C or later release/distribution gates.

## Next permitted boundary

**Phase 2C — Free release hardening** is now the next permitted implementation boundary.
