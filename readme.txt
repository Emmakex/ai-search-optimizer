=== AI Search Optimizer ===
Tags: llms.txt, ai seo, ai search, geo, aeo
Requires at least: 5.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 0.4.0
License: MIT
License URI: https://opensource.org/license/mit/

Prepare, validate and publish WordPress content for the AI-search web with secure llms.txt foundations.

== Description ==

AI Search Optimizer is a WordPress-first AI Search and llms.txt optimization extension.

The accepted 0.4.0 release-candidate line provides an account-free local workflow for preparing a site-local llms.txt from public WordPress content. Current repository development continues as 0.5.0-dev and adds an optional Kairoseth connection-readiness and guided handoff surface without changing the accepted connector protocol.

Current Free capabilities include:

* Local AI Search readiness checks for robots.txt, sitemap and llms.txt state.
* Eligible public WordPress content inventory and selection.
* Public WooCommerce products included when available.
* Deterministic source-grounded llms.txt generation with no generated timestamps.
* Validation for structure, size, duplicate URLs and same-site URL scope.
* Explicit human publication after validation.
* Compare-before-write protection against stale-page replacement.
* Site-local llms.txt serving with SHA-256 integrity checks.
* Independent public read-back with redirects disabled.
* Exact SHA-256 comparison between generated, stored and public content.
* Exact WordPress single-site / Multisite identity reporting.
* Dedicated least-privilege deployment capability and role.
* Authenticated namespaced REST connection/deployment endpoints retained for Kairoseth compatibility.
* No FTP/SFTP, hosting-panel, database or WooCommerce API credentials.
* No silent transmission of local site content to Kairoseth, AI providers or third-party analytics.

The 0.5.0-dev Phase 3 connection-readiness screen is optional. It checks local prerequisites such as HTTPS, WordPress Application Password availability, the dedicated deployer role and the exact site identity. It makes no automatic request to Kairoseth. The handoff opens only after the user chooses it and carries no site identifier, username, Application Password, token or organization data in the URL.

Optional Kairoseth services may provide advanced site analysis, AI Search readiness evidence, curation, history, optional AI assistance and managed publication verification. Kairoseth organization/product authorization remains server-side. Cloud functionality does not grant WordPress or Kairoseth roles from browser, plugin or model-controlled state.

AI Search Optimizer improves preparation and provides evidence. It does not guarantee rankings, indexing, crawling, citations, model ingestion or training inclusion by third-party search/AI providers.

== Installation ==

0.4.0 is the accepted standalone Free release candidate. Until an official GitHub Release or WordPress.org listing exists, install only an accepted package whose SHA-256 is published with the release evidence. The repository main branch may contain later development such as 0.5.0-dev and must not be treated as the accepted 0.4.0 package.

== Frequently Asked Questions ==

= Does the plugin guarantee citations in ChatGPT, Gemini, Claude or other AI systems? =

No. External providers decide how they crawl, index, retrieve and cite content.

= Does it require WooCommerce API keys? =

No. Public WooCommerce products are discovered from the local WordPress site and the inherited connector contract does not use WooCommerce consumer keys.

= Is a Kairoseth account required? =

No for the local Free workflow. The optional Kairoseth handoff opens the authenticated Kairoseth application only when requested. Advanced connected features may require an authorized Kairoseth account/product context.

= Does the connection-readiness page send my site to Kairoseth? =

No. The local readiness page does not call Kairoseth automatically and does not persist Kairoseth tokens or credentials. When you choose to open Kairoseth, the handoff URL contains no site or credential data.

= What happens when I deactivate the plugin? =

Deactivation preserves the stored llms.txt deployment and the uninstall preference. The plugin's dynamic public llms.txt route is unavailable while the plugin is inactive.

= What happens when I uninstall the plugin? =

Under Tools > AI Search Optimizer Data you can choose whether uninstall preserves or deletes the stored llms.txt deployment. Preserve is the default. Uninstall always removes the plugin setup marker, custom deployer role, administrator capability and the retention preference. Multisite cleanup runs site by site.

== Changelog ==

= 0.5.0-dev =
* Opened the Phase 3 development line without reusing the accepted 0.4.0 version identity.
* Added optional EN/ES Kairoseth connection-readiness and guided handoff UX.
* Added local HTTPS, Application Password, least-privilege role and exact-site identity checks.
* Preserved the inherited REST schema/namespace and server-authoritative Kairoseth connection model.

= 0.4.0 =
* First standalone Free release-candidate line based on accepted connector 0.3.2.
* Added account-free local readiness, content selection, deterministic llms.txt generation/validation and safe publication with public SHA-256 verification.
* Added explicit uninstall data-retention controls and lifecycle cleanup.
* Added real WordPress 5.6/PHP 7.4 through WordPress 7.1/PHP 8.3 runtime acceptance.
* Added real Multisite isolation, WooCommerce 11.1.0 compatibility and EN/ES responsive browser acceptance.