# Phase 5C — WordPress.org submission contract

Status: **5C.0 CONTRACT FROZEN — 0.5.1 submission hardening required before upload**

Date frozen: 2026-09-12

## Purpose

Phase 5C moves AI Search Optimizer from a verified public GitHub release to WordPress.org submission/review without mutating or redefining the already published `0.5.0` release identity.

The WordPress.org target slug remains:

```text
ai-search-optimizer
```

No WordPress.org availability, reservation or approval may be claimed until the external directory process has actually accepted and published the plugin.

## Why 0.5.1 is required

The published `0.5.0` package is immutable and has this accepted identity:

```text
source commit      b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree        6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package            ai-search-optimizer-0.5.0.zip
package bytes      29397
package entries    13
package SHA-256    0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
GitHub tag         0.5.0
GitHub Release ID  387492480
```

That package's bundled `readme.txt` still contains a pre-publication sentence describing `0.5.0` as a stable candidate and saying that an official public GitHub Release is not yet claimed.

Editing that packaged `readme.txt` while retaining version `0.5.0` would produce bytes that no longer match the published immutable release SHA. Phase 5C therefore requires a patch release instead of silently replacing the `0.5.0` package.

The submission-hardening line is:

```text
0.5.1
```

## 0.5.1 scope boundary

`0.5.1` is a submission-hardening patch only unless a separately diagnosed blocker requires more.

Required changes:

- promote plugin header and connector version constant from `0.5.0` to `0.5.1`;
- set WordPress `readme.txt` Stable tag to `0.5.1`;
- replace the stale pre-publication sentence with truthful GitHub-release / WordPress.org-pending copy;
- add a concise `0.5.1` changelog entry describing submission hardening;
- preserve every historical `0.5.0` release identity and hash in repository evidence;
- keep customer-facing claims within the existing readiness/evidence boundary;
- do not add unrelated product behavior.

## Plugin URI / Author URI rule

The accepted `0.5.0` plugin header currently declares neither `Plugin URI` nor `Author URI`.

For `0.5.1`, **do not add either field merely for submission**. They are optional. This intentionally avoids the class of WordPress.org submission error where Plugin URI and Author URI are identical.

If a future release adds them, the rule is mandatory:

```text
Plugin URI != Author URI
```

and the Plugin URI must be unique to AI Search Optimizer. The canonical product landing available for a future Plugin URI is:

```text
https://kairoseth.com/products/ai-search-optimizer
```

The generic author/company URI, if ever declared, is:

```text
https://kairoseth.com/
```

They must never be set to the same value.

## WordPress.org policy baseline checked for 5C.0

The following current WordPress.org rules were rechecked on 2026-09-12:

- the submitted plugin must be complete;
- code/assets must be GPL-compatible;
- a stable version must be available from the directory after approval;
- no non-consensual tracking or silent outbound data collection;
- no public-site promotional links/credits without permission;
- admin promotion must not hijack the dashboard;
- Stable tag must match the plugin Version;
- readme content must be accurate and non-spammy;
- source/build provenance must remain reviewable;
- external services must be documented clearly.

Reference material:

- https://developer.wordpress.org/plugins/wordpress-org/detailed-plugin-guidelines/
- https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/
- https://developer.wordpress.org/plugins/wordpress-org/common-issues/
- https://developer.wordpress.org/plugins/wordpress-org/planning-submitting-and-maintaining-plugins/

## Current compatibility facts

WordPress `7.1` is the current stable major release as of this contract freeze, so the existing `Tested up to: 7.1` declaration is valid and must not be increased beyond actually tested/current release policy.

Current minimums remain:

```text
Requires at least: 5.6
Requires PHP:      7.4
Tested up to:      7.1
```

## License decision

The current plugin declares MIT. WordPress.org requires a GPL-compatible license and explicitly accepts GPL-compatible licenses while recommending GPLv2-or-later.

MIT is GPL-compatible, so Phase 5C does **not** require a licensing change. Do not introduce a license change solely to pass submission unless WordPress.org review provides a specific blocker requiring action.

## External-service / privacy boundary

The local Free workflow remains account-free and local-first.

The optional Kairoseth Custom Requests CTA:

- is initiated only after an explicit administrator click;
- uses the canonical `https://kairoseth.com/custom-requests` destination;
- sends only bounded product/platform/request context in the navigation URL;
- does not automatically attach site URL, llms.txt content/hash, inventory, identities, WooCommerce content, credentials, tokens, prompts, logs or database contents;
- was proven live in production before the public `0.5.0` GitHub Release for EN/ES and both accepted request types.

No new telemetry/account/entitlement dependency is introduced by `0.5.1`.

## 0.5.1 blocking validation

Before the WordPress.org upload package may be considered accepted:

```text
[ ] exact 0.5.1 semantic version aligned in plugin header, connector constant and Stable tag
[ ] stale 0.5.0 pre-publication sentence removed from packaged readme.txt
[ ] no Plugin URI / Author URI equality hazard
[ ] readme.txt policy and external-service disclosure reviewed
[ ] package contents gate PASS
[ ] WPCS + PHPCompatibility PASS
[ ] official WordPress Plugin Check PASS
[ ] WordPress 5.6 / PHP 7.4 runtime PASS
[ ] WordPress 6.8 / PHP 8.2 runtime PASS
[ ] WordPress 7.1 / PHP 8.3 runtime PASS
[ ] Multisite + WooCommerce PASS
[ ] real browser admin UX EN/ES PASS
[ ] Kairoseth CTA production preflight PASS
[ ] clean install 0.5.1 PASS
[ ] upgrade 0.5.0 -> 0.5.1 preserves expected local state
[ ] preserve/reinstall/delete uninstall lifecycle PASS
[ ] package reproducibility PASS
[ ] immutable 0.5.1 GitHub tag/release published and exact package SHA recorded
[ ] WordPress.org upload uses that exact accepted 0.5.1 ZIP
```

## External WordPress.org gate

After the exact `0.5.1` package is submitted:

```text
submission -> automated/manual review -> requested changes if any -> approval -> SVN/directory publication
```

Any WordPress.org reviewer finding must be treated as a new structured incident with exact message, affected file/line where available, confirmed root cause, fix, validation and regression prevention.

The directory state remains **not published** until the external approval/publication step is actually complete.

## Phase sequence

```text
5C.0 freeze submission-hardening contract
5C.1 implement and accept 0.5.1 submission package
5C.2 publish immutable 0.5.1 GitHub release + exact lifecycle evidence
5C.3 submit exact 0.5.1 ZIP to WordPress.org
5C.4 resolve external review findings, if any
5C.5 confirm live directory listing and only then update availability claims
```

**Next:** Phase 5C.1 — implement the minimal `0.5.1` metadata/readme hardening without changing product behavior.
