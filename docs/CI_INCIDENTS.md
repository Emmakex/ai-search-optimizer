# AI Search Optimizer — CI Incidents

This file is the durable failure-learning register required by the repository engineering rules.

Record only non-obvious CI/build/test/runtime failures that are useful for future diagnosis. Each incident must preserve the actionable diagnosis contract: pipeline/job/step, command, exit code, primary error, file/line when available, minimal context, normalized signature, root-cause status, verified fix/recovery and validation evidence.

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
