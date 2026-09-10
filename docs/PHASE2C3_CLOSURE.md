# Phase 2C3 Closure — Multisite, WooCommerce and Admin UX

Status: **Accepted**  
Date: **10 September 2026**

## Accepted scope

Phase 2C3 proves the packaged AI Search Optimizer plugin across the remaining Free release surfaces that were not covered by the single-site runtime matrix.

Accepted evidence includes:

- real WordPress 7.1 / PHP 8.3 Multisite runtime;
- network activation of the generated ZIP;
- automatic initialization of a subsite created after network activation;
- exact current-site identity and independent site-local deployment state;
- separate public `llms.txt` artifacts and SHA-256 values for main site and subsite;
- proof that publication on the subsite does not mutate the main-site deployment;
- network deactivate/reactivate recovery for both sites;
- independent per-site uninstall retention policy (`preserve` on main, `delete` on subsite);
- WooCommerce 11.1.0 activated only on the subsite;
- published public WooCommerce products included in local inventory;
- draft, private and password-protected products excluded;
- no WooCommerce consumer/API keys required;
- real Chromium admin acceptance in English and Spanish;
- desktop viewport 1280×900 and narrow/mobile viewport 390×844;
- contained inventory table and no primary-workflow horizontal overflow;
- native accessible names for selection, preview, publication and retention controls;
- visible keyboard focus and touch-friendly mobile controls.

## Engineering evidence

```text
PR #11                               merged
initial PR head                      dc92ee9c81e2b7d5c8bf0b465c040dd8c8cba6cb
CI #23                               FAIL — Multisite harness command assumption only
CI #23 signature                     6f27a415ed0943186949a4096cb8d9e02665b1f629d2ade98ca11426cc4e6bab
fix commit                           ae3c0afb56e549de00607c0617b4d8698d21ce18
CI #24                               PASS — all 6 jobs
merge SHA                            1f8e5a419357d873bf3dda4403a45ee9e9a3eabe
post-merge CI #25                    PASS — all 6 jobs
blocking Phase 2C3 defects           0
```

## Retained failure diagnosis

CI #23 failed only in `Multisite + WooCommerce runtime`. The harness used `wp site get <id> --field=url`, but the pinned WP-CLI 2.12.0 environment does not register `get` as a `wp site` subcommand.

```text
step        Packaged Multisite and WooCommerce acceptance
command     bash scripts/runtime-multisite-woocommerce.sh
error       Error: 'get' is not a registered subcommand of 'site'.
exit        1
signature   6f27a415ed0943186949a4096cb8d9e02665b1f629d2ade98ca11426cc4e6bab
root cause  test-harness API assumption; product code had not failed
fix         resolve the validated numeric blog ID through WordPress core get_site_url()
validation  CI #24 PASS + post-merge CI #25 PASS
```

The existing WordPress/PHP runtime rows and the browser acceptance were already green in CI #23. No product requirement or test coverage was removed to obtain the green result.

## Release truth

Phase 2C3 acceptance does **not** publish version 0.4.0 and does **not** mark the extension Available. Phase 2C4 remains responsible for final release metadata, immutable package/checksum evidence and the Free release decision.
