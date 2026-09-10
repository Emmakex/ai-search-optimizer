# AI Search Optimizer — Architecture

Status: **Standalone local-first WordPress architecture**  
Last reviewed: **10 September 2026**

## Product boundary

```text
WordPress / WooCommerce
└── AI Search Optimizer plugin
    ├── local public-content inspection
    ├── local deterministic llms.txt generation/validation
    ├── explicit site-local llms.txt publication
    ├── independent public SHA-256 verification
    ├── WordPress single-site / Multisite isolation
    ├── WooCommerce public-product awareness
    ├── lifecycle / data-retention controls
    ├── optional contextual support/custom-development links
    └── inherited managed REST compatibility contract

Kairoseth
└── optional external support/custom requests
    ├── user-initiated browser navigation only
    ├── bounded non-sensitive product/platform context
    └── user-controlled request/contact information
```

The plugin is independently releasable and useful without Kairoseth. `kairoseth-platform` is not its build/runtime container, license authority or feature-unlock service.

## Local Free architecture

The accepted Free workflow reads WordPress-owned public content and local WordPress state:

```text
readiness inspection
→ eligible public-content inventory
→ explicit resource selection
→ deterministic source-grounded llms.txt build
→ validation
→ explicit publish
→ local storage integrity check
→ independent public read-back
→ exact SHA-256 verification
```

No AI provider is required. No site content is silently transmitted to Kairoseth or analytics services.

## Optional contextual support architecture

The WordPress.org-facing external path is deliberately small:

```text
administrator
→ Tools → AI Search Optimizer Support
→ page load remains local
→ explicit support/custom CTA
→ browser opens https://kairoseth.com/custom-requests
→ only bounded allow-listed technical/product context is present
→ user chooses what additional information to submit
```

Allowed automatic context:

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

No site URL, administrator identity, `llms.txt` body/resources/findings, WooCommerce customer/order data, credentials, logs or database content is attached automatically.

## Imported compatibility contract

The standalone line originated from accepted Kairoseth AI Web Readiness Connector `0.3.2`. To preserve existing installations and the accepted Kairoseth Platform adapter, these internal identifiers remain stable until a separately accepted versioned migration exists:

```text
REST namespace: kairoseth-ai-web-readiness/v1
capability: kairoseth_ai_web_readiness_deploy
role: kairoseth_ai_web_deployer
deployment option: kairoseth_ai_web_readiness_deployment
setup option: kairoseth_ai_web_readiness_setup_version
query var: kairoseth_ai_web_readiness_llms
connector schema: 2
connection response plugin id: kairoseth-ai-web-readiness
```

They are compatibility identifiers, not the public product identity and not part of the WordPress.org CTA model.

The compatibility API exposes authenticated `GET /connection`, `GET /deployment` and `PUT /deployment`. Managed mutation requires the dedicated capability, exact blog/network/home pin, content SHA-256 and compare-and-set preconditions.

## WordPress authority and security

- WordPress capability checks gate local publication/admin operations.
- Explicit state-changing admin actions are nonce protected.
- Public `llms.txt` content is served only when stored content matches its SHA-256.
- Local public verification performs a separate HTTP read-back with redirects disabled.
- No FTP/SFTP, hosting-panel, database or WooCommerce consumer credentials are required.
- Provider/Kairoseth production secrets are never embedded in the plugin.
- Browser/plugin/model output cannot grant Kairoseth roles or entitlements.
- Optional support navigation is not a remote license or cloud-account dependency.

## Multisite

`get_site()` is used only when Multisite is active. Site identity remains site-local and includes Blog ID, Network ID, main-site state, WordPress home/site URLs, REST root and the local `llms.txt` target.

Network activation initializes existing sites and initializes future sites when the plugin is network-active. Deployment and uninstall retention state remain isolated per blog/site.

## Lifecycle and data retention

Deactivation preserves deployment data and the uninstall preference while removing active rewrite/setup behavior.

On uninstall the administrator-selected site-local policy controls deployment retention:

```text
preserve  default — retain stored llms.txt deployment for recovery
 delete             remove stored llms.txt deployment
```

Uninstall always removes plugin setup/security state, administrator deployment capability, custom deployer role and retention preference. Multisite cleanup runs site by site.

## Internationalization and UX

Customer-facing WordPress functionality ships EN/ES together. Release hardening includes real browser acceptance for desktop/mobile layouts and accessible controls. WordPress.org compliance parity additionally requires the official Plugin Check and the release-engineering gates defined in [`WORDPRESS_ORG_POLICY.md`](WORDPRESS_ORG_POLICY.md).

## Diagnostics

Material failures must yield structured evidence: product/version, WordPress/PHP version, operation, primary error, normalized signature, root-cause status, safe recovery and validation. Credentials/private content are excluded.

## Packaging

Authoritative source lives in this repository. CI builds the packaged plugin from source, verifies intended package contents and requires reproducible package/checksum evidence. A public stable release must be tied to an exact accepted source commit/tree and must not be claimed as WordPress.org available until the external directory listing is live.
