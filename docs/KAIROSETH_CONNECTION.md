# AI Search Optimizer — Kairoseth Boundary

Status: **WordPress.org-first local Free product; Kairoseth support/custom path is optional**  
Last reviewed: **10 September 2026**

## Canonical customer model

The standalone WordPress plugin is useful on its own. Kairoseth is **not** required to analyze, generate, validate, publish or publicly verify `llms.txt`.

The WordPress.org-facing product model is:

```text
Free local plugin
→ complete AI Search + llms.txt workflow

Optional administrator CTA
→ Kairoseth support
→ custom improvement / development
```

The accepted customer-facing Kairoseth destination is:

```text
https://kairoseth.com/custom-requests
```

Loading the WordPress support page performs no external request. The browser navigates to Kairoseth only after an explicit administrator action.

## Bounded support context

Only this context may be placed in an explicit external-navigation URL:

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

WordPress UI request types are limited to:

```text
implementation_support
business_customization
```

The plugin does not automatically transmit:

```text
site/home URL
administrator/customer identity
llms.txt content or hash
selected resources/content
AI Search findings
WordPress users
plugin/theme inventory
WooCommerce customer/order data
credentials/API keys/Application Passwords/tokens
cookies/nonces/session identifiers
prompts/conversations/logs
server paths/IP/database contents
arbitrary WordPress options
```

If support or custom development requires additional information, the user decides whether to provide it after reaching Kairoseth.

## Historical managed-connector compatibility

The standalone source was extracted from the accepted Kairoseth AI Web Readiness Connector. The following internal protocol remains for backward compatibility with existing Kairoseth Platform deployments:

```text
namespace                 kairoseth-ai-web-readiness/v1
GET                       /connection
GET                       /deployment
PUT                       /deployment
capability                kairoseth_ai_web_readiness_deploy
connector schema          2
site pin                  blogId + networkId + exact homeUrl
safe mutation pre-state   expectedCurrentDeployed + expectedCurrentContentHash
public target             exact site-local /llms.txt
```

These are **compatibility identifiers**, not the WordPress.org commercial path and not an entitlement mechanism.

The inherited managed contract may continue to serve existing authorized Kairoseth Platform installations. Removing or renaming it requires a separate versioned backward-compatibility decision and migration evidence.

## Superseded Phase 3A experiment

The `0.5.0-dev` line previously implemented an optional **Tools → AI Search Optimizer · Kairoseth** readiness screen. It was technically accepted as a development experiment and proved that a connection surface could remain non-authoritative and silent on page load.

That customer-facing direction is now **superseded before public release**. The evidence remains historical; the screen is not part of the intended WordPress.org product experience.

Likewise, `kairoseth-platform` PR #223 for coordinated cloud onboarding was intentionally closed without merge. No production dependency on that proposed route was introduced.

## Authority boundary

Even where the inherited managed connector remains usable:

- WordPress cannot grant Kairoseth organization/product roles or entitlements;
- browser/client/model state cannot grant cloud authority;
- provider/Kairoseth credentials are never embedded in the plugin;
- managed deployment must preserve exact site pin and compare-and-set semantics;
- Kairoseth unavailability must not disable accepted local Free functionality.

## WordPress.org boundary

The plugin must not become trialware, a remote-license shell or a cloud-account gate. Optional Kairoseth interaction must remain explicit, contextual, documented and separate from the complete local Free workflow.

Canonical policy: [`WORDPRESS_ORG_POLICY.md`](WORDPRESS_ORG_POLICY.md).  
Current Phase 3 acceptance: [`PHASE3B_ACCEPTANCE.md`](PHASE3B_ACCEPTANCE.md).
