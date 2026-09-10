# AI Search Optimizer — Data retention and lifecycle

Status: **Phase 2C1 release-hardening contract**  
Last reviewed: **10 September 2026**

## Scope

This document defines what the standalone WordPress plugin retains or removes during deactivate and uninstall operations. It applies to the local Free workflow and the inherited connector state stored in the current WordPress site.

## Site-local data

AI Search Optimizer currently owns these site-local records:

| Record | Purpose | Deactivate | Uninstall: preserve | Uninstall: delete |
| --- | --- | --- | --- | --- |
| `kairoseth_ai_web_readiness_deployment` | Stored `llms.txt` deployment/content/hash | keep | keep | delete |
| `kairoseth_ai_web_readiness_setup_version` | Internal rewrite/setup marker | delete | delete | delete |
| `kairoseth_ai_web_readiness_uninstall_mode` | User uninstall preference | keep | delete | delete |
| `kairoseth_ai_web_deployer` role | Least-privilege deployment role | keep | remove | remove |
| administrator capability `kairoseth_ai_web_readiness_deploy` | Access to plugin workflow | keep | remove | remove |

The default uninstall mode is `preserve`. Unknown/invalid values normalize to `preserve` so a malformed setting cannot cause accidental content deletion.

## Deactivation

Deactivation is reversible. It:

- removes the current setup-version marker;
- flushes rewrite rules so the dynamic `/llms.txt` route is no longer active;
- preserves the deployment content/hash;
- preserves the uninstall preference;
- preserves deployer role assignments/capabilities for later reactivation.

No remote request is made during deactivation.

## Uninstall

Before uninstall, an authorized user can choose the policy under **Tools → AI Search Optimizer Data**.

### Preserve published data — default

Uninstall removes plugin-owned role/capability/setup/preference state but leaves the site-local deployment option. This allows a later reinstall to recover the last stored `llms.txt` content. Because plugin code is absent, the dynamic public `/llms.txt` route is not served while uninstalled.

### Delete published data

Uninstall performs the same security cleanup and additionally deletes the stored deployment option. This removal is permanent unless the site has an independent backup.

## Multisite

Network uninstall enumerates active, non-spam, non-deleted, non-archived sites and executes the cleanup in each site's context with `switch_to_blog()` / `restore_current_blog()`.

The uninstall policy is site-local. One site's delete preference does not authorize deletion of another site's deployment. No network-global option API is used for deployment deletion.

## Security constraints

Lifecycle operations must remain:

- local to WordPress;
- free of provider/Kairoseth credentials;
- free of outbound network calls during uninstall;
- free of arbitrary filesystem writes;
- bounded to plugin-owned roles, capabilities and options;
- protected by the existing least-privilege capability and WordPress nonce when the retention preference is changed in wp-admin.

## Release acceptance

Phase 2C1 is not accepted solely because this policy exists. Acceptance additionally requires lifecycle regression PASS, package inclusion of `uninstall.php`, PR CI PASS, merge and post-merge CI PASS. Real WordPress install/update/deactivate/uninstall execution remains part of the Phase 2C compatibility/runtime matrix.
