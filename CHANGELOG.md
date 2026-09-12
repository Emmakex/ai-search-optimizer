# Changelog

All notable standalone AI Search Optimizer changes are recorded here.

## 0.5.0 — Public GitHub release

### Added
- Account-free local AI Search / `llms.txt` workflow for WordPress and WooCommerce.
- Optional EN/ES **AI Search Optimizer Support** page under WordPress Tools.
- Explicit **Improve with Kairoseth** action for implementation guidance and optimization help.
- Explicit **Request custom development** action for tailored workflows, integrations, automation and additional features.
- Strict plugin-owned support context containing only plugin identity/version, WordPress version, locale and bounded request type.
- Fail-closed validation of the exact `https://kairoseth.com/custom-requests` destination.
- Static and real-browser regression coverage for the contextual-support privacy boundary.
- Official WordPress Plugin Check as a blocking CI dependency.
- WordPress Coding Standards and PHPCompatibilityWP as blocking production-code quality gates.
- Real packaged WordPress/PHP, Multisite/WooCommerce and EN/ES browser acceptance.
- Permanent release lifecycle gate proving clean install, `0.4.0 → 0.5.0` upgrade, preserve/reinstall recovery and delete-uninstall behavior.
- Fail-closed one-shot GitHub Release publisher with exact source/tree/package identity.
- Production CTA release preflight for EN/ES and both supported request types before any public release mutation.
- Draft-first GitHub Release publication, release-asset download/byte comparison and second lifecycle proof against the downloaded ZIP.
- Durable CI incident register for non-obvious failures and verified recoveries.

### Changed
- The customer strategy follows the WordPress.org-first local-Free model: useful local functionality first, optional explicit support/improvement CTA, and bespoke development only when requested.
- The former connection-readiness admin surface is superseded as the primary customer flow. The inherited REST connector remains available for compatible managed integrations but is not a license, entitlement or required Free workflow.
- Production PHP was normalized to the blocking WordPress Coding Standards baseline without suppressing or baselining violations.
- Browser runtime credentials are generated ephemerally and passed through the test environment instead of being hardcoded.
- Stable release metadata is `0.5.0` across plugin/readme/connector surfaces.
- Phase 5A froze the exact package identity; Phase 5B published that same identity without redefining it.

### Security / privacy
- Loading the support page performs no automatic request to Kairoseth.
- The support URL does not automatically include site URL, llms.txt content/hash, content inventory, administrator identity, WooCommerce content, credentials, tokens, prompts, logs or database content.
- Allowed request types are fixed by plugin code: `implementation_support` and `business_customization`.
- Kairoseth re-normalizes extension identity server-side and ignores client-supplied product names or unknown context.
- No Kairoseth token, credential, entitlement or support state is persisted by the plugin support bridge.
- The inherited WordPress REST namespace, schema, exact site pin and compare-and-set deployment protocol remain unchanged.
- Release publication fails closed on tag/source/package drift or broken production CTA behavior.

### Phase 5A acceptance evidence

```text
implementation PR        #26 merged
PR CI                    #87 / run 34670016667 — PASS
accepted source          b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree              6a837ed67049ae04cdf59656cc15997a8d9bb7b3
post-merge CI            #88 / run 34670143261 — PASS on attempt 2
package                  ai-search-optimizer-0.5.0.zip
package bytes            29397
package entries          13
package SHA-256          0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
blocking Phase 5A defects 0
```

CI #88 attempt 1 failed only in WP 5.6/PHP 7.4 because Docker Hub reset the authentication connection before WordPress started. No code change was made; rerunning only the failed job passed. The strict runtime gate was retained.

### Phase 5B release evidence

```text
lifecycle PR             #28 merged
PR CI                    #93 / run 34671385877 — PASS
lifecycle merge SHA      6c47abe32152835debbc9a76869ea5af037f0501
post-merge CI            #94 / run 34671531167 — PASS on attempt 2

publication PR           #29 merged
PR CI                    #98 / run 34680787497 — PASS
publication merge SHA    83c4cbcc21971e9cb28b099c64a05af18a9ba29d
post-merge CI            #99 / run 34680928053 — PASS
publication run          34681042749 — PASS

tag                     0.5.0
annotated tag object    6433cca08a8d8a213f0c0326447910c5ee732ff5
tag target              b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
GitHub Release ID       387492480
package SHA-256         0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
```

The publication workflow verified the production Kairoseth CTA with HTTP 200 for EN/ES × `implementation_support`/`business_customization` before any tag/release mutation. It then rebuilt the package, ran lifecycle acceptance, created a draft release, downloaded the published assets back, required exact SHA/byte identity, reran lifecycle acceptance against the downloaded ZIP, and only then made the release public.

`0.5.0` is now a public GitHub Release. It is **not yet claimed as published on WordPress.org**; that remains Phase 5C.

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
- Real packaged WordPress/PHP, Multisite/WooCommerce and browser acceptance.
- Deterministic release-candidate packaging with byte reproducibility, manifest and SHA-256 evidence.

### Compatibility
- Based on accepted connector 0.3.2.
- Connector schema remains `2`.
- Existing `kairoseth-ai-web-readiness/v1` REST namespace, capability, role, options and query-var identifiers are intentionally preserved for Kairoseth Platform compatibility.

### Acceptance evidence

```text
source commit       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256     27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

## Historical predecessor

Connector 0.3.2 was accepted inside `Emmakex/kairoseth-platform`. See `docs/PROVENANCE.md` for lineage and real WordPress acceptance evidence.
