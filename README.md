# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Development 0.5.0-dev — WordPress.org-first local Free workflow + optional contextual support/custom development**

```text
Product: AI Search Optimizer
Host: WordPress / WooCommerce
Repository: Emmakex/ai-search-optimizer
License: MIT
Text domain: ai-search-optimizer
Current development line: 0.5.0-dev
Accepted Free release candidate: 0.4.0
```

This repository owns the independently releasable WordPress plugin. The product is local-first: accepted Free functionality works without a Kairoseth account. Kairoseth is optional support/custom-development infrastructure, not a license, entitlement or feature-unlock dependency.

## English

### Local Free workflow

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

Safeguards include dedicated least-privilege WordPress capability/role, exact single-site/Multisite identity, deterministic source-grounded generation, compare-before-write, independent public verification, no arbitrary filesystem writes and no silent transmission of local site content to Kairoseth, AI providers or third-party analytics.

### Optional support and custom development

**Tools → AI Search Optimizer Support** provides two optional administrator actions:

- **Get optimization support** for setup/implementation guidance.
- **Request a custom improvement** for tailored development, integrations or automation.

Loading the support page performs no Kairoseth request. A network interaction begins only after an administrator deliberately activates one of the links to `https://kairoseth.com/custom-requests`.

The link carries only a bounded non-sensitive allow-list:

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

It does not automatically attach the site URL, administrator identity, llms.txt content, selected resources, findings, plugin/theme inventory, credentials, prompts, conversations, logs or database contents. The user decides what information to enter and submit on Kairoseth.

### WordPress.org distribution boundary

The plugin is being developed for WordPress.org compatibility from the start. Release acceptance includes official WordPress Plugin Check together with runtime, Multisite/WooCommerce, EN/ES, responsive/accessibility, lifecycle and reproducible-package validation.

The Free plugin does not use paid local feature locks or trial quotas. Optional Kairoseth services are external and user-initiated. No dashboard-wide advertising/nag is required for the product to function.

See [`docs/WORDPRESS_ORG_POLICY.md`](docs/WORDPRESS_ORG_POLICY.md).

### Claims boundary

AI Search Optimizer improves technical preparation and provides reproducible evidence. It does not guarantee ranking, citation, indexing, crawling, model ingestion, training inclusion or endorsement by third-party search/AI providers.

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

`0.4.0` is an accepted release candidate, not a claimed WordPress.org release. Current `0.5.0-dev` source must not be treated as that package.

### Data and uninstall behavior

Deactivation preserves the stored llms.txt deployment and uninstall preference. Before uninstalling, an authorized administrator can choose under **Tools → AI Search Optimizer Data** whether to preserve published llms.txt data or delete it. Uninstall always removes plugin setup/security state and performs Multisite cleanup site by site.

## Español

### Flujo Free local

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

El flujo funciona sin cuenta Kairoseth. Mantiene capability/rol WordPress de mínimo privilegio, identidad single-site/Multisite exacta, generación determinista basada en fuentes, compare-before-write, verificación pública independiente y ninguna transmisión silenciosa del contenido local a Kairoseth, proveedores IA o analítica de terceros.

### Soporte y desarrollo a medida opcionales

**Herramientas → Soporte AI Search Optimizer** ofrece dos acciones voluntarias para administradores:

- **Obtener soporte de optimización** para ayuda de configuración o implementación.
- **Solicitar una mejora a medida** para desarrollo personalizado, integraciones o automatización.

Cargar la página no realiza ninguna petición a Kairoseth. La interacción de red empieza solo cuando el administrador pulsa deliberadamente uno de los enlaces a `https://kairoseth.com/custom-requests`.

El enlace solo transporta contexto técnico no sensible allow-listed:

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

No adjunta automáticamente URL del sitio, identidad del administrador, contenido llms.txt, recursos seleccionados, hallazgos, inventario de plugins/temas, credenciales, prompts, conversaciones, logs ni base de datos. El usuario decide qué información enviar en Kairoseth.

### WordPress.org desde el inicio

El plugin se desarrolla con compatibilidad WordPress.org como requisito de ingeniería. La aceptación de release exige WordPress Plugin Check oficial además de runtime real, Multisite/WooCommerce, EN/ES, responsive/accesibilidad, lifecycle y paquete reproducible.

La edición Free no contiene bloqueos locales de pago ni cuotas trial. Kairoseth es una vía externa, opcional e iniciada por el usuario; no se necesitan avisos globales ni publicidad invasiva para utilizar el plugin.

Consulta [`docs/WORDPRESS_ORG_POLICY.md`](docs/WORDPRESS_ORG_POLICY.md).

### Límite de claims

AI Search Optimizer mejora la preparación técnica y aporta evidencia reproducible. No garantiza ranking, citaciones, indexación, crawling, ingestión por modelos, entrenamiento ni endorsement por proveedores externos.

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

`0.4.0` es un release candidate aceptado, no una publicación WordPress.org. El código `0.5.0-dev` actual es una línea de desarrollo posterior.

### Datos y desinstalación

Desactivar conserva el despliegue llms.txt y la preferencia de desinstalación. En **Herramientas → Datos de AI Search Optimizer** el administrador puede elegir conservar o eliminar el llms.txt publicado al desinstalar. La limpieza Multisite se realiza sitio por sitio.

## Documentation / Documentación

- [`docs/PRODUCT_V1.md`](docs/PRODUCT_V1.md)
- [`docs/ROADMAP.md`](docs/ROADMAP.md)
- [`docs/ACCEPTANCE.md`](docs/ACCEPTANCE.md)
- [`docs/WORDPRESS_ORG_POLICY.md`](docs/WORDPRESS_ORG_POLICY.md)
- [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md)
- [`docs/PHASE2C4_CLOSURE.md`](docs/PHASE2C4_CLOSURE.md)
- [`docs/ENGINEERING_RULES.md`](docs/ENGINEERING_RULES.md)

## License

MIT. See [`LICENSE`](LICENSE).
