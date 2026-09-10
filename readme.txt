=== AI Search Optimizer ===
Contributors: emmakex
Tags: llms.txt, ai seo, ai search, geo, aeo
Requires at least: 5.6
Tested up to: 7.1
Requires PHP: 7.4
Stable tag: 0.5.0-dev
License: MIT
License URI: https://opensource.org/license/mit/

Prepare, validate and publish llms.txt from public WordPress content with a local-first AI Search workflow.

== Description ==

AI Search Optimizer is a local-first WordPress plugin for preparing, validating, publishing and verifying a site-local `llms.txt` from public WordPress content.

The Free workflow does not require a Kairoseth account and does not silently transmit site content to Kairoseth, AI providers or third-party analytics.

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
* Exact WordPress single-site / Multisite identity handling.
* Dedicated least-privilege deployment capability and role for the inherited managed connector contract.
* No FTP/SFTP, hosting-panel, database or WooCommerce API credentials.
* No silent telemetry or automatic marketing/support request.

AI Search Optimizer also includes an optional administrator-only support page. Nothing is sent to Kairoseth when that page loads. Only after an administrator deliberately clicks an action does the browser open the documented Kairoseth Custom Requests service with a bounded technical/product context.

The optional actions are:

* **Improve with Kairoseth** — implementation guidance or help improving the AI Search / llms.txt setup.
* **Request custom development** — tailored integrations, automation, workflows or additional functionality.

Kairoseth is not a license server, entitlement requirement or feature unlock for the local Free workflow.

AI Search Optimizer improves technical preparation and provides reproducible evidence. It does not guarantee rankings, indexing, crawling, citations, model ingestion or training inclusion by third-party search or AI providers.

== External services ==

The local Free workflow does not require an external service. Analysis, content selection, llms.txt generation, validation, publication and public verification run from the WordPress site.

**Kairoseth Custom Requests** is an optional support and custom-development service. It is contacted only after an administrator deliberately clicks **Improve with Kairoseth** or **Request custom development** under **Tools > AI Search Optimizer Support**. Loading that WordPress page itself makes no Kairoseth request.

The browser navigation goes to:

`https://kairoseth.com/custom-requests`

The plugin adds only this bounded context to the URL:

* source: `extension`;
* extension slug: `ai-search-optimizer`;
* extension name: `AI Search Optimizer`;
* installed plugin version;
* host platform: `wordpress`;
* installed WordPress version;
* bounded English/Spanish locale;
* the administrator-selected bounded request type.

The plugin does **not** automatically attach or transmit the site URL, administrator or customer identity, llms.txt content or hash, content inventory, readiness findings, WooCommerce content, plugin/theme inventory, credentials, passwords, tokens, prompts, conversations, logs, database contents or arbitrary WordPress options.

After reaching Kairoseth, the administrator decides what contact, company, website and request information to enter and submit. Kairoseth owns the request form, its consent flow and final submission.

Service provider: Kairoseth  
Service URL: https://kairoseth.com/custom-requests  
Privacy policy: https://kairoseth.com/privacy

The plugin retains an authenticated WordPress REST connector for optional managed Kairoseth publication compatibility. That connector does not initiate outbound communication by itself; a separately configured external client must authenticate to WordPress and call it.

== Installation ==

1. Upload the plugin directory or an accepted packaged ZIP.
2. Activate **AI Search Optimizer**.
3. Open **Tools > AI Search Optimizer**.
4. Review local readiness and eligible public content.
5. Select resources and preview the deterministic llms.txt.
6. Publish explicitly when validation passes.
7. Verify the public llms.txt and SHA-256 result.
8. Optionally open **Tools > AI Search Optimizer Support** for improvement help or custom development.

`0.4.0` is the accepted standalone Free release candidate preserved by the repository. The current repository development line is `0.5.0-dev`; no WordPress.org availability is claimed until a later stable package passes the directory submission gates and is approved by WordPress.org.

== Frequently Asked Questions ==

= Is a Kairoseth account required? =

No. The local Free workflow works without a Kairoseth account. Kairoseth support/custom-development navigation is optional and begins only after an administrator deliberately clicks a link.

= Does the plugin automatically send my site or llms.txt to Kairoseth? =

No. The local workflow and support-page load make no automatic Kairoseth request. The optional support links contain only the bounded technical/product context documented in the External services section. Site URL, llms.txt content/hash and administrator identity are not attached automatically.

= Does the plugin guarantee citations in ChatGPT, Gemini, Claude or other AI systems? =

No. External providers decide how they crawl, index, retrieve and cite content.

= Does it require WooCommerce API keys? =

No. Public WooCommerce products are discovered from the local WordPress site. WooCommerce consumer keys are not required.

= What happens when I deactivate the plugin? =

Deactivation preserves the stored llms.txt deployment and the uninstall preference. The plugin's dynamic public llms.txt route is unavailable while the plugin is inactive.

= What happens when I uninstall the plugin? =

Under **Tools > AI Search Optimizer Data** you can choose whether uninstall preserves or deletes the stored llms.txt deployment. Preserve is the default. Uninstall always removes the plugin setup marker, custom deployer role, administrator capability and retention preference. Multisite cleanup runs site by site.

== Changelog ==

= 0.5.0-dev =
* Replaced the cloud-onboarding-oriented WordPress admin surface with an optional local-first support/custom-development bridge.
* Added explicit **Improve with Kairoseth** and **Request custom development** actions.
* Added a strict server-owned support-context allow-list and fail-closed canonical Kairoseth destination validation.
* Support page load makes no external request and automatically sends no site URL, llms.txt content/hash, identity, credentials, WooCommerce content, logs or telemetry.
* Added official WordPress Plugin Check to the blocking CI path for WordPress.org readiness.
* Preserved the inherited REST connector protocol without making it a Free-feature entitlement or mandatory onboarding path.

= 0.4.0 =
* First standalone Free release-candidate line based on accepted connector 0.3.2.
* Added account-free local readiness, content selection, deterministic llms.txt generation/validation and safe publication with public SHA-256 verification.
* Added explicit uninstall data-retention controls and lifecycle cleanup.
* Added real WordPress 5.6/PHP 7.4 through WordPress 7.1/PHP 8.3 runtime acceptance.
* Added real Multisite isolation, WooCommerce 11.1.0 compatibility and EN/ES responsive browser acceptance.
