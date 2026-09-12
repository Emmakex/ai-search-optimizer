# Changelog

All notable standalone AI Search Optimizer changes are recorded here.

## 0.5.0 — Accepted stable candidate

### Added
- Optional EN/ES **AI Search Optimizer Support** page under WordPress Tools.
- Explicit **Improve with Kairoseth** action for implementation guidance and optimization help.
- Explicit **Request custom development** action for tailored workflows, integrations, automation and additional features.
- Strict server-owned support context containing only plugin identity/version, WordPress version, locale and bounded request type.
- Fail-closed validation of the exact `https://kairoseth.com/custom-requests` destination.
- Static and real-browser regression coverage for the contextual support privacy boundary.
- Official WordPress Plugin Check as a blocking CI dependency before stable-candidate package evidence.
- WordPress Coding Standards and PHPCompatibilityWP as blocking production-code quality gates.
- Machine-readable PHPCS diagnostics for actionable CI failures.
- Reproducible stable-candidate package evidence with source commit/tree, package bytes/entries and SHA-256.
- Durable CI incident record for non-product infrastructure failures and their verified recovery.

### Changed
- The customer strategy follows the WordPress.org-first local-Free model: useful local functionality first, optional explicit support/improvement CTA, and bespoke development when requested.
- The former connection-readiness admin surface is superseded as the primary customer flow. The inherited REST connector remains available for compatible managed integrations but is not a license, entitlement or required Free workflow.
- Production PHP was normalized to the blocking WordPress Coding Standards baseline without suppressing or baselining violations.
- WordPress-facing JSON encoding in the flagged publication path now uses `wp_json_encode()`.
- Source-inspection regressions validate semantic contract markers without depending on formatter-specific whitespace or Yoda comparison orientation.
- Browser runtime credentials are generated ephemerally and passed through the test environment instead of being hardcoded in the acceptance script.
- Plugin/readme/connector metadata was promoted from the development line to the deliberate stable `0.5.0` candidate.
- CI release evidence now uses the stable/release-candidate reproducibility builder instead of development-package evidence.
- Phase 5A froze the accepted candidate identity after PR and post-merge validation; Phase 5B is now the next release-gated workstream.

### Security / privacy
- Loading the support page performs no automatic request to Kairoseth.
- The support URL does not automatically include site URL, llms.txt content/hash, content inventory, administrator identity, WooCommerce content, credentials, tokens, prompts, logs or database content.
- The two allowed request types are fixed by plugin code: `implementation_support` and `business_customization`.
- Kairoseth re-normalizes extension identity server-side and ignores client-supplied product names or unknown context.
- No Kairoseth token, credential, entitlement or support state is persisted by the plugin support bridge.
- The inherited WordPress REST namespace, schema, exact site pin and compare-and-set deployment protocol remain unchanged.

### Phase 5A acceptance evidence

```text
implementation PR        #26 merged
PR CI                    #87 / run 34670016667 — PASS
main merge SHA           b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree              6a837ed67049ae04cdf59656cc15997a8d9bb7b3
post-merge CI            #88 / run 34670143261 — PASS on attempt 2
package                  ai-search-optimizer-0.5.0.zip
package bytes            29397
package entries          13
package SHA-256          0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
CI artifact ID           10290013554
blocking Phase 5A defects 0
```

The first post-merge CI #88 attempt failed only in the WP 5.6/PHP 7.4 runtime because Docker Hub reset the authentication connection while pulling `wordpress:5.6-php7.4-apache`. Exit code `125`, signature `bf51ce903a3c0225ead510f42cb6594f4119f069df93e762f9d6c2edab72a8a5`. No code change was made; rerunning only the failed job passed and final stable-package evidence then passed. The runtime gate was not weakened.

`0.5.0` is an accepted stable candidate, not yet an immutable GitHub Release and not yet claimed as published on WordPress.org.

### Prior acceptance evidence
- Phase 3B contextual support remains accepted with its privacy-bounded explicit CTA contract.
- Phase 3C WordPress.org support/privacy hardening is accepted in PR #20.
- Final PR CI #74 and post-merge main CI #75 passed all required quality, runtime, Plugin Check, browser and reproducible-package gates.
- Historical post-merge development-package SHA-256: `c10b2a780824fc08e43b557def3423a3d25bf313412ac6436ef9f6c53bad0137`.

## 0.4.0 — Release candidate

### Added
- Dedicated public `Emmakex/ai-search-optimizer` repository.
- MIT licensing for the standalone source line.
- Independent product, architecture, roadmap, acceptance, provenance and engineering documentation.
- Repository-owned PHP/contract/package CI foundation.
- Account-free local AI Search readiness checks for `robots.txt`, sitemap and stored `llms.txt` state.
- Eligible public WordPress content inventory with WooCommerce public-product awareness.
- Deterministic source-grounded `llms.txt` preview and validation.
- Explicit per-resource selection and safe local publication.
- Compare-before-write protection and idempotent same-content publication.
- Independent public `/llms.txt` read-back with exact SHA-256 verification.
- EN/ES recoverable publication diagnostics.
- Explicit uninstall data-retention preference with preserve-by-default behavior.
- Site-local single-site/Multisite uninstall cleanup for plugin roles, capabilities and options.
- Real packaged runtime acceptance on WordPress 5.6/PHP 7.4, WordPress 6.8/PHP 8.2 and WordPress 7.1/PHP 8.3.
- Real Multisite site-isolation and WooCommerce 11.1.0 runtime acceptance.
- Real Chromium EN/ES responsive/accessibility acceptance at desktop and 390px mobile width.
- Deterministic release-candidate packaging with byte-reproducibility, manifest and SHA-256 evidence.

### Changed
- Public plugin name from `Kairoseth AI Web Readiness Connector` to `AI Search Optimizer`.
- Main standalone plugin filename to `ai-search-optimizer.php`.
- Root and WordPress readmes describe the implemented Free workflow and accepted release-candidate boundary.

### Compatibility
- Based on accepted connector 0.3.2.
- Connector schema remains `2`.
- Existing `kairoseth-ai-web-readiness/v1` REST namespace, capability, role, options and query-var identifiers are intentionally preserved for Kairoseth Platform compatibility.
- Deactivation preserves stored deployment data; uninstall behavior for that deployment is explicitly user-selectable.

### Acceptance evidence
- Phase 2 / Free release-candidate decision: GO for later public distribution.
- Accepted source commit: `4d68b111d1f796fdc9bfbc3e670eeecc69c09a76`.
- Accepted source tree: `472e8c5e5bc20ed8f4eed412ab5515561b89ff16`.
- Accepted ZIP SHA-256: `27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c`.
- PR CI #28 and post-merge CI #29 passed all required jobs.
- No GitHub Release, public Git tag or WordPress.org listing is claimed yet.

## Historical predecessor

Connector 0.3.2 was accepted inside `Emmakex/kairoseth-platform` Phase 5B. See `docs/PROVENANCE.md` for exact lineage and real WordPress acceptance evidence.
