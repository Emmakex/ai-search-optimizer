# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Public GitHub Release `0.5.1` accepted; exact package identity frozen; WordPress.org submission/review is next and directory availability is not yet claimed.**

```text
Product: AI Search Optimizer
Host: WordPress / WooCommerce
Technical slug: ai-search-optimizer
WordPress text domain: ai-search-optimizer
License: MIT
Current public GitHub release: 0.5.1
Previous public GitHub release: 0.5.0
Historical accepted Free release candidate: 0.4.0
WordPress.org status: not submitted / not published
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

Safeguards include least privilege, exact single-site/Multisite identity, deterministic source-grounded generation, compare-before-write, independent public verification, no arbitrary filesystem writes and no silent transmission of local site content to Kairoseth, AI providers or third-party analytics.

### Optional Kairoseth support

The current public release includes an administrator-only **Tools → AI Search Optimizer Support** page with two optional actions:

- **Improve with Kairoseth** — implementation guidance and AI Search / llms.txt optimization help.
- **Request custom development** — tailored integrations, automation, workflows and additional features.

Loading the support page makes no Kairoseth request. External navigation occurs only after an administrator deliberately clicks a CTA. The destination is fixed to:

```text
https://kairoseth.com/custom-requests
```

The link carries only these bounded technical/product fields:

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

It does not automatically attach the site URL, `llms.txt` content/hash, content inventory, administrator identity, WooCommerce content, plugin/theme inventory, credentials, tokens, prompts, conversations, logs, database contents or arbitrary WordPress options. Kairoseth is optional and does not license or unlock the local Free workflow.

### Current public GitHub Release `0.5.1`

```text
version             0.5.1
tag                 0.5.1
annotated tag       32a51daf4e32a8919114b6dc734a54a00952aed0
tag target          c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
source tree         e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
package             ai-search-optimizer-0.5.1.zip
package bytes       29560
package entries     13
package SHA-256     2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
GitHub Release ID   387576797
publication run     34695973744
published at        2026-09-12T13:17:34Z
```

The publication workflow verified the live Kairoseth CTA in EN/ES for both request types, reconstructed the exact accepted source, ran the `0.5.0 → 0.5.1` lifecycle proof, created a draft release, downloaded the uploaded ZIP/checksum/manifest back from GitHub, required exact SHA/size/entry count and byte identity, reran lifecycle acceptance against the downloaded ZIP, and only then made the release public.

### Historical release evidence

Previous public GitHub Release `0.5.0` remains preserved without redefinition:

```text
version             0.5.0
tag                 0.5.0
source commit       b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree         6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package bytes       29397
package entries     13
package SHA-256     0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
GitHub Release ID   387492480
```

Historical accepted `0.4.0` evidence:

```text
source commit       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256     27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

### WordPress.org status

`0.5.1` is the exact released package intended for the WordPress.org submission/review gate. It has passed WordPress Coding Standards, PHPCompatibilityWP, official WordPress Plugin Check, the WordPress/PHP runtime matrix, Multisite/WooCommerce, browser EN/ES, CTA production validation, lifecycle/upgrade acceptance and reproducible packaging.

The plugin is **not yet claimed as available on WordPress.org**. `ai-search-optimizer` remains only the target directory slug until the external directory has actually accepted and published the listing.

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

No transmite silenciosamente contenido local, credenciales ni datos privados a Kairoseth, proveedores IA o analítica externa.

### Soporte Kairoseth opcional

El release público actual incluye **Herramientas → Soporte de AI Search Optimizer**. La navegación a `https://kairoseth.com/custom-requests` ocurre solo tras un clic explícito y transporta únicamente el contexto técnico/producto acotado descrito arriba. No adjunta automáticamente URL del sitio, contenido/hash de `llms.txt`, inventario, identidad del administrador, datos WooCommerce, credenciales, tokens, prompts, logs ni base de datos.

### GitHub Release público actual `0.5.1`

```text
versión             0.5.1
tag                 0.5.1
tag anotado         32a51daf4e32a8919114b6dc734a54a00952aed0
commit fuente       c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
tree fuente         e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
paquete             ai-search-optimizer-0.5.1.zip
bytes               29560
entradas            13
SHA-256             2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
GitHub Release ID   387576797
run publicación     34695973744
```

El publicador verificó CTA EN/ES, reconstrucción exacta, upgrade `0.5.0 → 0.5.1`, publicación draft-first, descarga de assets, identidad byte-a-byte y un segundo lifecycle antes de hacer público el release.

`0.5.0` permanece como release público histórico con SHA `0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e`, y `0.4.0` permanece como evidencia histórica con SHA `27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c`.

### WordPress.org

`0.5.1` es el paquete exacto destinado al siguiente gate de envío/revisión. **Todavía no se afirma que AI Search Optimizer esté publicado en WordPress.org.** Solo tras aceptación y publicación real del directorio podrá actualizarse esa afirmación.

## Documentation / Documentación

- [`docs/PRODUCT_V1.md`](docs/PRODUCT_V1.md)
- [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md)
- [`docs/ROADMAP.md`](docs/ROADMAP.md)
- [`docs/ACCEPTANCE.md`](docs/ACCEPTANCE.md)
- [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md)
- [`docs/PHASE5A_STABLE_CANDIDATE.md`](docs/PHASE5A_STABLE_CANDIDATE.md)
- [`docs/PHASE5B_GITHUB_RELEASE.md`](docs/PHASE5B_GITHUB_RELEASE.md)
- [`docs/PHASE5C_WORDPRESS_ORG_SUBMISSION.md`](docs/PHASE5C_WORDPRESS_ORG_SUBMISSION.md)
- [`docs/PHASE5C2_GITHUB_RELEASE.md`](docs/PHASE5C2_GITHUB_RELEASE.md)
- [`docs/CI_INCIDENTS.md`](docs/CI_INCIDENTS.md)
- [`docs/ENGINEERING_RULES.md`](docs/ENGINEERING_RULES.md)
- [`SECURITY.md`](SECURITY.md)

## License

MIT. See [`LICENSE`](LICENSE).
