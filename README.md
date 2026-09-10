# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Building — Free release hardening; not released yet**

```text
Product: AI Search Optimizer
System: Kairoseth Extensions
Host: WordPress / WooCommerce
Repository: Emmakex/ai-search-optimizer
License: MIT
Standalone baseline: 0.4.0 (unreleased)
Accepted predecessor: Kairoseth AI Web Readiness Connector 0.3.2
```

This repository owns the independently releasable WordPress plugin. The inherited connector identifiers remain compatible with Kairoseth Platform while the standalone Free workflow is hardened for release.

## English

### What the Free plugin does

The current `0.4.0` development baseline works locally without requiring a Kairoseth account:

```text
inspect WordPress AI-search readiness
→ detect robots.txt / sitemap / llms.txt state
→ inventory eligible public WordPress content
→ include public WooCommerce products when available
→ select resources
→ build deterministic llms.txt
→ validate it
→ publish explicitly
→ read back public /llms.txt
→ verify exact SHA-256
```

Current safeguards include:

- dedicated least-privilege WordPress capability and deployer role;
- exact single-site / Multisite identity;
- site-local `llms.txt` serving;
- deterministic source-grounded generation with no generated timestamps;
- validation of structure, size, duplicate URLs and same-site URL scope;
- compare-before-write protection against stale-page replacement;
- idempotent same-content publication;
- independent public read-back with redirects disabled;
- exact generated/stored/public SHA-256 verification;
- no FTP/SFTP, hosting-panel, database or WooCommerce API credentials;
- no arbitrary filesystem writes;
- no silent transmission of local site content to Kairoseth, AI providers or third-party analytics.

### Data and uninstall behavior

Deactivation preserves the stored `llms.txt` deployment and the uninstall preference.

Before uninstalling, an authorized administrator can choose under **Tools → AI Search Optimizer Data** whether uninstall should:

- **preserve published `llms.txt` data** — the safe default, allowing recovery after reinstall; or
- **delete published `llms.txt` data** — permanently remove the stored deployment for the current WordPress site.

Uninstall always removes the plugin setup marker, custom deployer role, administrator capability and retention preference. Multisite cleanup is performed site by site. While the plugin is absent, its dynamic public `/llms.txt` route is not available even when stored deployment data was preserved.

See [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md).

### Compatibility boundary

The public product name changed, but the accepted connector protocol identifiers from `0.3.2` remain intentionally compatible in the `0.4.0` line. Existing Kairoseth Platform integrations must not break merely because the WordPress code moved repositories.

See [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md) and [`docs/PROVENANCE.md`](docs/PROVENANCE.md).

### Release truth

There is **no public 0.4.0 release yet** and no WordPress.org listing is claimed. The target WordPress.org slug is `ai-search-optimizer` until actually approved/reserved.

Phase 2A local analysis and Phase 2B safe publication are accepted. Phase 2C is hardening install/update/deactivate/uninstall behavior, real WordPress/PHP compatibility, Multisite/WooCommerce behavior, responsive/accessibility, privacy/security and release packaging before distribution.

## Español

### Qué hace el plugin Free

La baseline de desarrollo `0.4.0` funciona localmente sin exigir una cuenta Kairoseth:

```text
analizar preparación AI Search de WordPress
→ detectar robots.txt / sitemap / llms.txt
→ inventariar contenido público elegible
→ incluir productos públicos WooCommerce cuando existan
→ seleccionar recursos
→ generar llms.txt determinista
→ validar
→ publicar de forma explícita
→ leer /llms.txt públicamente
→ verificar SHA-256 exacto
```

Protecciones actuales:

- capability y rol WordPress dedicados de mínimo privilegio;
- identidad exacta single-site / Multisite;
- `llms.txt` site-local;
- generación determinista basada en contenido público y sin timestamps generados;
- validación de estructura, tamaño, URLs duplicadas y URLs externas al sitio;
- compare-before-write frente a páginas desactualizadas;
- publicación idempotente cuando el contenido no cambia;
- lectura pública independiente sin seguir redirecciones;
- verificación SHA-256 exacta entre contenido generado, guardado y público;
- sin FTP/SFTP, panel de hosting, base de datos ni API keys de WooCommerce;
- sin escrituras arbitrarias de filesystem;
- sin transmisión silenciosa del contenido local a Kairoseth, proveedores IA o analítica de terceros.

### Datos y desinstalación

Desactivar el plugin conserva el despliegue `llms.txt` guardado y la preferencia de desinstalación.

Antes de desinstalar, un administrador autorizado puede elegir en **Herramientas → Datos de AI Search Optimizer** si la desinstalación debe:

- **conservar los datos publicados de `llms.txt`** — opción segura por defecto para poder recuperarlos al reinstalar; o
- **eliminar los datos publicados de `llms.txt`** — borrar permanentemente el despliegue guardado del sitio WordPress actual.

La desinstalación siempre elimina el marcador interno de configuración, el rol de despliegue, la capability del administrador y la preferencia de conservación. En Multisite la limpieza se realiza sitio por sitio. Mientras el plugin no esté instalado, su ruta dinámica pública `/llms.txt` no estará disponible aunque se hayan conservado los datos.

Consulta [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md).

### Compatibilidad

Cambia el nombre público del producto, pero los identificadores técnicos heredados del conector aceptado `0.3.2` se mantienen en la línea `0.4.0` para no romper Kairoseth Platform.

Consulta [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md) y [`docs/PROVENANCE.md`](docs/PROVENANCE.md).

### Estado de release

**0.4.0 todavía no está publicado** y no afirmamos disponer de ficha en WordPress.org. `ai-search-optimizer` sigue siendo el slug objetivo hasta su aprobación/reserva real.

Phase 2A de análisis local y Phase 2B de publicación segura están aceptadas. Phase 2C endurece instalación/update/desactivación/desinstalación, compatibilidad WordPress/PHP real, Multisite/WooCommerce, responsive/accesibilidad, privacidad/seguridad y empaquetado antes de distribución.

## Documentation / Documentación

- [`docs/PRODUCT_V1.md`](docs/PRODUCT_V1.md)
- [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md)
- [`docs/ROADMAP.md`](docs/ROADMAP.md)
- [`docs/ACCEPTANCE.md`](docs/ACCEPTANCE.md)
- [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md)
- [`docs/NAMING_SEO.md`](docs/NAMING_SEO.md)
- [`docs/PROVENANCE.md`](docs/PROVENANCE.md)
- [`docs/ENGINEERING_RULES.md`](docs/ENGINEERING_RULES.md)

## License

MIT. See [`LICENSE`](LICENSE).
