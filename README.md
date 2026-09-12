# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Stable candidate `0.5.0` accepted in Phase 5A; immutable GitHub release and final packaged lifecycle proof are next; WordPress.org publication is not yet claimed**

```text
Product: AI Search Optimizer
Host: WordPress / WooCommerce
Technical slug: ai-search-optimizer
WordPress text domain: ai-search-optimizer
License: MIT
Current accepted stable candidate: 0.5.0
Historical accepted Free release candidate: 0.4.0
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

The accepted `0.5.0` stable candidate includes an administrator-only **Tools → AI Search Optimizer Support** page with two optional actions:

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

### Accepted stable candidate 0.5.0

Phase 5A accepted the exact reproducible candidate below after PR and post-merge validation:

```text
version            0.5.0
source commit      b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree        6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package            ai-search-optimizer-0.5.0.zip
package bytes      29397
package entries    13
package SHA-256    0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
CI artifact ID     10290013554
```

The candidate package was built twice with the same SHA-256. PR CI #87 passed, and post-merge `main` CI #88 passed on attempt 2 after a transient Docker Hub connection reset in the WP 5.6/PHP 7.4 image pull was diagnosed and re-run without any code change.

The historical accepted `0.4.0` candidate remains preserved as prior evidence:

```text
version            0.4.0
source commit      4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree        472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package            ai-search-optimizer-0.4.0.zip
package bytes      21745
package entries    11
package SHA-256    27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

### WordPress.org readiness

WordPress.org compatibility is a design constraint, not a post-release cleanup task. Production PHP passes WordPress Coding Standards and PHPCompatibilityWP, and CI blocks on the official WordPress Plugin Check in addition to the WordPress/PHP runtime matrix, Multisite/WooCommerce checks, EN/ES browser acceptance and reproducible package evidence.

The exact stable `0.5.0` candidate is accepted, but the plugin is **not yet claimed as published on WordPress.org**. Phase 5B must still create the immutable `0.5.0` tag/GitHub Release and prove clean install, upgrade, deactivate and uninstall behavior from the released package. WordPress.org submission/review remains a later external gate.

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

El candidato estable aceptado `0.5.0` incluye **Herramientas → Soporte de AI Search Optimizer** con dos acciones opcionales:

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

### Candidato estable 0.5.0 aceptado

La Fase 5A aceptó la identidad reproducible exacta siguiente tras validar PR y `main` post-merge:

```text
versión             0.5.0
commit fuente       b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
tree fuente         6a837ed67049ae04cdf59656cc15997a8d9bb7b3
paquete             ai-search-optimizer-0.5.0.zip
bytes               29397
entradas            13
SHA-256             0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
artifact CI ID      10290013554
```

El paquete se construyó dos veces con el mismo SHA-256. El CI #87 del PR pasó y el CI #88 post-merge de `main` pasó en el intento 2 después de diagnosticar un reset transitorio de Docker Hub durante la descarga de la imagen WP 5.6/PHP 7.4; no fue necesario modificar código.

Se conserva la evidencia histórica del candidato `0.4.0`:

```text
versión             0.4.0
commit fuente       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
tree fuente         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
paquete             ai-search-optimizer-0.4.0.zip
bytes               21745
entradas            11
SHA-256             27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

### Preparación para WordPress.org

La compatibilidad con WordPress.org se trata como una restricción de diseño desde el desarrollo. El PHP de producción supera WordPress Coding Standards y PHPCompatibilityWP, y el CI bloquea con WordPress Plugin Check oficial, matriz WordPress/PHP, Multisite/WooCommerce, navegador EN/ES y empaquetado reproducible.

El candidato estable exacto `0.5.0` está aceptado, pero **todavía no se afirma que el plugin esté publicado en WordPress.org**. La Fase 5B debe crear el tag inmutable `0.5.0`/GitHub Release y probar instalación limpia, actualización, desactivación y desinstalación desde el paquete publicado. El envío/revisión de WordPress.org seguirá siendo una puerta externa posterior.

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
- [`docs/PHASE4_EXTENSIONS_INTEGRATION.md`](docs/PHASE4_EXTENSIONS_INTEGRATION.md)
- [`docs/PHASE5A_STABLE_CANDIDATE.md`](docs/PHASE5A_STABLE_CANDIDATE.md)
- [`docs/CI_INCIDENTS.md`](docs/CI_INCIDENTS.md)
- [`docs/ENGINEERING_RULES.md`](docs/ENGINEERING_RULES.md)
- [`SECURITY.md`](SECURITY.md)

## License

MIT. See [`LICENSE`](LICENSE).
