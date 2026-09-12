# Phase 5C — WordPress.org submission contract

Status: **5C.1 ACCEPTED — exact 0.5.1 package frozen and verified on PR + post-merge main; 5C.2 immutable GitHub release is next; WordPress.org not submitted**

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

Accepted changes:

- plugin header and connector version constant promoted from `0.5.0` to `0.5.1`;
- WordPress `readme.txt` Stable tag set to `0.5.1`;
- stale pre-publication sentence replaced with truthful GitHub-release / WordPress.org-pending copy;
- concise `0.5.1` changelog entry added;
- every historical `0.5.0` release identity and hash preserved;
- customer-facing claims kept within the existing readiness/evidence boundary;
- no unrelated product behavior added.

## 5C.1 accepted package identity

PR #32 produced and accepted a byte-reproducible `0.5.1` submission package:

```text
version              0.5.1
package              ai-search-optimizer-0.5.1.zip
package bytes        29560
package entries      13
package SHA-256      2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
PR                   #32
PR head              78f36816bd7bedc5f907f2d6ab9ad4fbf5898d4c
PR CI discovery      #104 / run 34686969817
PR CI confirmation   #105 / run 34692395181 — PASS
final PR CI           #107 / run 34692689075 — PASS
merge commit          c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
accepted source tree  e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
post-merge main CI    #108 / run 34692826856 — PASS
```

CI #107 reproduced the ZIP twice with the exact frozen SHA before merge. Post-merge CI #108 rebuilt from canonical `main` at `c93ac68c3698fa2c7e003dabc41f72e2e423b5cd` and again produced exactly:

```text
Bytes:     29560
Entries:   13
SHA-256:   2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
```

No packaged file changed between final PR acceptance and post-merge acceptance.

## CTA incident and diagnostic boundary

CI #104 passed metadata, package, coding-quality, Plugin Check, runtime, Multisite/WooCommerce, browser and `0.5.0 -> 0.5.1` lifecycle gates, but the production CTA job received HTTP 403 from the public endpoint and blocked final package evidence. The package itself was not changed to recover.

The CTA diagnostic was hardened so an HTTP response is captured before failure, safe edge markers can be emitted, browser-equivalent navigation is tested, and a `0.5.0` control is probed only when the candidate browser request also fails. On CI #105, the exact `0.5.1` endpoint returned HTTP 200 for both curl-default and browser profiles, all four EN/ES × request-type cases passed, and the full workflow completed successfully without any Kairoseth application-code or plugin-product change. The underlying transient edge mechanism that produced the earlier 403 could not be independently confirmed; it must not be misclassified as a version allow-list defect.

Final PR CI #107 and post-merge main CI #108 both re-proved the production CTA gate successfully.

Durable evidence: [`CI_INCIDENTS.md`](CI_INCIDENTS.md).

## Plugin URI / Author URI rule

The plugin header declares neither `Plugin URI` nor `Author URI`.

For `0.5.1`, **do not add either field merely for submission**. They are optional. This intentionally avoids the class of WordPress.org submission error where Plugin URI and Author URI are identical.

If a future release adds them, the rule is mandatory:

```text
Plugin URI != Author URI
```

The canonical product landing available for a future Plugin URI is:

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

## Compatibility baseline

Current declared/tested minimums remain:

```text
Requires at least: 5.6
Requires PHP:      7.4
Tested up to:      7.1
```

The accepted package passed the blocking WordPress/PHP matrix for WP 5.6/PHP 7.4, WP 6.8/PHP 8.2 and WP 7.1/PHP 8.3.

## License decision

The plugin declares MIT. WordPress.org requires a GPL-compatible license and MIT is GPL-compatible, so Phase 5C does **not** require a licensing change. Do not introduce a license change solely to pass submission unless WordPress.org review provides a specific blocker requiring action.

## External-service / privacy boundary

The local Free workflow remains account-free and local-first.

The optional Kairoseth Custom Requests CTA:

- is initiated only after an explicit administrator click;
- uses the canonical `https://kairoseth.com/custom-requests` destination;
- sends only bounded product/platform/request context in the navigation URL;
- does not automatically attach site URL, llms.txt content/hash, inventory, identities, WooCommerce content, credentials, tokens, prompts, logs or database contents;
- was proven live in production before the public `0.5.0` GitHub Release for EN/ES and both accepted request types;
- was re-proven live for the exact `0.5.1` context through final PR CI #107 and post-merge main CI #108.

No new telemetry/account/entitlement dependency is introduced by `0.5.1`.

## 0.5.1 blocking validation

The 5C.1 package acceptance is complete:

```text
[x] exact 0.5.1 semantic version aligned in plugin header, connector constant and Stable tag
[x] stale 0.5.0 pre-publication sentence removed from packaged readme.txt
[x] no Plugin URI / Author URI equality hazard
[x] readme.txt policy and external-service disclosure reviewed
[x] package contents gate PASS
[x] WPCS + PHPCompatibility PASS
[x] official WordPress Plugin Check PASS — No errors found
[x] WordPress 5.6 / PHP 7.4 runtime PASS
[x] WordPress 6.8 / PHP 8.2 runtime PASS
[x] WordPress 7.1 / PHP 8.3 runtime PASS
[x] Multisite + WooCommerce PASS
[x] real browser admin UX EN/ES PASS
[x] Kairoseth CTA production preflight PASS
[x] clean install 0.5.1 PASS
[x] upgrade 0.5.0 -> 0.5.1 preserves expected local state
[x] preserve/reinstall/delete uninstall lifecycle PASS
[x] package reproducibility PASS
[x] final PR CI #107 PASS
[x] PR #32 merged at c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
[x] post-merge main CI #108 PASS
[ ] immutable 0.5.1 GitHub tag/release published and exact package SHA recorded
[ ] WordPress.org upload uses that exact accepted 0.5.1 ZIP
```

## External WordPress.org gate

After the exact released `0.5.1` package is submitted:

```text
submission -> automated/manual review -> requested changes if any -> approval -> SVN/directory publication
```

Any WordPress.org reviewer finding must be treated as a new structured incident with exact message, affected file/line where available, confirmed root cause, fix, validation and regression prevention.

The directory state remains **not published** until the external approval/publication step is actually complete.

## Phase sequence

```text
5C.0 freeze submission-hardening contract                         COMPLETE
5C.1 implement and accept exact 0.5.1 submission package         COMPLETE
5C.2 publish immutable 0.5.1 GitHub release + exact evidence     NEXT
5C.3 submit exact released 0.5.1 ZIP to WordPress.org            BLOCKED ON 5C.2
5C.4 resolve external review findings, if any                    FUTURE
5C.5 confirm live directory listing and update availability      FUTURE
```

**Next:** Phase 5C.2 must publish an immutable GitHub `0.5.1` tag/release from the exact accepted package identity above and verify the released ZIP remains SHA-256 `2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b`. WordPress.org submission remains blocked until that release exists.