# AI Search Optimizer — Phase 2A Closure

Status: **ACCEPTED**  
Date: **10 September 2026**

## Accepted boundary

Phase 2A establishes the first standalone, account-free local product value without introducing local publication mutation.

The accepted WordPress admin workflow:

```text
inspect local AI Search readiness
→ inventory eligible public WordPress content
→ include public WooCommerce products when available
→ build deterministic site-local llms.txt preview
→ validate local source scope and structural constraints
→ expose exact SHA-256
```

## Customer-facing behavior

- EN/ES admin workspace under Tools → AI Search Optimizer;
- WordPress search visibility / `robots.txt` readiness;
- WordPress sitemap readiness;
- current stored `llms.txt` deployment readiness;
- up to 100 published, non-password-protected public resources;
- public WooCommerce products included through the public `product` post type;
- current-site Multisite boundary made explicit;
- deterministic `llms.txt` preview generated only from local public WordPress inputs;
- no generated timestamp in the artifact;
- duplicate homepage/resources removed deterministically;
- actionable validator findings;
- exact preview SHA-256;
- explicit privacy statement that this local analysis does not send content to Kairoseth, AI providers or third-party analytics.

## Security and compatibility

Phase 2A is read-only. Its local modules do not call `update_option()` / `delete_option()`, perform remote POST/request operations, embed provider credentials, or grant new roles/capabilities.

The inherited accepted connector identifiers remain unchanged:

```text
REST namespace: kairoseth-ai-web-readiness/v1
capability: kairoseth_ai_web_readiness_deploy
role: kairoseth_ai_web_deployer
deployment option: kairoseth_ai_web_readiness_deployment
connector schema: 2
```

The existing connector contract/security regression remained green.

## Regression coverage

Dedicated Phase 2A regression proves:

- identical logical inventory in different input order produces byte-identical output;
- static WordPress homepage does not duplicate `home_url('/')`;
- pages sort before products and products before posts under the current deterministic priority;
- generated output contains no timestamp;
- generated same-site preview validates;
- SHA-256 equals the exact preview bytes;
- duplicate URLs fail validation with `duplicate_url`;
- external URLs fail validation with `external_url`;
- previews without resources fail validation with `no_resources`;
- local admin/core source contains no new mutation or outbound-provider patterns;
- package includes both local Free modules.

## CI evidence

```text
PR #3                                    merged
PR head                                  828d1f1188aaf282f5b1fcce055fd912021df75b
PR CI #5                                 PASS
merge SHA                                61b33412484a20a505726c808ec64bc9dc8953a3
post-merge CI #6                         PASS
PHP syntax                               PASS
connector contract/security regression   PASS
local Free analysis regression           PASS
plugin ZIP build                         PASS
package-content verification             PASS
repository cleanliness                   PASS
blocking Phase 2A defects                0
```

## Decision

**Phase 2A is accepted. Phase 2B — selection + safe local publication — is the next permitted implementation boundary.**

This closure does not claim a public 0.4.0 release, WordPress.org availability, or Kairoseth Extensions `Available` status.
