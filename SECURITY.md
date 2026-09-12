# Security Policy

AI Search Optimizer is a local-first WordPress extension that can publish a site-local `llms.txt` and optionally open a privacy-bounded Kairoseth support/custom-development request. Security-sensitive changes follow least privilege, exact site identity, explicit mutation authority and explicit outbound navigation.

## Supported versions

`0.5.1` is the current public GitHub Release and the accepted Phase 5C.2 release line. Its exact source/tree/package identity is frozen below. The plugin is **not yet claimed as published on WordPress.org**.

`0.5.0` is the previous public GitHub Release and remains preserved as historical release evidence. `0.4.0` is the historical accepted standalone Free release candidate. Neither identity may be silently redefined.

A new blocking security, privacy or WordPress.org policy finding affecting the release line must reopen the relevant acceptance decision before directory submission/publication proceeds.

## Reporting a vulnerability

Do not disclose suspected vulnerabilities in a public issue before maintainers have assessed them. Use GitHub private vulnerability/security reporting when available, or contact the repository owner privately through GitHub. Never post real Application Passwords, authorization headers, Kairoseth/provider secrets, customer private content or production credentials.

## Security invariants

- no provider/Kairoseth production secrets in distributed plugin code;
- no FTP/SFTP, hosting-panel or database credentials required;
- local Free behavior does not require WooCommerce API keys, a Kairoseth account, license or entitlement;
- publication/retention changes use dedicated capability and nonce protection;
- exact blog/network/home identity is checked before managed mutation;
- content SHA-256 is verified before storage/serving;
- compare-and-set expected state prevents silent overwrite after drift;
- public verification uses an independent read-back;
- browser/client/model-controlled state cannot grant cloud roles or entitlements;
- support navigation is explicit and bounded;
- loading the support page makes no outbound Kairoseth request;
- support context never automatically includes site URL, llms.txt content/hash, administrator identity, WooCommerce content, credentials, tokens, prompts, logs or database content;
- uninstall makes no outbound requests and no arbitrary filesystem writes;
- GitHub release publication fails closed on release/tag/package identity drift;
- live production CTA validation is blocking before release mutation.

## Optional Kairoseth support

The plugin-owned destination is exactly:

```text
https://kairoseth.com/custom-requests
```

Only these query keys may be generated:

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

Accepted request types are `implementation_support` and `business_customization`. The user chooses what contact/business/request information to submit on Kairoseth.

## Release integrity

Current public GitHub Release `0.5.1`:

```text
tag                0.5.1
annotated tag       32a51daf4e32a8919114b6dc734a54a00952aed0
tag target         c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
source tree        e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
package            ai-search-optimizer-0.5.1.zip
package bytes      29560
package entries    13
package SHA-256    2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
GitHub Release ID  387576797
publication run    34695973744
published at       2026-09-12T13:17:34Z
```

GitHub reports the release as public (`draft=false`, `prerelease=false`). The annotated tag is unsigned; integrity is pinned by exact source/tree/package identities, reproducible builds, lifecycle acceptance, draft-first publication and release-asset round-trip verification.

Previous public GitHub Release `0.5.0`:

```text
tag                0.5.0
annotated tag       6433cca08a8d8a213f0c0326447910c5ee732ff5
source commit      b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree        6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package bytes      29397
package entries    13
package SHA-256    0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
GitHub Release ID  387492480
```

Historical `0.4.0` evidence:

```text
source commit      4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree        472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256    27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

See [`docs/PHASE5C2_GITHUB_RELEASE.md`](docs/PHASE5C2_GITHUB_RELEASE.md), [`docs/PHASE5B_GITHUB_RELEASE.md`](docs/PHASE5B_GITHUB_RELEASE.md) and [`docs/CI_INCIDENTS.md`](docs/CI_INCIDENTS.md).

## WordPress.org boundary

`0.5.1` is the exact released package intended for WordPress.org submission. External review/approval and actual directory publication remain separate gates. No customer-facing copy may claim directory availability before the listing is genuinely live.
