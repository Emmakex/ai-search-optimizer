# Security Policy

AI Search Optimizer is a local-first WordPress extension that prepares and can publish site-local AI Search artifacts. Optional Kairoseth interaction is limited to explicit support/custom-development navigation and is not required for accepted Free functionality.

## Supported versions

`0.4.0` is the accepted standalone Free release candidate and remains identified by its accepted source commit/tree/package SHA-256. It is not yet claimed as publicly distributed through GitHub Releases or WordPress.org.

`0.5.0-dev` is the current development line. It is not a release candidate or public release. Development packages must remain reproducible and must not overwrite or redefine the accepted 0.4.0 package identity.

A new blocking security finding affecting an accepted candidate before public distribution must reopen the relevant acceptance decision.

## Reporting a vulnerability

Please do not disclose suspected vulnerabilities in a public issue before maintainers have had an opportunity to assess them. Use GitHub's private vulnerability/security reporting channel for this repository when available, or contact the repository owner privately through GitHub.

Include only the minimum evidence needed to reproduce the issue. Never post real Application Passwords, authorization headers, Kairoseth/provider secrets, customer private content or production credentials.

## Security invariants

- no provider/Kairoseth production secrets in distributed plugin code;
- no FTP/SFTP, hosting-panel or database credentials required;
- WooCommerce consumer keys are not required for local Free behavior;
- WordPress publication uses a dedicated capability and least-privilege identity;
- explicit local publication and retention-setting changes are nonce protected;
- exact blog/network/home identity is checked before inherited managed mutation;
- content SHA-256 is verified before storage/serving;
- compare-and-set expected remote state prevents silent overwrite after drift;
- local public verification performs an independent read-back and does not follow redirects;
- browser/plugin/model-controlled state cannot grant Kairoseth roles or entitlements;
- local Free functionality is not gated by a remote license, account, trial or quota;
- external support/custom interaction is explicit and documented;
- uninstall performs no outbound network requests and no arbitrary filesystem writes.

## Optional contextual support/custom development

The WordPress.org-facing model follows the accepted AI Transparency extension pattern.

**Tools → AI Search Optimizer Support** is local and read-only with respect to AI Search Optimizer state. Loading it performs no Kairoseth request.

Only an explicit administrator action may open:

```text
https://kairoseth.com/custom-requests
```

The generated external URL is limited to these keys:

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

Accepted WordPress request types are:

```text
implementation_support
business_customization
```

The plugin does **not** automatically include or transmit:

```text
site/home URL
administrator/customer identity
llms.txt body
selected resources/content
AI Search findings
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

If support requires any such information, the user chooses whether to provide it on the external Kairoseth form.

Kairoseth is not a license server, entitlement dependency or feature-unlock requirement for the Free plugin.

The earlier Phase 3A connection-readiness page was an accepted development experiment but is superseded before stable/public release. The inherited `kairoseth-ai-web-readiness/v1` REST contract remains only for backward compatibility unless separately removed through a versioned compatibility decision.

## Data retention and uninstall

Deactivation preserves the stored `llms.txt` deployment and uninstall preference.

The uninstall preference is site-local and accepts only two normalized values:

- `preserve` — default; keep the stored deployment so it can be recovered after reinstall;
- `delete` — permanently delete the stored deployment during uninstall.

Uninstall always removes the plugin setup marker, retention preference, custom deployer role and administrator deployment capability. In Multisite this cleanup is performed site by site. The dynamic public `/llms.txt` route is unavailable while the plugin is inactive or removed even when deployment data is preserved.

See [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md).

## WordPress.org security boundary

WordPress.org policy compliance is blocking before public directory submission. The repository CI must run the official WordPress Plugin Check and preserve the local-first/no-silent-transmission boundary.

See [`docs/WORDPRESS_ORG_POLICY.md`](docs/WORDPRESS_ORG_POLICY.md).

## Release integrity

The accepted `0.4.0` release-candidate package is identified by:

```text
source commit      4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree        472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256    27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

The repository build process normalizes package metadata. Release-candidate acceptance requires a byte-reproducible package with a release manifest; development uses a separate reproducible development manifest/artifact so later code cannot be confused with the accepted 0.4.0 candidate.

See [`docs/PHASE2C4_CLOSURE.md`](docs/PHASE2C4_CLOSURE.md).

## Diagnostics

Security failures should use bounded reason codes and structured evidence. Raw credentials, secrets, ciphertext and arbitrary private response bodies are prohibited from normal logs/diagnostics.
