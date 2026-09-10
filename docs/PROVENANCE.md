# AI Search Optimizer — Provenance

Status: **Canonical extraction provenance**  
Last reviewed: **10 September 2026**

## Source lineage

The standalone plugin is derived from the Kairoseth AI Web Readiness WordPress connector built and accepted in `Emmakex/kairoseth-platform` Phase 5B.

Accepted predecessor:

```text
Product: Kairoseth AI Web Readiness Connector
Version: 0.3.2
Source path: integrations/wordpress/kairoseth-ai-web-readiness/kairoseth-ai-web-readiness.php
Fix PR: Emmakex/kairoseth-platform#197
PR #197 head: 9fddd6909365bae8b22cb6098f8703f177202c7b
Connector schema: 2
Historical source checksum recorded by platform release docs:
31f30244964020920495af0f1ab222de27603f3e9e24f32b780b15425493379b
```

PR #197 changed 0.3.1 → 0.3.2 so `get_site($blog_id)` is called only when WordPress Multisite is active. That exact regression contract is retained here.

## Real acceptance evidence inherited as regression evidence

Kairoseth Platform Phase 5B accepted:

```text
single-site: https://emmake.com/
WordPress authentication / capability / exact identity: PASS

non-main Multisite: https://stagpartynight.com/es/
connector: 0.3.2
WordPress: 6.8.8
WooCommerce: active
Blog ID: 2
Network ID: 1
preflight: PASS
explicit authorization: PASS
authenticated WordPress write: PASS
public site-local llms.txt: HTTP 200
approved/public SHA-256: exact match
state: verified
```

This evidence proves the predecessor connector contract. It does not automatically prove new standalone features added after extraction.

## Standalone 0.4.0 delta

The initial standalone source intentionally makes only productization changes around the accepted connector contract:

- public plugin name becomes **AI Search Optimizer**;
- repository/main plugin filename becomes `ai-search-optimizer.php`;
- version becomes `0.4.0` for the new standalone line;
- distributed source license is MIT;
- text domain becomes `ai-search-optimizer`;
- compatibility identifiers and connector schema remain unchanged.

No new Free local generator/admin UX is claimed in the extraction baseline. Those are later roadmap phases with their own acceptance.

## License note

The predecessor plugin header used `GPL-2.0-or-later`. This standalone repository is published under the MIT license by the project owner. Any future imported third-party code/assets must be reviewed independently for license compatibility before inclusion.
