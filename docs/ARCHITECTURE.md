# AI Search Optimizer — Architecture

Status: **Standalone architecture baseline**  
Last reviewed: **10 September 2026**

## Boundaries

```text
WordPress / WooCommerce
└── AI Search Optimizer plugin
    ├── local public-content inspection
    ├── local llms.txt generation/validation (planned Free v1)
    ├── site-local llms.txt publication
    ├── WordPress identity / Multisite
    ├── least-privilege deployment capability
    └── optional authenticated Kairoseth connector

Kairoseth Platform
├── organization/product authorization
├── advanced whole-site analysis
├── Importance / AI Readiness
├── source-grounded curation/revisions
├── optional provider-neutral AI assistance
├── managed deployment orchestration
└── independent public verification
```

The plugin is independently releasable. `kairoseth-platform` must not be its build/runtime container.

## Imported compatibility contract

Standalone `0.4.0` starts from the accepted Kairoseth AI Web Readiness Connector `0.3.2`. To avoid breaking existing installations and the currently accepted Kairoseth Platform adapter, these internal identifiers remain unchanged during extraction:

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

They are compatibility identifiers, not the public product name. Any future protocol/name migration requires an explicit backward-compatible versioned contract.

## Security model

The imported connector exposes only authenticated `GET /connection`, `GET /deployment` and `PUT /deployment` operations and a public site-local `/llms.txt` representation.

Publication requires the dedicated WordPress capability. The payload is pinned to expected blog/network/home identity, content must match its SHA-256, and compare-and-set preconditions reject remote drift before mutation.

The plugin does not require FTP/SFTP, hosting-panel credentials, database credentials or WooCommerce consumer keys and does not perform arbitrary filesystem writes.

Kairoseth/provider secrets are never embedded in the plugin. Kairoseth tenant/product authority remains server-side.

## Multisite

The accepted `0.3.2` rule is preserved: `get_site()` is called only when Multisite is active. Identity includes `blogId`, `networkId`, `isMainSite`, `homeUrl`, `siteUrl`, REST URL and exact site-local `llms.txt` target.

Network activation initializes each site independently and future sites are initialized when the plugin is network-active.

## State and upgrade compatibility

The standalone plugin intentionally reuses the existing option/capability identifiers so an explicit replacement of the legacy connector can preserve compatible state. Automatic migration/update behavior is not yet declared release-ready and must be tested before 0.4.0 distribution.

Current deactivation behavior retains deployment data and the role/capability while removing setup/rewrite state. Final uninstall cleanup/retention semantics are a release blocker and must be made explicit before public availability.

## Free local architecture

The future local Free generator must use WordPress-owned public content and deterministic rules. It must not silently transmit content to Kairoseth or an AI provider. Cloud enhancement is opt-in and separately authorized.

## Diagnostics

Material failures must yield structured evidence: product/version, WordPress/PHP version, operation, primary error, normalized signature, root-cause status, safe recovery and validation. Credentials/private content are excluded.

## Packaging

Authoritative source lives in this repository. A release artifact must be produced by repository CI from a tagged source commit, contain only intended plugin files, and have a published checksum when releases begin.
