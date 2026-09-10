# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Release candidate accepted — Phase 2 complete; Free 0.4.0 not publicly distributed**

```text
Product: AI Search Optimizer
System: Kairoseth Extensions
Host: WordPress / WooCommerce
Repository: Emmakex/ai-search-optimizer
License: MIT
Accepted Free release candidate: 0.4.0
Accepted predecessor: Kairoseth AI Web Readiness Connector 0.3.2
```

This repository owns the independently releasable WordPress plugin. The inherited connector identifiers remain compatible with Kairoseth Platform while the local Free workflow is now technically accepted for a later public-distribution action.

## English

### What the Free plugin does

The accepted `0.4.0` Free release candidate works locally without requiring a Kairoseth account:

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

Phase 2 acceptance includes real generated-ZIP runtime evidence for WordPress 5.6/PHP 7.4, WordPress 6.8/PHP 8.2 and WordPress 7.1/PHP 8.3, plus Multisite isolation, WooCommerce 11.1.0, real-browser EN/ES acceptance and deterministic release-candidate packaging.

### Release candidate identity

```text
version            0.4.0
source commit      4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree        472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package            ai-search-optimizer-0.4.0.zip
package bytes      21745
package entries    11
package SHA-256    27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

See [`docs/PHASE2C4_CLOSURE.md`](docs/PHASE2C4_CLOSURE.md) for the canonical acceptance record.

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

`0.4.0` is an **accepted release candidate**, not a claimed public release. There is no GitHub Release or WordPress.org listing yet. The target WordPress.org slug is `ai-search-optimizer` until actually approved/reserved.

Public distribution is a separate Phase 5 action with its own tag/release, public-download and WordPress.org gates.

## Español

### Qué hace el plugin Free

El release candidate Free `0.4.0` aceptado funciona localmente sin exigir una cuenta Kairoseth:

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

La aceptación de Phase 2 incluye runtime real del ZIP generado en WordPress 5.6/PHP 7.4, WordPress 6.8/PHP 8.2 y WordPress 7.1/PHP 8.3, además de Multisite, WooCommerce 11.1.0, navegador real EN/ES y empaquetado determinista del release candidate.

### Identidad del release candidate aceptado

```text
versión             0.4.0
commit fuente       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
tree fuente         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
paquete             ai-search-optimizer-0.4.0.zip
bytes               21745
entradas             11
SHA-256             27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

Consulta [`docs/PHASE2C4_CLOSURE.md`](docs/PHASE2C4_CLOSURE.md) para la evidencia canónica.

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

`0.4.0` es un **release candidate aceptado**, no una release pública afirmada. Todavía no existe GitHub Release ni ficha WordPress.org. `ai-search-optimizer` sigue siendo el slug objetivo hasta su aprobación/reserva real.

La distribución pública es una acción separada de Phase 5 con gates propios de tag/release, descarga pública y WordPress.org.

## Documentation / Documentación

- [`docs/PRODUCT_V1.md`](docs/PRODUCT_V1.md)
- [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md)
- [`docs/ROADMAP.md`](docs/ROADMAP.md)
- [`docs/ACCEPTANCE.md`](docs/ACCEPTANCE.md)
- [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md)
- [`docs/NAMING_SEO.md`](docs/NAMING_SEO.md)
- [`docs/PROVENANCE.md`](docs/PROVENANCE.md)
- [`docs/PHASE2C4_CLOSURE.md`](docs/PHASE2C4_CLOSURE.md)
- [`docs/ENGINEERING_RULES.md`](docs/ENGINEERING_RULES.md)

## License

MIT. See [`LICENSE`](LICENSE).
