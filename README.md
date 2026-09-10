# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Incubating — standalone product foundation; not released yet**

```text
Product: AI Search Optimizer
System: Kairoseth Extensions
Host: WordPress / WooCommerce
Repository: Emmakex/ai-search-optimizer
License: MIT
Standalone baseline: 0.4.0 (unreleased)
Accepted predecessor: Kairoseth AI Web Readiness Connector 0.3.2
```

This repository owns the independently releasable WordPress plugin. Kairoseth Platform continues to own cloud analysis, tenant authorization, advanced AI Search workflows and managed publication orchestration.

## English

### Why this repository exists

AI Search Optimizer is being extracted from the real WordPress connector already accepted in Kairoseth AI Search Optimizer / AI Web Readiness Phase 5B. The dedicated repository gives the WordPress extension its own source, compatibility contract, CI, packaging and release cadence.

The imported baseline preserves the accepted connector security contract:

- dedicated least-privilege WordPress capability and deployer role;
- exact single-site / Multisite identity;
- site-local `llms.txt` serving;
- SHA-256 integrity verification before serving;
- authenticated namespaced REST endpoints;
- compare-and-set protection against remote state drift;
- idempotent same-hash deployments;
- no FTP/SFTP, hosting-panel, database or WooCommerce API credentials;
- no arbitrary filesystem writes.

### Product direction

The public Free plugin must become useful on its own before release. The planned local Free workflow is:

```text
inspect WordPress public AI-search readiness
→ detect sitemap / robots.txt / llms.txt state
→ select public WordPress content
→ build deterministic llms.txt preview
→ validate it
→ publish site-local llms.txt
→ show understandable status and diagnostics
```

Optional Kairoseth-connected capabilities may then add deeper site analysis, Importance / AI Readiness evidence, source-grounded curation, revision history, optional AI assistance and managed publication verification.

Custom work remains available through Kairoseth Custom Requests once that shared platform dependency is implemented.

### Compatibility boundary

The public product name changes, but the imported `0.3.2` connector protocol identifiers intentionally remain compatible in the `0.4.0` foundation. Existing Kairoseth Platform integrations must not break merely because the code moved repositories.

See [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md) and [`docs/PROVENANCE.md`](docs/PROVENANCE.md).

### Release truth

There is **no public 0.4.0 release yet** and no WordPress.org listing is claimed. The WordPress.org slug `ai-search-optimizer` is a target only until actually approved/reserved.

Release requires independent CI, useful Free functionality, EN/ES customer UI, installation/update/uninstall policy, security/privacy disclosure, Custom Request/share requirements where applicable, a real package and real distribution verification.

## Español

### Por qué existe este repositorio

AI Search Optimizer se separa del conector WordPress ya aceptado en la Fase 5B de Kairoseth AI Search Optimizer / AI Web Readiness. El repositorio independiente pasa a ser propietario del código WordPress, compatibilidad, CI, empaquetado y ciclo de releases.

La baseline importada conserva el contrato de seguridad probado:

- capability y rol WordPress dedicados de mínimo privilegio;
- identidad exacta single-site / Multisite;
- `llms.txt` site-local;
- comprobación SHA-256 antes de servir contenido;
- endpoints REST autenticados y namespaced;
- compare-and-set frente a cambios remotos;
- deployments idempotentes para el mismo hash;
- sin FTP/SFTP, panel de hosting, base de datos ni API keys de WooCommerce;
- sin escrituras arbitrarias de filesystem.

### Dirección de producto

La edición Free pública debe aportar valor por sí sola antes del lanzamiento. El flujo local previsto es:

```text
analizar preparación AI Search pública de WordPress
→ detectar sitemap / robots.txt / llms.txt
→ seleccionar contenido público WordPress
→ generar preview llms.txt determinista
→ validar
→ publicar llms.txt site-local
→ mostrar estado y diagnósticos comprensibles
```

La conexión opcional con Kairoseth podrá añadir análisis avanzado, evidencia Importance / AI Readiness, curación basada en fuentes, historial de revisiones, asistencia IA opcional y publicación gestionada con verificación.

Custom se integrará mediante Kairoseth Custom Requests cuando esa dependencia compartida de plataforma esté implementada.

### Compatibilidad

Cambia el nombre público del producto, pero los identificadores técnicos heredados del conector `0.3.2` se mantienen durante la fundación `0.4.0` para no romper Kairoseth Platform.

Consulta [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md) y [`docs/PROVENANCE.md`](docs/PROVENANCE.md).

### Estado de release

**0.4.0 todavía no está publicado** y no afirmamos disponer aún de ficha en WordPress.org. `ai-search-optimizer` es el slug objetivo hasta que WordPress.org lo apruebe/reserve.

El release requiere CI independiente, Free útil, UI ES/EN, políticas de instalación/update/uninstall, seguridad/privacidad, requisitos Custom Request/share aplicables, paquete real y distribución verificada.

## Documentation / Documentación

- [`docs/PRODUCT_V1.md`](docs/PRODUCT_V1.md)
- [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md)
- [`docs/ROADMAP.md`](docs/ROADMAP.md)
- [`docs/ACCEPTANCE.md`](docs/ACCEPTANCE.md)
- [`docs/NAMING_SEO.md`](docs/NAMING_SEO.md)
- [`docs/PROVENANCE.md`](docs/PROVENANCE.md)
- [`docs/ENGINEERING_RULES.md`](docs/ENGINEERING_RULES.md)

## License

MIT. See [`LICENSE`](LICENSE).
