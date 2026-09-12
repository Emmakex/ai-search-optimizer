# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Public GitHub Release `0.5.0` published and Phase 5B accepted; WordPress.org publication is not yet claimed**

```text
Product: AI Search Optimizer
Host: WordPress / WooCommerce
Technical slug: ai-search-optimizer
WordPress text domain: ai-search-optimizer
License: MIT
Current public GitHub release: 0.5.0
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

Safeguards include least privilege for the inherited managed connector, exact single-site/Multisite identity, deterministic source-grounded generation, compare-before-write, independent public verification, no arbitrary filesystem writes and no silent transmission of local site content to Kairoseth, AI providers or third-party analytics.

### Optional Kairoseth support

The public `0.5.0` release includes an administrator-only **Tools → AI Search Optimizer Support** page with two optional actions:

- **Improve with Kairoseth** — implementation guidance and AI Search / llms.txt optimization help.
- **Request custom development** — tailored integrations, automation, workflows and additional features.

Loading the support page makes no Kairoseth request. External navigation occurs only after an administrator deliberately clicks a CTA.

The destination is fixed to:

```text
https://kairoseth.com/custom-requests
```

The link carries only bounded technical/product context:

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

Before GitHub Release `0.5.0` was allowed to publish, the release workflow verified the **live production CTA** in all four customer combinations:

```text
EN + implementation support      PASS / HTTP 200
EN + business customization      PASS / HTTP 200
ES + implementation support      PASS / HTTP 200
ES + business customization      PASS / HTTP 200
```

The gate also verifies the canonical AI Search Optimizer identity, WordPress host context, EN/ES form copy and absence of forbidden automatically attached context. A broken or incompatible CTA therefore blocks future publication rather than shipping silently.

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

### Public GitHub Release 0.5.0

Phase 5A froze the exact candidate identity and Phase 5B published that same package without redefining it:

```text
version            0.5.0
tag                0.5.0
source commit      b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree        6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package            ai-search-optimizer-0.5.0.zip
package bytes      29397
package entries    13
package SHA-256    0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
GitHub Release ID  387492480
```

The annotated `0.5.0` tag peels exactly to the accepted source commit above. The release workflow rebuilt the package reproducibly, verified the historical `0.4.0` package, ran clean-install/upgrade/preserve/delete lifecycle acceptance, created the release as a draft, downloaded its ZIP back from GitHub, required byte identity and the exact SHA-256, reran lifecycle acceptance against the downloaded ZIP, and only then made the release public.

The historical accepted `0.4.0` candidate remains preserved as prior evidence:

```text
version            0.4.0
source commit      4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree        472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256    27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

### WordPress.org readiness

WordPress.org compatibility is a design constraint, not a post-release cleanup task. Production PHP passes WordPress Coding Standards and PHPCompatibilityWP, and CI blocks on official WordPress Plugin Check, the WordPress/PHP runtime matrix, Multisite/WooCommerce, EN/ES browser acceptance, release lifecycle and reproducible package evidence.

GitHub Release `0.5.0` is public, but the plugin is **not yet claimed as published on WordPress.org**. Phase 5C is the separate WordPress.org submission/review/approval gate.

`ai-search-optimizer` remains only the target WordPress.org slug until it is actually accepted/reserved and published by WordPress.org.

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

Las protecciones incluyen mínimo privilegio para el conector gestionado heredado, identidad single-site/Multisite exacta, generación determinista basada en fuentes, compare-before-write, verificación pública independiente, ausencia de escrituras arbitrarias en filesystem y ninguna transmisión silenciosa del contenido local a Kairoseth, proveedores IA o analítica de terceros.

### Soporte Kairoseth opcional

El release público `0.5.0` incluye **Herramientas → Soporte de AI Search Optimizer** con dos acciones opcionales:

- **Mejorar con Kairoseth** — orientación de implementación y mejora de AI Search / llms.txt.
- **Solicitar desarrollo a medida** — integraciones, automatizaciones, flujos y funciones adaptadas.

Cargar la página no realiza ninguna petición a Kairoseth. La navegación externa empieza únicamente cuando un administrador pulsa deliberadamente un CTA.

El destino está fijado a:

```text
https://kairoseth.com/custom-requests
```

Solo transporta contexto técnico/producto acotado:

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

Antes de permitir publicar el GitHub Release `0.5.0`, el workflow validó el **CTA real de producción** en las cuatro combinaciones:

```text
EN + soporte de implementación      PASS / HTTP 200
EN + personalización de negocio     PASS / HTTP 200
ES + soporte de implementación      PASS / HTTP 200
ES + personalización de negocio     PASS / HTTP 200
```

También se verifica identidad canónica, contexto WordPress, formulario EN/ES y ausencia de campos prohibidos enviados automáticamente. Un CTA roto o incompatible bloquea la publicación.

Kairoseth es opcional. No es un servidor de licencias, requisito de entitlement ni desbloqueo de funciones Free locales.

### Compatibilidad del conector gestionado heredado

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

Desactivar conserva el despliegue `llms.txt` y la preferencia de desinstalación. Antes de desinstalar, un administrador puede elegir en **Herramientas → Datos de AI Search Optimizer** entre conservar los datos publicados o eliminarlos. La desinstalación siempre limpia el estado de seguridad/configuración y en Multisite actúa sitio por sitio.

Consulta [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md).

### GitHub Release público 0.5.0

```text
versión             0.5.0
tag                 0.5.0
commit fuente       b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
tree fuente         6a837ed67049ae04cdf59656cc15997a8d9bb7b3
paquete             ai-search-optimizer-0.5.0.zip
bytes               29397
entradas            13
SHA-256             0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
GitHub Release ID   387492480
```

El tag anotado `0.5.0` apunta exactamente al commit aceptado. El workflow reconstruyó el paquete, probó actualización desde `0.4.0`, instalación limpia y ambos modos de desinstalación, creó el release primero como draft, volvió a descargar el ZIP desde GitHub, exigió identidad byte-a-byte/SHA y repitió el lifecycle antes de hacerlo público.

La evidencia histórica `0.4.0` se mantiene sin redefinir:

```text
commit fuente       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
tree fuente         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
SHA-256             27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

### Preparación para WordPress.org

El PHP de producción supera WordPress Coding Standards y PHPCompatibilityWP, y el CI bloquea con WordPress Plugin Check oficial, matriz WordPress/PHP, Multisite/WooCommerce, navegador EN/ES, lifecycle y empaquetado reproducible.

El GitHub Release `0.5.0` ya es público, pero **todavía no se afirma que el plugin esté publicado en WordPress.org**. La Fase 5C cubre el envío, revisión y aprobación externa del directorio.

`ai-search-optimizer` sigue siendo el slug objetivo hasta su aceptación/reserva y publicación real.

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
- [`docs/PHASE5A_STABLE_CANDIDATE.md`](docs/PHASE5A_STABLE_CANDIDATE.md)
- [`docs/PHASE5B_GITHUB_RELEASE.md`](docs/PHASE5B_GITHUB_RELEASE.md)
- [`docs/CI_INCIDENTS.md`](docs/CI_INCIDENTS.md)
- [`docs/ENGINEERING_RULES.md`](docs/ENGINEERING_RULES.md)
- [`SECURITY.md`](SECURITY.md)

## License

MIT. See [`LICENSE`](LICENSE).
