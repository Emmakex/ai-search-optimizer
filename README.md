# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Release candidate — Phase 2C4 final acceptance in progress; not publicly released**

```text
Product: AI Search Optimizer
System: Kairoseth Extensions
Host: WordPress / WooCommerce
Repository: Emmakex/ai-search-optimizer
License: MIT
Standalone release candidate: 0.4.0
Accepted predecessor: Kairoseth AI Web Readiness Connector 0.3.2
```

This repository owns the independently releasable WordPress plugin. The inherited connector identifiers remain compatible with Kairoseth Platform while the standalone Free workflow is finalized for public distribution.

## English

### What the Free plugin does

The `0.4.0` release-candidate line works locally without requiring a Kairoseth account:

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

Release hardening already has accepted real-runtime evidence for WordPress 5.6/PHP 7.4, WordPress 6.8/PHP 8.2 and WordPress 7.1/PHP 8.3, plus Multisite isolation, WooCommerce 11.1.0 and EN/ES browser acceptance. Phase 2C4 adds deterministic package/checksum evidence and the final Free release-candidate decision.

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

`0.4.0` is a release candidate, not a claimed public release. There is no GitHub Release or WordPress.org listing yet. The target WordPress.org slug is `ai-search-optimizer` until actually approved/reserved.

The accepted package must be tied to an exact source commit/tree and accompanied by a SHA-256 manifest. Public distribution remains a separate action after Phase 2C4 acceptance.

## Español

### Qué hace el plugin Free

La línea release candidate `0.4.0` funciona localmente sin exigir una cuenta Kairoseth:

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

El hardening de release ya dispone de evidencia runtime aceptada en WordPress 5.6/PHP 7.4, WordPress 6.8/PHP 8.2 y WordPress 7.1/PHP 8.3, además de Multisite, WooCommerce 11.1.0 y navegador real EN/ES. Phase 2C4 añade paquete determinista, manifest/checksum y la decisión final del release candidate Free.

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

`0.4.0` es un release candidate, no una release pública afirmada. Todavía no existe GitHub Release ni ficha WordPress.org. `ai-search-optimizer` sigue siendo el slug objetivo hasta su aprobación/reserva real.

El paquete aceptado debe quedar ligado a un commit/tree exacto y acompañado por manifest y SHA-256. La distribución pública será una acción separada después de aceptar Phase 2C4.

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
