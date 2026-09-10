# AI Search Optimizer — Optional Kairoseth connection

Status: **Phase 3A implementation in progress**  
Last reviewed: **10 September 2026**

## Purpose

The standalone WordPress plugin is useful without Kairoseth. Phase 3 adds an optional path into Kairoseth AI Search Optimizer for customers who want advanced whole-site analysis, evidence, curation, revision history, optional AI assistance or managed publication verification.

Phase 3 must not turn the WordPress plugin into a second cloud authorization system.

## Existing accepted platform contract

The current Kairoseth Platform already owns the managed WordPress connection. The platform:

1. resolves the authenticated Kairoseth user, organization and `ai-web-readiness` product access server-side;
2. accepts a dedicated WordPress username + Application Password from an authorized Kairoseth operator;
3. calls the plugin's authenticated connection endpoint;
4. validates the exact WordPress site identity;
5. encrypts the WordPress credential server-side using organization/product/site/adapter/credential context;
6. uses the stored site pin and credential for later inspect/deploy operations;
7. uses compare-and-set pre-state and independent public SHA-256 verification for managed publication.

Current WordPress protocol:

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

The public product name is AI Search Optimizer, but these inherited technical identifiers remain intentionally stable for Kairoseth Platform compatibility.

## Phase 3A — connection readiness + guided handoff

The WordPress side adds an EN/ES page under **Tools → AI Search Optimizer · Kairoseth**.

It may read only local WordPress state needed to explain readiness:

- exact WordPress `homeUrl`;
- Multisite Blog ID / Network ID;
- inherited REST connection endpoint;
- site-local `llms.txt` target;
- whether the home URL is HTTPS;
- whether WordPress reports native Application Passwords as available;
- whether the dedicated deployer role retains the inherited deployment capability.

### Non-authority boundary

The plugin must not infer or store Kairoseth connection authority.

`Ready to connect` means only that the local WordPress prerequisites are satisfied. It does **not** mean:

- a Kairoseth account exists;
- the current WordPress user has Kairoseth access;
- an organization/product entitlement exists;
- Kairoseth has validated the site;
- a WordPress credential is already stored in Kairoseth.

Those facts remain server-authoritative in Kairoseth.

### Handoff boundary

The Phase 3A handoff is deliberately simple:

```text
https://kairoseth.com/app
```

The URL contains no query string or fragment carrying site identity, username, Application Password, token, organization or product authority. Kairoseth resolves the authenticated account and permitted contexts after navigation.

The plugin makes **no automatic network request to Kairoseth**. Navigation occurs only after the user activates the external link.

### Credential boundary

Phase 3A does not collect, generate, transmit or persist a WordPress Application Password. The accepted platform workflow remains:

```text
WordPress administrator
→ dedicated Kairoseth AI Web Deployer user
→ WordPress Application Password
→ authorized Kairoseth workspace form
→ Kairoseth backend validation
→ encrypted server-side credential storage
```

If a managed connection is later deleted in Kairoseth, the operator should also revoke its WordPress Application Password.

## Phase 3A acceptance gates

```text
[ ] current source line is 0.5.0-dev and accepted 0.4.0 identity is preserved
[ ] inherited schema/REST/capability/deployment state remains unchanged
[ ] EN/ES connection-readiness screen exists
[ ] HTTPS prerequisite is evaluated locally
[ ] native Application Password availability is evaluated locally
[ ] least-privilege role/capability prerequisite is evaluated locally
[ ] exact WordPress identity and inherited connection endpoint are shown
[ ] Ready wording is explicitly non-authoritative
[ ] no automatic Kairoseth request occurs
[ ] no Kairoseth token/session/role/entitlement is stored locally
[ ] no Application Password is collected/stored by the readiness page
[ ] handoff URL contains no site/credential/organization data
[ ] external handoff uses noopener+noreferrer
[ ] accepted local Free workflow remains independent and green
[ ] real browser EN/ES desktop/mobile acceptance covers the new screen
[ ] WordPress/PHP + Multisite/WooCommerce regression remains green
[ ] reproducible development package evidence PASS
[ ] blocking Phase 3A defects = 0
```

## Phase 3B — coordinated connection UX — blocked by 3A

After Phase 3A is accepted, improve the Kairoseth-side onboarding so the user can move from the WordPress readiness screen to the correct authorized site workflow with fewer manual steps **without** introducing browser-authoritative access or a second authentication protocol.

Any proposed one-time pairing or prefill mechanism must be separately specified and threat-modeled before implementation. It must not weaken the accepted Application Password/site-pin/server-authorization model.

## Failure behavior

Kairoseth unavailability must never disable:

- local readiness analysis;
- local content inventory/selection;
- deterministic `llms.txt` generation/validation;
- explicit local publication;
- local public verification;
- uninstall/data-retention behavior.

The optional cloud path fails independently and safely.
