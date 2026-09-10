# Phase 3B — Contextual Support / Custom Development

Status: **accepted for merge; post-merge verification pending**  
Last reviewed: **10 September 2026**

## Goal

Adopt the same WordPress.org-first customer model accepted for Kairoseth AI Transparency:

```text
useful local Free plugin
→ explicit optional CTA
→ Kairoseth support / improvement / custom development
```

The Free plugin remains complete and usable without Kairoseth. This phase does not introduce trialware, license validation, remote entitlement, automatic lead creation or telemetry.

## WordPress surface

```text
Tools → AI Search Optimizer Support
capability: manage_options
```

The page is read-only with respect to the local AI Search workflow and performs no Kairoseth request when loaded.

## Explicit actions

```text
Improve with Kairoseth
requestType=implementation_support

Request custom development
requestType=business_customization
```

Both actions use the same verified destination:

```text
https://kairoseth.com/custom-requests
```

## Automatic context allow-list

```text
source=extension
extensionSlug=ai-search-optimizer
extensionName=AI Search Optimizer
extensionVersion=<real plugin version>
hostPlatform=wordpress
hostPlatformVersion=<real WordPress version>
locale=<en|es>
requestType=<accepted CTA type>
```

No other key is generated.

## Forbidden automatic transmission

The plugin does not automatically attach:

- site/home URL;
- llms.txt content or SHA-256;
- local content inventory or readiness findings;
- administrator/customer identity;
- WooCommerce products/orders/customers;
- plugin/theme inventory;
- server/filesystem paths;
- credentials, Application Passwords, API keys or tokens;
- prompts, conversations or customer content;
- logs/debug output;
- database contents or arbitrary WordPress options.

## Destination safety

The builder fails closed unless destination is exactly HTTPS `kairoseth.com/custom-requests` with no userinfo/password, custom port, preloaded query or fragment. Request type is also allow-listed.

## Kairoseth server authority

Kairoseth Platform independently allow-lists the extension slug and resolves the canonical extension name server-side. Unknown extensions lose extension context. A client-supplied extension name, site URL or arbitrary field cannot override that identity or choose the recipient mailbox.

Platform dependency acceptance:

```text
Kairoseth PR #224            merged
PR CI #936                   PASS
PR Production Smoke #127     PASS
merge SHA                    f70ff3a8968be757c1822d38ade32560a0857525
post-merge CI #937           PASS
post-merge Production #128   PASS
```

## WordPress.org boundary

The WordPress `readme.txt` documents the optional external service, exact circumstances under which navigation occurs, service URL, privacy policy and bounded context. The plugin does not contact Kairoseth on page load and does not use Kairoseth to license or unlock local functionality.

Official WordPress Plugin Check is a blocking CI dependency for Phase 3B. A green repository CI does not itself mean WordPress.org approval; external directory review remains separate.

## Engineering evidence

```text
PR #18                               open; accepted for merge
initial Plugin Check run             CI run 34514886969
initial Plugin Check job             102997803449
initial result                       FAIL — 29 findings (8 errors, 21 warnings)
recovery commit                      1d14c57da85f3db970a4d99a6bfe86e34ae09faa
recovery CI                          run #47 / 34516808280 — PASS
Plugin Check job                     103004221498 — PASS
Plugin Check                         PCP 2.1.0 — No errors found
runtime WP 5.6 / PHP 7.4             PASS
runtime WP 6.8 / PHP 8.2             PASS
runtime WP 7.1 / PHP 8.3             PASS
Multisite + WooCommerce              PASS
real browser EN/ES                   PASS
reproducible package                 PASS
package                              ai-search-optimizer-0.5.0-dev.zip
package bytes / entries              27455 / 13
package SHA-256                      2f2896031c72ce4ad8d561bd0d5c2a5820ec0ecd7e18c106250c9066683d80d7
blocking Phase 3B defects            0
```

## Retained failure diagnosis

The first official Plugin Check gate exposed a distribution-readiness defect set rather than one product-runtime regression. The findings were concentrated in WordPress output escaping, direct-file guards, recommended WordPress APIs, request nonce/sanitization ordering, uninstall namespace prefixing and release metadata consistency.

```text
pipeline/job   WordPress Plugin Check
job id         102997803449
result         FAIL
findings       29 total: 8 errors + 21 warnings
signature      wordpress-plugin-check/phase3b/29-findings
root cause     production package had not yet been normalized to the official WordPress.org Plugin Check contract
fix            strict ABSPATH guards; wp_strip_all_tags/wp_parse_url; nonce-before-data request flow; bounded sanitization; prefixed uninstall globals; Stable Tag aligned to plugin version; one documented exact-byte text/plain escape exception
validation     CI run #47 PASS; PCP 2.1.0 reports “No errors found”; all runtime/browser/package gates PASS
```

The `llms.txt` public response intentionally keeps one local `phpcs:ignore` on the final `echo $content`. The value has already passed stored SHA-256 integrity validation and is emitted as `text/plain`; HTML escaping would mutate the exact bytes and invalidate the published SHA-256 contract. No global Plugin Check warning/error suppression was introduced.

## Exit gates

```text
[x] static contextual-support contract PASS
[x] real browser EN/ES desktop/mobile PASS
[x] no support-page automatic external request
[x] exact query allow-list PASS
[x] hostile destination cases fail closed
[x] platform extension-context normalization accepted in production
[x] local Free regressions PASS
[x] WordPress/PHP runtime matrix PASS
[x] Multisite + WooCommerce PASS
[x] official WordPress Plugin Check PASS
[x] reproducible development package PASS
[x] PR CI PASS
[ ] post-merge CI PASS
[x] blockers = 0
```

Phase 3B is accepted for merge. It closes only after the merge reaches `main` and the post-merge CI passes without reopening a blocker.
