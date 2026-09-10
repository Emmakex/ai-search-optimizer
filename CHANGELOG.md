# Changelog

All notable standalone AI Search Optimizer changes are recorded here.

## 0.5.0-dev — Unreleased

### Added
- Optional EN/ES **Kairoseth connection readiness** page under WordPress Tools.
- Local HTTPS prerequisite check for the exact WordPress home URL.
- Local WordPress Application Password availability check.
- Local verification that the dedicated Kairoseth AI Web Deployer role retains the inherited deployment capability.
- Exact WordPress Blog ID / Network ID / home URL / REST connection endpoint / `llms.txt` target display before handoff.
- Guided least-privilege setup instructions and explicit user-initiated handoff to `https://kairoseth.com/app`.
- Browser and static regression coverage for the Phase 3A connection-readiness boundary.
- Reproducible **development-package** evidence so later development is not mislabeled as the accepted 0.4.0 release candidate.

### Security / privacy
- The readiness page performs no automatic request to Kairoseth.
- No site identifier, username, Application Password, token or organization data is placed in the handoff URL.
- No Kairoseth token, credential or cloud connection state is persisted by Phase 3A.
- Kairoseth organization/product authorization remains server-authoritative.
- The inherited WordPress REST namespace, schema, site pin and compare-and-set deployment protocol remain unchanged.

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