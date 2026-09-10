# AI Search Optimizer — Roadmap

Status: **Phase 3 re-scoped — WordPress.org-first contextual support/custom development model in progress**  
Last reviewed: **10 September 2026**

```text
Phase 0  product/repository foundation              COMPLETE
Phase 1  standalone connector extraction           COMPLETE
Phase 2  useful local Free workflow                 COMPLETE
  2A     local analysis + deterministic preview     COMPLETE
  2B     selection + safe local publication         COMPLETE
  2C     Free release hardening                     COMPLETE
    2C1  lifecycle + data retention                 COMPLETE
    2C2  WordPress/PHP runtime compatibility        COMPLETE
    2C3  Multisite/WooCommerce + UX hardening       COMPLETE
    2C4  release package + final acceptance         COMPLETE
Phase 3  WordPress.org-first support/custom path    IN PROGRESS
  3A     cloud connection-readiness experiment      SUPERSEDED before public release
  3B     contextual support + custom improvement    IN PROGRESS
  3C     WordPress.org compliance parity            NEXT after 3B
Phase 4  Kairoseth Extensions catalog integration   BLOCKED by Phase 3/public release truth
Phase 5  GitHub release + WordPress.org submission  BLOCKED by Phase 3 compliance gates
```

## Phase 0 / 1 — foundation and extraction — complete

The standalone public repository, MIT license, canonical `ai-search-optimizer` identity and the accepted connector compatibility baseline are established. Internal legacy REST/state identifiers remain only where needed for compatibility.

## Phase 2 — useful local Free workflow — complete

The accepted Free workflow is useful without a Kairoseth account:

```text
analyze local readiness
→ inventory/select public content
→ generate deterministic llms.txt
→ validate
→ explicitly publish
→ public read-back
→ exact SHA-256 verification
```

Accepted supporting evidence includes:

- WordPress 5.6 / PHP 7.4 runtime;
- WordPress 6.8 / PHP 8.2 runtime;
- WordPress 7.1 / PHP 8.3 runtime;
- real Multisite isolation/lifecycle;
- WooCommerce 11.1.0 public-content behavior;
- EN/ES Chromium desktop/mobile acceptance;
- preserve/delete uninstall policy;
- reproducible package/checksum evidence.

Accepted Free 0.4.0 release-candidate identity:

```text
source commit      4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree        472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package            ai-search-optimizer-0.4.0.zip
package SHA-256    27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

Canonical closures remain in the Phase 2 documentation files.

## Phase 3 — WordPress.org-first support/custom path — in progress

### Strategy decision

AI Search Optimizer adopts the same distribution model already accepted for `Emmakex/AI-Transparency`:

```text
Free plugin
  complete local functionality
  no account/license/entitlement required

Optional CTA
  explicit administrator action
  no external request on page load
  bounded non-sensitive technical/product context only

Custom
  support / improvement / integration / automation requested on Kairoseth
  user chooses what information to submit
```

This model is canonical for the WordPress.org-facing plugin.

### Phase 3A — cloud connection-readiness experiment — superseded

Phase 3A was implemented and technically accepted on the `0.5.0-dev` development line, proving a safe connection-readiness screen without automatic transmission. It is retained as engineering history, but the customer-facing cloud-onboarding direction was superseded before public release by the simpler WordPress.org-first model.

The accepted 3A evidence is not deleted or rewritten. Its public admin surface is being retired in 3B.

A coordinated platform onboarding PR (`kairoseth-platform` #223) was intentionally **closed without merge** after the strategy change. No production Kairoseth route dependency was introduced.

### Phase 3B — contextual support + custom improvement — in progress

Required contract:

- dedicated **Tools → AI Search Optimizer Support** page;
- Free workflow remains fully usable without Kairoseth;
- zero Kairoseth requests when the support page loads;
- no dashboard-wide ads or non-contextual nags;
- explicit CTA for implementation/optimization support;
- explicit CTA for custom improvement/development;
- canonical destination `https://kairoseth.com/custom-requests`;
- strict query allow-list:
  - `source`
  - `extensionSlug`
  - `extensionName`
  - `extensionVersion`
  - `hostPlatform`
  - `hostPlatformVersion`
  - `locale`
  - `requestType`
- request types limited to `implementation_support` and `business_customization` in the WordPress UI;
- no automatic site URL, administrator identity, llms.txt body, resource list, findings, credentials, WooCommerce customer/order data, logs or database content;
- EN/ES desktop/mobile browser acceptance;
- WordPress Plugin Check becomes blocking before merge;
- inherited Free/runtime/Multisite/WooCommerce/lifecycle/package gates remain green.

Canonical policy: [`WORDPRESS_ORG_POLICY.md`](WORDPRESS_ORG_POLICY.md).

### Phase 3C — WordPress.org compliance parity — next after 3B

Reach the same release-engineering baseline used by AI Transparency before directory submission:

- official WordPress Plugin Check: `plugin_repo`, security, accessibility, performance;
- WordPress Coding Standards;
- PHPCompatibility across declared supported range;
- proper WordPress i18n/gettext coverage with EN/ES parity and compiled Spanish catalog where appropriate;
- real packaged runtime/browser acceptance;
- real upgrade path acceptance;
- Multisite lifecycle/isolation;
- reproducible stable ZIP/checksum/manifest;
- `readme.txt`, headers, changelog and stable tag synchronized for the actual release;
- third-party/external-service disclosure complete;
- zero blocking WordPress.org submission defects.

## Phase 4 — Kairoseth Extensions catalog integration

The extension may remain `Building` until real distribution exists. `Available` requires truthful public distribution, stable package/version, install evidence and platform registry/public-page acceptance.

The Custom path is contextual support, not a feature entitlement.

## Phase 5 — public distribution

Only after Phase 3 compliance gates close:

1. accept exact stable source commit/tree;
2. generate reproducible stable ZIP + SHA-256 + manifest;
3. create deliberate Git tag/GitHub Release;
4. verify published assets against accepted evidence;
5. submit the complete plugin package to WordPress.org;
6. respond to manual review findings without claiming approval early;
7. claim WordPress.org availability only after the directory listing is actually public.

`ai-search-optimizer` remains the target WordPress.org slug until WordPress.org independently accepts/reserves it.

## Post-v1 candidates

Demand-led only: additional local AI Search diagnostics, richer WooCommerce representations, monitoring, agency/multi-site workflows and reusable advanced capabilities. These must not turn the directory plugin into trialware or a cloud-account gate.
