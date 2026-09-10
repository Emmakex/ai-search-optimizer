# Security Policy

AI Search Optimizer is a WordPress extension that can publish site-local AI Search artifacts and optionally connect to Kairoseth services. Security-sensitive changes follow least privilege, exact site identity and explicit mutation authority.

## Supported versions

`0.4.0` is the current standalone release candidate. It is not yet claimed as publicly distributed through GitHub Releases or WordPress.org. Security issues found during release-candidate acceptance are treated as blocking defects; public-user support begins when an official distribution channel is published.

## Reporting a vulnerability

Please do not disclose suspected vulnerabilities in a public issue before maintainers have had an opportunity to assess them. Use GitHub's private vulnerability/security reporting channel for this repository when available, or contact the repository owner privately through GitHub.

Include only the minimum evidence needed to reproduce the issue. Never post real Application Passwords, authorization headers, Kairoseth/provider secrets, customer private content or production credentials.

## Security invariants

- no provider/Kairoseth production secrets in distributed plugin code;
- no FTP/SFTP, hosting-panel or database credentials required;
- WooCommerce consumer keys are not required for local Free behavior or the inherited deployment contract;
- WordPress publication uses a dedicated capability and least-privilege identity;
- explicit local publication and retention-setting changes are nonce protected;
- exact blog/network/home identity is checked before managed mutation;
- content SHA-256 is verified before storage/serving;
- compare-and-set expected remote state prevents silent overwrite after drift;
- local public verification performs an independent read-back and does not follow redirects;
- Kairoseth organization/product authority remains server-side;
- browser/plugin/model-controlled state cannot grant cloud roles or entitlements;
- customer-facing remote transmission must be explicit and documented;
- uninstall performs no outbound network requests and no arbitrary filesystem writes.

## Data retention and uninstall

Deactivation preserves the stored `llms.txt` deployment and uninstall preference.

The uninstall preference is site-local and accepts only two normalized values:

- `preserve` — default; keep the stored deployment so it can be recovered after reinstall;
- `delete` — permanently delete the stored deployment during uninstall.

Uninstall always removes the plugin setup marker, retention preference, custom deployer role and administrator deployment capability. In Multisite this cleanup is performed site by site. The dynamic public `/llms.txt` route is unavailable while the plugin is inactive or removed even when deployment data is preserved.

See [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md).

## Release integrity

The accepted release-candidate package must be generated from an exact source commit/tree using the repository build script. CI requires two consecutive package builds to be byte-identical and records the package SHA-256, byte size and entry count in a release manifest. A package whose checksum does not match the published acceptance evidence must not be treated as accepted.

## Diagnostics

Security failures should use bounded reason codes and structured evidence. Raw credentials, secrets, ciphertext and arbitrary private response bodies are prohibited from normal logs/diagnostics.
