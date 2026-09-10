# Changelog

All notable standalone AI Search Optimizer changes are recorded here.

## 0.5.0-dev — Unreleased

### Added
- Optional EN/ES **AI Search Optimizer Support** page under WordPress Tools.
- Explicit **Improve with Kairoseth** action for implementation guidance and optimization help.
- Explicit **Request custom development** action for tailored workflows, integrations, automation and additional features.
- Strict server-owned support context containing only plugin identity/version, WordPress version, locale and bounded request type.
- Fail-closed validation of the exact `https://kairoseth.com/custom-requests` destination.
- Static and real-browser regression coverage for the contextual support privacy boundary.
- Official WordPress Plugin Check as a blocking CI dependency before development-package evidence.
- Reproducible development-package evidence so later development is not mislabeled as the accepted 0.4.0 release candidate.

### Changed
- The Phase 3 customer strategy now follows the same WordPress.org-first local-Free model as Kairoseth AI Transparency: useful local functionality first, optional explicit support/improvement CTA, and bespoke development when requested.
- The former connection-readiness admin surface is superseded as the primary customer flow. The inherited REST connector remains available for compatible managed integrations but is not a license, entitlement or required Free workflow.
- Browser runtime credentials are generated ephemerally and passed through the test environment instead of being hardcoded in the acceptance script.

### Security / privacy
- Loading the support page performs no automatic request to Kairoseth.
- The support URL does not automatically include site URL, llms.txt content/hash, content inventory, administrator identity, WooCommerce content, credentials, tokens, prompts, logs or database content.
- The two allowed request types are fixed by plugin code: `implementation_support` and `business_customization`.
- Kairoseth re-normalizes extension identity server-side and ignores client-supplied product names or unknown context.
- No Kairoseth token, credential, entitlement or support state is persisted by the plugin support bridge.
- The inherited WordPress REST namespace, schema, exact site pin and compare-and-set deployment protocol remain unchanged.

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
- PR CI #28 and post-merge CI #29 passed all 7 jobs.
- No GitHub Release, public Git tag or WordPress.org listing is claimed yet.

## Historical predecessor

Connector 0.3.2 was accepted inside `Emmakex/kairoseth-platform` Phase 5B. See `docs/PROVENANCE.md` for exact lineage and real WordPress acceptance evidence.
