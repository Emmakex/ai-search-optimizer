# Security Policy

AI Search Optimizer is a WordPress extension that can publish site-local AI Search artifacts and optionally connect to Kairoseth services. Security-sensitive changes follow least privilege, exact site identity and explicit mutation authority.

## Supported versions

No standalone version is publicly released yet. Security support begins with the first accepted release.

## Reporting a vulnerability

Please do not disclose suspected vulnerabilities in a public issue before maintainers have had an opportunity to assess them. Use GitHub's private vulnerability/security reporting channel for this repository when available, or contact the repository owner privately through GitHub.

Include only the minimum evidence needed to reproduce the issue. Never post real Application Passwords, authorization headers, Kairoseth/provider secrets, customer private content or production credentials.

## Security invariants

- no provider/Kairoseth production secrets in distributed plugin code;
- no FTP/SFTP, hosting-panel or database credentials required;
- WooCommerce consumer keys are not required for the inherited deployment contract;
- WordPress publication uses a dedicated capability and least-privilege identity;
- exact blog/network/home identity is checked before managed mutation;
- content SHA-256 is verified before storage/serving;
- compare-and-set expected remote state prevents silent overwrite after drift;
- Kairoseth organization/product authority remains server-side;
- browser/plugin/model-controlled state cannot grant cloud roles or entitlements;
- customer-facing remote transmission must be explicit and documented.

## Diagnostics

Security failures should use bounded reason codes and structured evidence. Raw credentials, secrets, ciphertext and arbitrary private response bodies are prohibited from normal logs/diagnostics.
