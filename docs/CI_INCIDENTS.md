# AI Search Optimizer — CI Incidents

This file is the durable failure-learning register required by the repository engineering rules.

Record only non-obvious CI/build/test/runtime failures that are useful for future diagnosis. Each incident must preserve the actionable diagnosis contract: pipeline/job/step, command, exit code, primary error, file/line when available, minimal context, normalized signature, root-cause status, verified fix/recovery and validation evidence.

## 2026-09-12 — CI #104 — transient HTTP 403 during live Kairoseth CTA preflight

Status: **RESOLVED — failure boundary confirmed outside plugin runtime; underlying transient edge mechanism not independently confirmed; no product-code or Kairoseth application-code change required**

```text
pipeline              GitHub Actions / CI
run                   #104 / 34686969817
attempt               1
commit                e8999aedbf5b1ca4cb5fa99e79b147884330c9ed
job                   Kairoseth CTA production EN/ES / 103535550331
step                  Verify live production CTA for 0.5.1
command               bash scripts/ci-run.sh "Kairoseth CTA production contract 0.5.1" bash scripts/verify-kairoseth-cta.sh
exit code             22
file/line             n/a — public HTTP request failed before page assertions
primary error         curl: (22) The requested URL returned error: 403
error signature       1598253c24787c71715b2186a5591c02e5bbcc5bbbb77d930378da86283b164f
root-cause status     exact edge/WAF mechanism unconfirmed; version allow-list defect ruled out
```

### Observed failure boundary

The GitHub-hosted runner for CI #104 was provisioned in Azure `mexicocentral`. The first production request to `https://kairoseth.com/custom-requests` for the exact `0.5.1` extension context received HTTP 403. Because the original verifier used `curl --fail-with-body` under `set -e`, curl terminated before the script could preserve final status, response headers or safe response markers. `--retry-all-errors` produced the same 403 three times before `ci-run.sh` emitted the normalized signature above.

No plugin page/runtime assertion was reached. The other candidate gates established that the `0.5.1` package itself was healthy, including the real `0.5.0 -> 0.5.1` lifecycle proof.

### Evidence against a version-specific application defect

Kairoseth Platform's accepted Custom Requests implementation does not allow-list individual extension versions. It allow-lists `ai-search-optimizer` as an extension identity and bounds `extensionVersion` as a token. The `/custom-requests` page passes the query through that normalizer rather than rejecting `0.5.1`.

No Kairoseth application-code change was made after CI #104. The verifier was hardened only to preserve diagnostics and to test the customer-realistic browser navigation client class.

CI #105 then ran from a fresh GitHub-hosted runner in Azure `westus3` and proved on the same public route:

```text
CTA_PROBE version=0.5.1 profile=curl-default status=200
CTA_PROBE version=0.5.1 profile=browser      status=200
EN + implementation_support                 PASS / HTTP 200
EN + business_customization                 PASS / HTTP 200
ES + implementation_support                 PASS / HTTP 200
ES + business_customization                 PASS / HTTP 200
```

Because both curl-default and browser-equivalent requests returned 200 on the confirmation run, the earlier 403 cannot be attributed to the curl User-Agent. Because Kairoseth application code and plugin packaged code were unchanged, it also cannot be attributed to a `0.5.1` product/version allow-list change. The precise upstream edge/security condition that emitted the earlier 403 was not captured and therefore remains explicitly **unconfirmed**.

### Recovery and diagnostic hardening

`scripts/verify-kairoseth-cta.sh` now:

- captures HTTP status, effective URL, response headers and body before deciding whether an HTTP status fails;
- emits only bounded/safe edge diagnostics such as server/edge headers and known block-page markers;
- probes curl-default and browser-equivalent behavior for the exact candidate;
- uses browser-equivalent navigation for the blocking customer CTA contract because the actual CTA is opened by a browser;
- probes accepted `0.5.0` as a control if the candidate browser request fails;
- preserves exact destination, query allow-list, forbidden-context and EN/ES form assertions.

The gate was not weakened and no 403 was ignored: any non-200 browser-equivalent candidate response still blocks CI.

### Validation

```text
CI run                         #105 / 34692395181
workflow conclusion            success
candidate package              ai-search-optimizer-0.5.1.zip
candidate bytes                29560
candidate entries              13
candidate SHA-256              2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
CTA curl-default               PASS / HTTP 200
CTA browser-equivalent         PASS / HTTP 200
CTA EN/ES × 2 request types    PASS
0.5.0 -> 0.5.1 lifecycle       PASS
full blocking suite            PASS
Kairoseth app change           none
packaged product recovery fix  none
```

### Regression boundary

Do **not** classify every future CTA 403 as this incident automatically. A future recurrence may reuse this incident only when the public request fails before page-contract assertions and a fresh control/differential proves the packaged product and server-side extension contract are unchanged.

If `0.5.0` control succeeds while the candidate fails persistently, if the response reaches the application and rejects normalized context, if redirects/destination drift, or if a browser-equivalent request remains non-200 across runners, treat it as a new defect and diagnose the responsible layer rather than retrying blindly.

## 2026-09-12 — CI #94 — transient Playwright login submission timeout before ES browser acceptance

Status: **RESOLVED — harness/login flake; exact tree/package passed on selective rerun; no product code change required**

```text
pipeline              GitHub Actions / CI
run                   #94 / 34671531167
attempt               1
commit                6c47abe32152835debbc9a76869ea5af037f0501
job                   Real browser admin UX EN/ES
step                  Browser responsive and accessibility acceptance
command               bash scripts/ci-run.sh "Real browser admin UX EN/ES" bash scripts/runtime-admin-ux.sh
exit code             1
file/line             scripts/admin-ux.mjs:73:27
primary error         page.waitForURL: Timeout 30000ms exceeded
error signature       1599dfa6cd1067fcd852668922e8e512629e1c0a4f4bac298822a3e6cec249ec
root-cause status     isolated harness timing failure; underlying browser scheduling cause not independently reproducible
```

### Observed failure boundary

The exact `0.5.0` package built successfully with SHA-256 `0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e`.

The first browser pass completed successfully:

```text
PASS: browser admin UX locale=en desktop=1280x900 mobile=390x844 contextual-support=present
```

The second process, after switching WordPress/site/user locale to Spanish, loaded `/wp-login.php` but timed out waiting for the post-login `/wp-admin/` URL. Apache logs show the login page/assets were served, but **no `POST /wp-login.php` was emitted** before the timeout. The failure therefore occurred in the browser-login harness before navigation to an AI Search Optimizer admin surface.

### Evidence against product regression

- PR CI #93 executed the same `scripts/admin-ux.mjs` / `scripts/runtime-admin-ux.sh` tree and the same package SHA minutes earlier and passed EN + ES completely;
- the EN pass inside CI #94 attempt 1 also completed against the exact same package;
- WordPress/PHP runtimes, Multisite/WooCommerce, Plugin Check, WPCS/PHPCompatibility and the new 0.4.0 → 0.5.0 lifecycle/upgrade gate passed on the same `main` commit;
- the failure happened before the Spanish process submitted credentials and before it opened any plugin admin page;
- no product, test or harness code changed before recovery.

### Recovery

Re-run only the failed `Real browser admin UX EN/ES` job after the first attempt completed. No code change and no timeout relaxation was applied.

### Validation

```text
CI run               #94 / 34671531167
attempt               2
browser EN            PASS
browser ES            PASS
release lifecycle     PASS
final package job     PASS
workflow conclusion   success
source unchanged      6c47abe32152835debbc9a76869ea5af037f0501
```

### Regression boundary

Do **not** weaken or remove browser EN/ES acceptance because of this incident. A future occurrence may be classified with this incident only when all of the following match:

- timeout at the login wait before an affected locale reaches a plugin admin page;
- no login POST is observed for the timed-out process;
- package/source identity is unchanged and another locale or immediately adjacent accepted run proves the product UI itself;
- a selective rerun passes without code changes.

If the login POST is emitted but authentication/navigation fails, if a plugin page is reached and then fails, or if the same signature repeats persistently, treat it as a new defect and harden the harness or product as appropriate rather than retrying indefinitely.

## 2026-09-12 — CI #88 — Docker Hub authentication reset during WP 5.6/PHP 7.4 runtime

Status: **RESOLVED — confirmed external infrastructure failure; no product code change required**

```text
pipeline              GitHub Actions / CI
run                   #88 / 34670143261
attempt               1
commit                b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
job                   Runtime WP 5.6 / PHP 7.4
step                  Packaged WordPress runtime acceptance
command               bash scripts/ci-run.sh "WordPress $WP_VERSION / PHP $PHP_VERSION runtime" bash scripts/runtime-wordpress.sh
exit code             125
file/line             n/a — failure occurred in external Docker registry/network path
error signature       bf51ce903a3c0225ead510f42cb6594f4119f069df93e762f9d6c2edab72a8a5
root-cause status     confirmed
```

### Primary error

Docker successfully pulled the MariaDB image, then failed before creating the WordPress container while requesting `wordpress:5.6-php7.4-apache`:

```text
Error response from daemon:
Head "https://registry-1.docker.io/v2/library/wordpress/manifests/5.6-php7.4-apache":
Get "https://auth.docker.io/token?...":
read tcp ...:443: read: connection reset by peer
```

The package itself had already built successfully before the runtime step:

```text
package             ai-search-optimizer-0.5.0.zip
package SHA-256     0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
```

### Root cause

Confirmed transient connectivity failure between the GitHub-hosted runner and Docker Hub authentication/registry infrastructure. The WordPress container never started, so the failed attempt did not execute the plugin runtime acceptance logic.

Evidence that this was not a product regression:

- the same WP 5.6/PHP 7.4 gate passed in PR CI #87 on the same source tree;
- WP 6.8/PHP 8.2 and WP 7.1/PHP 8.3 passed on post-merge `main`;
- Multisite + WooCommerce, Plugin Check, WPCS/PHPCompatibility and browser EN/ES gates passed;
- no plugin source or test code was modified before recovery;
- rerunning only the failed job succeeded.

### Recovery

No code fix was applied. GitHub Actions re-ran only the failed `Runtime WP 5.6 / PHP 7.4` job.

### Validation

```text
CI run               #88 / 34670143261
attempt               2
WP 5.6 / PHP 7.4     PASS
final package job     PASS
workflow conclusion   success
source unchanged      b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
```

After the runtime passed, `Reproducible stable candidate package evidence` executed successfully and recorded the accepted Phase 5A package identity.

### Regression boundary

Do **not** weaken, remove or auto-ignore the WP 5.6/PHP 7.4 runtime gate because of this incident. A future occurrence with the same external pull/authentication failure may be re-run selectively after confirming the product package built successfully and the error occurs before the WordPress container starts.

If a future runtime failure reaches WordPress/plugin execution, produces a different signature, or repeats persistently across retries/runners, it must be treated as a new incident and diagnosed independently rather than classified automatically as Docker Hub instability.