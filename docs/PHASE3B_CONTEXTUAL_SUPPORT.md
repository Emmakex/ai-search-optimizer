# Phase 3B — Contextual Support / Custom Development

Status: **implementation in progress**  
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

Official WordPress Plugin Check is added as a blocking CI dependency for Phase 3B. A green repository CI does not itself mean WordPress.org approval; external directory review remains separate.

## Exit gates

```text
[ ] static contextual-support contract PASS
[ ] real browser EN/ES desktop/mobile PASS
[ ] no support-page automatic external request
[ ] exact query allow-list PASS
[ ] hostile destination cases fail closed
[ ] platform extension-context normalization accepted in production
[ ] local Free regressions PASS
[ ] WordPress/PHP runtime matrix PASS
[ ] Multisite + WooCommerce PASS
[ ] official WordPress Plugin Check PASS
[ ] reproducible development package PASS
[ ] PR CI PASS
[ ] post-merge CI PASS
[ ] blockers = 0
```

Phase 3B remains open until those gates are verified.
