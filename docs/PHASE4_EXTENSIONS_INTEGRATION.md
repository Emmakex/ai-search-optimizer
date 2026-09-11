# Phase 4 — Kairoseth Extensions Integration

Status: **Accepted**  
Last reviewed: **11 September 2026**

## Goal

Integrate the standalone AI Search Optimizer WordPress plugin into the canonical Kairoseth **Extensions** product surface without changing the plugin's local-first Free contract or pretending that a stable WordPress.org release already exists.

Phase 4 is a cross-repository integration milestone. The WordPress implementation remains in this public repository; the public catalog, product route, Custom Requests authority and production browser gates live in `Emmakex/kairoseth-platform`.

## Accepted product identity

```text
product name       AI Search Optimizer
extension slug     ai-search-optimizer
product area       Extensions
public route       https://kairoseth.com/products/ai-search-optimizer
plugin version     0.5.0-dev
catalog status     building
WordPress minimum  5.6
PHP minimum        7.4
```

The catalog intentionally remains `building`. Phase 4 does **not** convert `0.5.0-dev` into a stable release, does not expose a fake download, and does not claim WordPress.org publication, approval, ratings or installs.

## Public Extensions contract

Kairoseth Platform now resolves the plugin through the canonical Extensions registry record:

```text
areaSlug    extensions
slug        ai-search-optimizer
name        AI Search Optimizer
status      building
publicHref  /products/ai-search-optimizer
```

The public EN/ES product page describes the real local-first product state, including llms.txt readiness, deterministic publication/verification boundaries, WooCommerce awareness, optional Kairoseth support and the current development version.

The route is included in the public sitemap and the shared SEO regression suite checks its canonical metadata contract.

## Custom Request authority

The accepted Phase 3B support bridge remains authoritative. The plugin can open the exact Kairoseth Custom Requests destination only after explicit administrator action.

Kairoseth Platform independently allow-lists `ai-search-optimizer` and resolves the canonical extension name server-side. Browser/plugin-controlled input cannot select an arbitrary product identity or recipient mailbox.

Accepted bounded context remains:

```text
source=extension
extensionSlug=ai-search-optimizer
extensionName=AI Search Optimizer
extensionVersion=<real plugin version>
hostPlatform=wordpress
hostPlatformVersion=<real WordPress version>
locale=<en|es>
requestType=<accepted request type>
```

No site URL, llms.txt content/hash, public-content inventory, WooCommerce content, administrator/customer identity, credentials, tokens, prompts, conversations, logs, database contents or arbitrary WordPress options are attached automatically.

## Share boundary

No separate public share workflow is part of the accepted AI Search Optimizer Extensions contract in Phase 4. Therefore no share surface was invented merely to satisfy the integration milestone. If a shared user-initiated share capability is introduced later, it must receive its own implementation, privacy and acceptance gates.

## Kairoseth Platform implementation evidence

### Catalog / landing integration

```text
platform PR                            #225
branch                                 feat/ai-search-optimizer-extensions-catalog
implementation head                    a0c423b0512d657b9237b91bd694e2d0c08b4e6e
PR CI                                  #938 / run 34646585217 — PASS
merge SHA                              df56ba1a60ce345224ec1baad99f9a69c80822c0
post-merge CI                          #939 / run 34646811254 — PASS
post-merge Production Smoke            #129 / run 34646811300 — PASS
```

PR #225 added the canonical registry identity, EN/ES catalog copy, the public product route and acceptance coverage while keeping the product truthful as `building` / `0.5.0-dev`.

### Production route / sitemap proof

```text
platform PR                            #226
branch                                 fix/ai-search-optimizer-production-proof
final PR head                          60062a548f93a21b90aaa3e8871c6e19bc41fa4d
PR CI                                  #941 / run 34648448921 — PASS
PR Production Smoke                    #131 / run 34648448945 — PASS
merge SHA                              74ec596f568d8cc41418bc708d0c3a6ee98b47c6
post-merge CI                          #942 / run 34648848358 — PASS
AI Web Readiness Production Proof      #32 / run 34648848235 — PASS
post-merge Production Smoke            #132 / run 34648848239 attempt 2 — PASS
blocking Phase 4 defects               0
```

The production acceptance now proves the AI Search Optimizer route in both EN and ES, public metadata/canonical behavior, and the deployed sitemap entry after the main deployment is live.

## Retained production-gate diagnosis

Two useful CI lessons were retained during PR #226 rather than weakening the production contract.

### PR-time undeployed sitemap assertion

```text
pipeline/job   Production Smoke #130 / production-smoke
job id         103421117512
step           Validate public production surfaces
command        node scripts/check-public-production-acceptance.mjs
exit code      1
primary error  deployed sitemap did not contain /products/ai-search-optimizer
signature      production-smoke/undeployed-ai-search-optimizer-sitemap
root cause     CONFIRMED — the pull-request run required a production artifact introduced by that same unmerged PR
fix            keep EN/ES route proof on PRs; require the new sitemap URL only on main push
validation     replacement Production Smoke #131 PASS; PR CI #941 PASS
```

### Immediate post-merge deployment freshness

```text
pipeline/job   Production Smoke #132 / production-smoke
job id         103426020549 (attempt 1)
step           Validate public production surfaces
command        node scripts/check-public-production-acceptance.mjs
exit code      1
primary error  deployed sitemap still lacked /products/ai-search-optimizer immediately after merge
signature      production-smoke/post-merge-sitemap-deploy-lag
root cause     CONFIRMED by rerun — production/CDN deployment freshness lag; EN/ES product route, health and catalog checks already passed
fix            no gate weakening; retain strict main-push sitemap proof and rerun after deployment convergence
validation     run #132 attempt 2 PASS, including public production surface validation
```

This preserves the intended engineering rule: a release/deployment race is diagnosed and retried after convergence; the acceptance requirement is not silently removed.

## Exit gates

```text
[x] canonical Extensions registry record uses ai-search-optimizer
[x] public product identity is consistent with the standalone plugin
[x] truthful status remains building at 0.5.0-dev
[x] EN/ES public product route exists
[x] canonical metadata and sitemap regression coverage exists
[x] contextual Custom Requests destination is accepted
[x] server-side extension allow-list resolves canonical identity
[x] automatic context remains privacy-bounded
[x] no fake stable download / WordPress.org availability claim
[x] no unnecessary share workflow invented
[x] platform PR CI PASS
[x] platform post-merge CI PASS
[x] real production EN/ES route proof PASS
[x] deployed sitemap proof PASS
[x] AI Web Readiness production proof PASS
[x] blocking defects = 0
```

**Phase 4 is closed.** Phase 5 — stable public distribution / WordPress.org — is the next release-gated workstream. Stable release metadata, immutable tag/release artifact, final package acceptance and external WordPress.org review remain intentionally outside Phase 4.