# AI Search Optimizer — CI Incidents

This file is the durable failure-learning register required by the repository engineering rules.

Record only non-obvious CI/build/test/runtime failures that are useful for future diagnosis. Each incident must preserve the actionable diagnosis contract: pipeline/job/step, command, exit code, primary error, file/line when available, minimal context, normalized signature, root-cause status, verified fix/recovery and validation evidence.

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
