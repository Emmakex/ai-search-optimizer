# Phase 3B — Contextual Support / Custom Improvement Acceptance

Status: **implementation in progress — not yet accepted**  
Last reviewed: **10 September 2026**

## Goal

Adopt the WordPress.org-first extension model already accepted for `Emmakex/AI-Transparency`:

```text
complete local Free functionality
+ optional contextual support CTA
+ optional custom development/improvement CTA
```

Kairoseth must not become a license, entitlement, trial, quota or feature-unlock dependency for accepted Free functionality.

## Blocking acceptance contract

```text
[ ] Tools → AI Search Optimizer Support exists in EN/ES
[ ] page requires administrator authority
[ ] page load performs zero Kairoseth requests
[ ] page does not mutate AI Search Optimizer state
[ ] support CTA is explicit and user initiated
[ ] custom-development CTA is explicit and user initiated
[ ] destination is exactly https://kairoseth.com/custom-requests
[ ] destination validation fails closed for non-HTTPS/foreign/wrong-path/query/fragment/userinfo/port variants
[ ] requestType is allow-listed
[ ] query keys match the exact bounded allow-list
[ ] site/home URL is not automatically transmitted
[ ] administrator/customer identity is not automatically transmitted
[ ] llms.txt body/resources/findings are not automatically transmitted
[ ] WooCommerce customer/order data is not automatically transmitted
[ ] credentials/Application Passwords/tokens are not automatically transmitted
[ ] prompts/conversations/logs/database/options are not automatically transmitted
[ ] links use noopener + noreferrer
[ ] no automatic lead submission from WordPress
[ ] no tracking/telemetry/click tracking
[ ] no dashboard-wide advertising/nags introduced
[ ] local Free workflow remains independent and green
[ ] real Chromium EN/ES desktop/mobile acceptance PASS
[ ] official WordPress Plugin Check PASS
[ ] WordPress/PHP runtime matrix PASS
[ ] Multisite + WooCommerce runtime PASS
[ ] reproducible development package PASS
[ ] PR CI PASS
[ ] post-merge CI PASS
[ ] blocking defects = 0
```

## Exact context allow-list

```text
source=extension
extensionSlug=ai-search-optimizer
extensionName=AI Search Optimizer
extensionVersion=<real plugin version>
hostPlatform=wordpress
hostPlatformVersion=<real WordPress version>
locale=<en|es>
requestType=<allow-listed value>
```

WordPress UI request types:

```text
implementation_support
business_customization
```

## Explicit non-goals

```text
cloud-account onboarding inside WordPress
remote license activation
paid local feature gates
trial expiry or usage quota
automatic site registration
automatic site URL transmission
server-to-server lead creation from WordPress
automatic diagnostic upload
telemetry/click tracking
CRM synchronization from WordPress
in-plugin chat
```

## Historical Phase 3A

Phase 3A connection-readiness was technically accepted as a development experiment. It is superseded before public release and is not the WordPress.org-facing customer model.

The `kairoseth-platform` coordinated onboarding PR #223 was closed without merge after this strategy decision.

## Exit

Phase 3B can close only after the exact implementation is green on the PR head and again after merge to `main`.
