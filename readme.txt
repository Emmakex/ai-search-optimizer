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

AI Search Optimizer is being developed as a WordPress-first AI Search and llms.txt optimization extension.

The 0.4.0 source baseline preserves the least-privilege WordPress publishing connector already validated by Kairoseth on real single-site and Multisite installations. It provides the secure connector foundation while the standalone Free workflow is developed.

Current foundation capabilities include:

* Site-local llms.txt serving.
* SHA-256 integrity checking before serving deployed content.
* Exact WordPress single-site / Multisite identity reporting.
* Dedicated least-privilege deployment capability and role.
* Authenticated namespaced REST connection/deployment endpoints.
* Compare-and-set protection against remote deployment drift.
* Idempotent same-hash deployment behavior.
* WooCommerce detection without WooCommerce API keys.

The planned Free release will add useful account-free local readiness checks, public-content selection, deterministic llms.txt generation/validation and task-oriented English/Spanish WordPress UI before the plugin is declared publicly available.

Optional Kairoseth services may provide advanced site analysis, AI Search readiness evidence, curation, history, optional AI assistance and managed publication verification. Cloud functionality is not permitted to silently grant roles or transmit provider credentials through the plugin.

AI Search Optimizer improves preparation and provides evidence. It does not guarantee rankings, indexing, crawling, citations, model ingestion or training inclusion by third-party search/AI providers.

== Installation ==

0.4.0 is not released yet. Installation instructions will be finalized together with the first accepted package and upgrade/uninstall policy.

== Frequently Asked Questions ==

= Does the plugin guarantee citations in ChatGPT, Gemini, Claude or other AI systems? =

No. External providers decide how they crawl, index, retrieve and cite content.

= Does it require WooCommerce API keys? =

No. The inherited WordPress connector contract does not use WooCommerce consumer keys.

= Is a Kairoseth account required? =

The planned Free local workflow will not require a Kairoseth account. Optional connected features may require authenticated Kairoseth access.

== Changelog ==

= 0.4.0 =
* Unreleased standalone product foundation based on accepted connector 0.3.2.
