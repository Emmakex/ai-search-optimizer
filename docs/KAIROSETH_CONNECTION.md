# AI Search Optimizer — Optional Kairoseth services

Status: **Local Free is authoritative; contextual support/custom-development is the active optional path; managed connector compatibility is retained but not required**  
Last reviewed: **10 September 2026**

## Product boundary

AI Search Optimizer is useful without Kairoseth. Its accepted local Free workflow does not require a Kairoseth account, license, entitlement or remote activation.

The primary optional Kairoseth path follows the same model accepted for Kairoseth AI Transparency:

```text
use local Free plugin
→ explicit administrator CTA if help/custom work is wanted
→ Kairoseth Custom Requests
→ user decides what information to submit
```

The WordPress plugin does not automatically create leads, send telemetry, transmit the site URL or upload local AI Search state.

## Contextual support/custom-development path

WordPress surface:

```text
Tools → AI Search Optimizer Support
capability: manage_options
```

Actions:

```text
Improve with Kairoseth
→ requestType=implementation_support

Request custom development
→ requestType=business_customization
```

Canonical destination:

```text
https://kairoseth.com/custom-requests
```

Page load remains local. Network navigation begins only after an administrator deliberately activates one of the CTAs.

### Automatic context allow-list

The plugin may add only:

```text
source=extension
extensionSlug=ai-search-optimizer
extensionName=AI Search Optimizer
extensionVersion=<real plugin version>
hostPlatform=wordpress
hostPlatformVersion=<real WordPress version>
locale=<en|es>
requestType=<accepted action>
```

The plugin must not automatically attach:

```text
site URL / home URL
llms.txt content or SHA-256
eligible-content inventory
readiness findings
administrator/customer identity
WooCommerce product/order/customer data
plugin/theme inventory
filesystem/server paths
IP address
cookies/nonces/session data
credentials/Application Passwords/API keys/tokens
prompts/conversations/customer content
logs/debug output
database contents
arbitrary WordPress options
```

Kairoseth re-normalizes the extension slug against a server-owned allow-list and supplies the canonical product name. Browser/plugin query values cannot choose an arbitrary extension identity or recipient mailbox.

### Destination safety

The plugin accepts only the exact HTTPS host/path above. HTTP, foreign/lookalike host, wrong path, URL userinfo/password, custom port, pre-existing query and fragments fail closed.

### Local independence

If Kairoseth is unavailable, these functions remain available:

```text
local readiness analysis
content inventory/selection
deterministic llms.txt generation/validation
explicit local publication
independent public verification
data-retention/uninstall controls
```

## Inherited managed connector compatibility

The existing authenticated WordPress REST connector is retained for separately configured managed integrations. It does not initiate outbound communication by itself and is not the primary WordPress.org customer flow.

Protocol:

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

When Kairoseth Platform is separately configured to use that connector, the platform remains authoritative for authenticated user/organization/product access, validates exact WordPress site identity, encrypts the WordPress credential server-side and performs compare-and-set/public-hash verification.

The distributed plugin contains no Kairoseth production credential and does not grant cloud roles or entitlements.

## Historical Phase 3A

Phase 3A previously added a local connection-readiness admin screen. Its security findings remain useful: no automatic request, no local Kairoseth token storage and no browser-authoritative cloud access. Its acceptance evidence is retained in [`PHASE3A_ACCEPTANCE.md`](PHASE3A_ACCEPTANCE.md).

That screen is superseded as the primary customer CTA by the WordPress.org-first contextual support/custom-development model. The technical REST compatibility it documented remains unchanged.

## Current acceptance gates

```text
[ ] support page ships EN/ES
[ ] page load makes zero Kairoseth request
[ ] Improve with Kairoseth CTA is explicit
[ ] Request custom development CTA is explicit
[ ] exact support context allow-list enforced
[ ] site URL/content/hash/user/credentials are absent from automatic context
[ ] exact HTTPS destination validation fails closed
[ ] external links use noopener+noreferrer
[ ] Kairoseth server re-normalizes extension identity
[ ] local Free remains independent and fully usable
[ ] inherited REST connector contract remains unchanged
[ ] readme.txt documents the optional external service plainly
[ ] official WordPress Plugin Check PASS
[ ] real browser EN/ES desktop/mobile acceptance PASS
[ ] WordPress/PHP + Multisite/WooCommerce regressions PASS
[ ] reproducible development package PASS
[ ] PR CI + post-merge CI PASS
[ ] blocking defects = 0
```
