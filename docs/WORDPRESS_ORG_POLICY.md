# AI Search Optimizer — WordPress.org Distribution Policy

Status: **canonical engineering and product-distribution policy**  
Last reviewed: **10 September 2026**

This policy adopts the same local-first distribution model already accepted for `Emmakex/AI-Transparency` and applies it to AI Search Optimizer.

## Product model

```text
Free plugin
  complete useful local functionality
  no Kairoseth account required
  no local paid-feature locks
  no trial expiry or quota

Optional CTA
  explicit administrator action only
  no external request on WordPress page load
  bounded non-sensitive product/platform context only

Custom development / improvement
  external Kairoseth Custom Requests form
  user decides what business/personal/technical data to submit
```

Kairoseth is not a license server, entitlement provider or feature-unlock dependency for accepted Free functionality.

## WordPress.org rules treated as blocking

Before a public directory submission or update, the package must satisfy the current WordPress.org Detailed Plugin Guidelines and the official Plugin Check `plugin_repo` category. In this repository the security, accessibility and performance Plugin Check categories are also blocking engineering gates.

The implementation must preserve these boundaries:

- all distributed code/assets use GPL-compatible licensing; MIT remains acceptable unless the license strategy is deliberately changed;
- the complete Free plugin is available in the submitted package;
- no trialware, expiry, quota or paid unlock for functionality implemented locally in the directory plugin;
- optional external services provide real external value and are described clearly in `readme.txt`;
- no tracking, telemetry or external request without explicit authorized user action/consent;
- no remote executable-code delivery or non-WordPress update mechanism;
- no public-site credits/external links enabled without user opt-in;
- no dashboard hijacking, persistent advertising or non-contextual nags;
- any CTA/upsell is limited to the plugin's own contextual administration surface;
- `readme.txt` is written for users, uses no keyword stuffing and keeps at most five tags;
- plugin version and WordPress.org stable-release metadata are aligned for every actual release;
- the submission package is complete and functional at review time;
- plugin naming, third-party code, assets and dependencies respect copyright/trademark and compatible licensing.

Official references:

- `https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/`
- `https://developer.wordpress.org/plugins/wordpress-org/common-issues/`
- `https://wordpress.org/plugins/plugin-check/`

## External-service boundary

Canonical optional destination:

```text
https://kairoseth.com/custom-requests
```

Loading **Tools → AI Search Optimizer Support** performs zero Kairoseth requests.

Only an explicit CTA click may navigate the browser externally. The URL allow-list is:

```text
source
extensionSlug
extensionName
extensionVersion
hostPlatform
hostPlatformVersion
locale
requestType
```

Accepted request types for the WordPress UI:

```text
implementation_support
business_customization
```

Automatically forbidden context includes:

```text
site/home URL
administrator/customer identity
llms.txt body
selected resource URLs/content
readiness findings
stored deployment body/hash
WordPress users
plugin/theme inventory
WooCommerce customer/order data
credentials/API keys/Application Passwords/tokens
cookies/nonces/session identifiers
prompts/conversations/logs
server paths/IP/database contents
arbitrary WordPress options
```

If Kairoseth needs any such information for support, the user chooses whether to provide it after arriving on the external form.

## CI/release baseline

The minimum blocking release baseline is modeled on AI Transparency and must include:

1. PHP syntax across the supported PHP range.
2. Contract/security regressions.
3. Free local analysis/publication/lifecycle regressions.
4. 100% EN/ES customer-facing acceptance for the plugin surfaces in scope.
5. Official WordPress Plugin Check with at least:
   - `plugin_repo`
   - `security`
   - `accessibility`
   - `performance`
6. Real packaged WordPress runtime acceptance.
7. Representative minimum/current PHP and WordPress combinations.
8. Real Multisite isolation/lifecycle acceptance.
9. WooCommerce runtime acceptance where WooCommerce support is claimed.
10. Real responsive/accessibility browser acceptance.
11. Upgrade/uninstall/data-retention acceptance before stable public release.
12. Reproducible ZIP + checksum + manifest evidence.
13. Feature branch → PR → green CI → merge → post-merge verification.

WordPress Coding Standards, PHPCompatibility and compiled gettext EN/ES parity are target parity items inherited from the AI Transparency release baseline and must be closed before directory submission if not already enforced by the current repository toolchain.

## Public claims

Allowed:

- prepares public WordPress content for AI/search consumption;
- generates and validates deterministic source-grounded `llms.txt`;
- publishes and verifies the artifact under explicit administrator control;
- reports technical readiness/evidence under documented checks.

Not allowed:

- guaranteed ranking;
- guaranteed citation by ChatGPT, Gemini, Claude, Copilot, Perplexity, AI Overviews or another provider;
- guaranteed crawling/indexing/model ingestion/training inclusion;
- provider endorsement;
- legal/compliance certification unless independently established for a specifically scoped feature.

## Release truth

A green CI or accepted internal release candidate does not mean WordPress.org availability.

The repository may claim `Available on WordPress.org` only after WordPress.org independently approves the plugin and the public directory listing is live.
