# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Development `0.5.0-dev` — local Free workflow and optional contextual support accepted; WordPress.org hardening gates accepted; directory publication not yet claimed**

```text
Product: AI Search Optimizer
Host: WordPress / WooCommerce
Technical slug: ai-search-optimizer
WordPress text domain: ai-search-optimizer
License: MIT
Current development line: 0.5.0-dev
Accepted Free release candidate: 0.4.0
```

## English

### Local Free workflow

AI Search Optimizer works locally without requiring a Kairoseth account:

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

Safeguards include a dedicated least-privilege WordPress capability/role for the inherited managed connector, exact single-site/Multisite identity, deterministic source-grounded generation, compare-before-write, independent public verification, no arbitrary filesystem writes and no silent transmission of local site content to Kairoseth, AI providers or third-party analytics.

### Optional Kairoseth support

The development line includes an administrator-only **Tools → AI Search Optimizer Support** page with two optional actions:

- **Improve with Kairoseth** — implementation guidance and help improving an AI Search / llms.txt setup.
- **Request custom development** — tailored integrations, automation, workflows and additional features.

Loading the support page makes no Kairoseth request. External navigation occurs only after an administrator deliberately clicks a CTA.

The link goes only to `https://kairoseth.com/custom-requests` and carries a bounded technical/product context:

```text
source
extensionSlug
extensionName
extensionVersion
hostPlatform
hostPlatformVersion
locale
requestType
```

It does not automatically attach the site URL, `llms.txt` content/hash, content inventory, administrator identity, WooCommerce content, plugin/theme inventory, credentials, tokens, prompts, conversations, logs, database contents or arbitrary WordPress options. The user decides what contact, business, website and request details to submit on Kairoseth.

Kairoseth is optional. It is not a license server, entitlement requirement or feature unlock for the local Free workflow.

### Inherited managed connector compatibility

The accepted connector compatibility remains available for separately configured managed integrations:

```text
REST namespace     kairoseth-ai-web-readiness/v1
GET                /connection
GET                /deployment
PUT                /deployment
site pin            blogId + networkId + exact homeUrl
safe mutation       expectedCurrentDeployed + expectedCurrentContentHash
```

This REST surface does not initiate outbound communication by itself and is not required to use the local Free workflow.

### Data and uninstall behavior

Deactivation preserves the stored `llms.txt` deployment and uninstall preference. Before uninstalling, an authorized administrator can choose under **Tools → AI Search Optimizer Data** whether to preserve published `llms.txt` data (safe default) or delete it. Uninstall always removes plugin setup/security state and performs Multisite cleanup site by site.

See [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md).

### Accepted 0.4.0 release candidate

```text
version            0.4.0
source commit      4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree        472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package            ai-search-optimizer-0.4.0.zip
package bytes      21745
package entries    11
package SHA-256    27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

The current `0.5.0-dev` source must not be treated as that accepted package.

### WordPress.org readiness

WordPress.org compatibility is a design constraint, not a post-release cleanup task. Phase 3 hardening is accepted: production PHP passes WordPress Coding Standards and PHPCompatibilityWP, and CI blocks on the official WordPress Plugin Check in addition to the WordPress/PHP runtime matrix, Multisite/WooCommerce checks, EN/ES browser acceptance and reproducible package evidence.

The plugin is not yet claimed as published on WordPress.org. Final directory submission still requires a deliberate stable version/tag/package, aligned plugin/readme metadata, final release-policy/readme review and successful external WordPress.org approval.

`ai-search-optimizer` remains the target WordPress.org slug until it is actually accepted/reserved.

### Claims boundary

AI Search Optimizer improves preparation and provides reproducible technical evidence. It does not guarantee ranking, citation, indexing, crawling, AI ingestion, training inclusion or endorsement by third-party providers.

## Español

### Flujo Free local

AI Search Optimizer funciona localmente sin exigir una cuenta Kairoseth:

```text
analizar preparación AI Search de WordPress
→ detectar robots.txt / sitemap / llms.txt
→ inventariar contenido público elegible
→ incluir productos públicos WooCommerce cuando existan
→ seleccionar recursos
→ generar llms.txt determinista
→ validar
→ publicar explícitamente
→ leer /llms.txt públicamente
→ verificar SHA-256 exacto
```

Las protecciones incluyen capability/rol WordPress de mínimo privilegio para el conector gestionado heredado, identidad single-site/Multisite exacta, generación determinista basada en fuentes, compare-before-write, verificación pública independiente, ausencia de escrituras arbitrarias en filesystem y ninguna transmisión silenciosa del contenido local a Kairoseth, proveedores IA o analítica de terceros.

### Soporte Kairoseth opcional

La línea de desarrollo incluye **Herramientas → Soporte de AI Search Optimizer** con dos acciones opcionales:

- **Mejorar con Kairoseth** — orientación de implementación y ayuda para mejorar la configuración AI Search / llms.txt.
- **Solicitar desarrollo a medida** — integraciones, automatizaciones, flujos y funciones adaptadas.

Cargar la página no realiza ninguna petición a Kairoseth. La navegación externa empieza únicamente cuando un administrador pulsa deliberadamente un CTA.

El enlace utiliza únicamente `https://kairoseth.com/custom-requests` y transporta un contexto técnico/producto acotado:

```text
source
extensionSlug
extensionName
extensionVersion
hostPlatform
hostPlatformVersion
locale
requestType
```

No adjunta automáticamente URL del sitio, contenido/hash de `llms.txt`, inventario de contenido, identidad del administrador, datos WooCommerce, inventario de plugins/temas, credenciales, tokens, prompts, conversaciones, logs, base de datos ni opciones arbitrarias de WordPress. El usuario decide qué información de contacto, empresa, web y solicitud enviar en Kairoseth.

Kairoseth es opcional. No es un servidor de licencias, requisito de entitlement ni desbloqueo de funciones Free locales.

### Compatibilidad del conector gestionado heredado

Se conserva la compatibilidad técnica aceptada para integraciones gestionadas configuradas por separado:

```text
namespace REST      kairoseth-ai-web-readiness/v1
GET                 /connection
GET                 /deployment
PUT                 /deployment
pin del sitio       blogId + networkId + homeUrl exacta
mutación segura     expectedCurrentDeployed + expectedCurrentContentHash
```

Esta superficie REST no inicia comunicaciones salientes por sí sola y no es necesaria para utilizar el flujo Free local.

### Datos y desinstalación

Desactivar conserva el despliegue `llms.txt` y la preferencia de desinstalación. Antes de desinstalar, un administrador autorizado puede elegir en **Herramientas → Datos de AI Search Optimizer** entre conservar los datos publicados (opción segura por defecto) o eliminarlos. La desinstalación siempre limpia el estado de seguridad/configuración del plugin y en Multisite actúa sitio por sitio.

Consulta [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md).

### Release candidate 0.4.0 aceptado

```text
versión             0.4.0
commit fuente       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
tree fuente         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
paquete             ai-search-optimizer-0.4.0.zip
bytes               21745
entradas            11
SHA-256             27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

El código actual `0.5.0-dev` no debe confundirse con ese paquete aceptado.

### Preparación para WordPress.org

La compatibilidad con WordPress.org se trata como una restricción de diseño desde el desarrollo. El hardening de la Fase 3 está aceptado: el PHP de producción supera WordPress Coding Standards y PHPCompatibilityWP, y el CI bloquea con WordPress Plugin Check oficial, matriz WordPress/PHP, Multisite/WooCommerce, navegador EN/ES y empaquetado reproducible.

Todavía no se afirma que el plugin esté publicado en WordPress.org. La presentación final requerirá una versión/tag/paquete estable deliberado, metadata alineada, revisión final de políticas/readme de release y aprobación externa de WordPress.org.

`ai-search-optimizer` sigue siendo el slug objetivo hasta su aceptación/reserva real.

### Límite de claims

AI Search Optimizer mejora la preparación y proporciona evidencia técnica reproducible. No garantiza ranking, citación, indexación, crawling, ingestión por IA, inclusión en entrenamiento ni respaldo por proveedores externos.

## Documentation / Documentación

- [`docs/PRODUCT_V1.md`](docs/PRODUCT_V1.md)
- [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md)
- [`docs/ROADMAP.md`](docs/ROADMAP.md)
- [`docs/ACCEPTANCE.md`](docs/ACCEPTANCE.md)
- [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md)
- [`docs/NAMING_SEO.md`](docs/NAMING_SEO.md)
- [`docs/PROVENANCE.md`](docs/PROVENANCE.md)
- [`docs/PHASE2C4_CLOSURE.md`](docs/PHASE2C4_CLOSURE.md)
- [`docs/PHASE3A_ACCEPTANCE.md`](docs/PHASE3A_ACCEPTANCE.md)
- [`docs/PHASE3B_CONTEXTUAL_SUPPORT.md`](docs/PHASE3B_CONTEXTUAL_SUPPORT.md)
- [`docs/PHASE3C_ACCEPTANCE.md`](docs/PHASE3C_ACCEPTANCE.md)
- [`docs/ENGINEERING_RULES.md`](docs/ENGINEERING_RULES.md)
- [`SECURITY.md`](SECURITY.md)

## License

MIT. See [`LICENSE`](LICENSE).
