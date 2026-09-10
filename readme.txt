=== AI Search Optimizer ===
Contributors: emmakex
Tags: llms.txt, ai seo, ai search, geo, aeo
Requires at least: 5.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 0.4.0
License: MIT
License URI: https://opensource.org/license/mit/

Prepare, validate and publish WordPress content for the AI-search web with secure llms.txt foundations.

== Description ==

AI Search Optimizer is a local-first WordPress plugin for preparing, validating and publishing a site-local llms.txt from public WordPress content.

The accepted Free workflow works without a Kairoseth account and includes:

* Local AI Search readiness checks for robots.txt, sitemap and llms.txt state.
* Eligible public WordPress content inventory and explicit resource selection.
* Public WooCommerce products included when available.
* Deterministic source-grounded llms.txt generation with no generated timestamps.
* Validation for structure, size, duplicate URLs and same-site URL scope.
* Explicit human publication after validation.
* Compare-before-write protection against stale-page replacement.
* Site-local llms.txt serving with SHA-256 integrity checks.
* Independent public read-back with redirects disabled.
* Exact SHA-256 comparison between generated, stored and public content.
* Exact WordPress single-site / Multisite identity handling.
* Dedicated least-privilege deployment capability and role.
* No FTP/SFTP, hosting-panel, database or WooCommerce API credentials.
* No silent transmission of local site content to Kairoseth, AI providers or third-party analytics.

The plugin also provides an optional administrator-initiated support/custom-development page. Loading that page does not contact Kairoseth. External navigation starts only after an administrator deliberately selects a support or custom-improvement action.

AI Search Optimizer improves preparation and provides technical evidence. It does not guarantee rankings, indexing, crawling, citations, model ingestion or training inclusion by third-party search or AI providers.

== External services ==

The Free analysis, content selection, llms.txt generation, validation, publication and public verification workflows are local to WordPress and do not require an external account.

**Kairoseth Custom Requests** is an optional support and custom-development service used only after an administrator deliberately clicks an action on **Tools > AI Search Optimizer Support**. Loading the support page itself makes no request to Kairoseth.

The explicit browser navigation goes to `https://kairoseth.com/custom-requests` and includes only this bounded technical/product context:

* source: `extension`;
* extension slug: `ai-search-optimizer`;
* extension name: `AI Search Optimizer`;
* installed plugin version;
* host platform: `wordpress`;
* installed WordPress version;
* bounded English/Spanish locale;
* the administrator-selected bounded request type.

The plugin does **not** automatically attach or transmit the site URL, administrator identity, llms.txt content, selected resources, AI Search findings, plugin/theme inventory, server paths, credentials, prompts, conversations, logs or database contents.

After reaching Kairoseth, the administrator decides what contact, business or technical information to enter and submit. Kairoseth owns the request form, consent flow and final submission.

Service provider: Kairoseth  
Service URL: https://kairoseth.com/custom-requests  
Privacy policy: https://kairoseth.com/privacy

== Installation ==

1. Install the packaged plugin ZIP or plugin directory.
2. Activate **AI Search Optimizer**.
3. Open **Tools > AI Search Optimizer** to review the local readiness state, select public resources and preview llms.txt.
4. Validate and explicitly publish when ready.
5. Use public verification to confirm the published SHA-256.
6. Optionally open **Tools > AI Search Optimizer Support** for Kairoseth support or custom development.

The repository may contain unreleased development after the accepted 0.4.0 release-candidate source. Public distribution is claimed only when an explicit release or WordPress.org listing exists.

== Frequently Asked Questions ==

= Does the plugin guarantee citations in ChatGPT, Gemini, Claude or other AI systems? =

No. External providers decide how they crawl, index, retrieve and cite content.

= Is a Kairoseth account required? =

No. All accepted Free features work locally without a Kairoseth account. Kairoseth support/custom development is optional and begins only after an administrator explicitly opens the external request page.

= Does the plugin automatically send my website or llms.txt to Kairoseth? =

No. The local Free workflow does not send site content to Kairoseth. The optional support page makes no external request when loaded and does not automatically attach the site URL, llms.txt content, findings or administrator identity to its links.

= Does it require WooCommerce API keys? =

No. Public WooCommerce products are discovered from the local WordPress site and no WooCommerce consumer keys are required.

= What happens when I deactivate the plugin? =

Deactivation preserves the stored llms.txt deployment and the uninstall preference. The plugin's dynamic public llms.txt route is unavailable while the plugin is inactive.

= What happens when I uninstall the plugin? =

Under **Tools > AI Search Optimizer Data** you can choose whether uninstall preserves or deletes the stored llms.txt deployment. Preserve is the default. Uninstall always removes plugin setup/security state. Multisite cleanup runs site by site.

== Changelog ==

= 0.5.0-dev =
* Keeps the accepted local Free workflow independent from Kairoseth accounts and entitlements.
* Replaces the development cloud-onboarding surface with an optional contextual support/custom-development path.
* Adds a strict non-sensitive context allow-list for explicit navigation to Kairoseth Custom Requests.
* Adds WordPress.org policy checks to the development acceptance path.

= 0.4.0 =
* First standalone Free release-candidate line based on accepted connector 0.3.2.
* Added account-free local readiness, content selection, deterministic llms.txt generation/validation and safe publication with public SHA-256 verification.
* Added explicit uninstall data-retention controls and lifecycle cleanup.
* Added real WordPress 5.6/PHP 7.4 through WordPress 7.1/PHP 8.3 runtime acceptance.
* Added real Multisite isolation, WooCommerce 11.1.0 compatibility and EN/ES responsive browser acceptance.
