# AI Search Optimizer

**AI Search & llms.txt Optimization for WordPress**

[English](#english) · [Español](#español)

Status: **Development 0.5.0-dev — Phase 3 optional Kairoseth connection; accepted Free 0.4.0 RC preserved**

```text
Product: AI Search Optimizer
System: Kairoseth Extensions
Host: WordPress / WooCommerce
Repository: Emmakex/ai-search-optimizer
License: MIT
Current development line: 0.5.0-dev
Accepted Free release candidate: 0.4.0
Accepted predecessor: Kairoseth AI Web Readiness Connector 0.3.2
```

This repository owns the independently releasable WordPress plugin. The local Free workflow remains useful without Kairoseth, while the current development line adds an optional guided connection to Kairoseth AI Search Optimizer without changing the inherited connector protocol.

## English

### Local Free workflow

The accepted Free workflow works locally without requiring a Kairoseth account:

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

### Phase 3A — optional Kairoseth connection readiness

`0.5.0-dev` adds a dedicated **Tools → AI Search Optimizer · Kairoseth** page. It checks only local prerequisites for the already accepted Kairoseth WordPress connection contract:

- exact WordPress home/root identity, Blog ID and Network ID;
- HTTPS on the WordPress home URL;
- native WordPress Application Password availability;
- presence of the `Kairoseth AI Web Deployer` role and dedicated deployment capability;
- exact inherited `/wp-json/kairoseth-ai-web-readiness/v1/connection` endpoint;
- site-local `llms.txt` target.

The page does **not** call Kairoseth automatically, collect an Application Password, persist Kairoseth tokens or decide whether a cloud connection exists. “Ready to connect” means only that the WordPress-side prerequisites are satisfied.

The explicit handoff opens `https://kairoseth.com/app` only after a user clicks it. No site identifier, username, Application Password, token or organization data is placed in the handoff URL. Kairoseth resolves the authenticated account/organization/product server-side and validates WordPress through the inherited least-privilege REST contract.

### Inherited managed-connection contract

The accepted Kairoseth Platform integration continues to use:

```text
REST namespace     kairoseth-ai-web-readiness/v1
GET                /connection
GET                /deployment
PUT                /deployment
site pin            blogId + networkId + exact homeUrl
safe mutation       expectedCurrentDeployed + expectedCurrentContentHash
credential storage  encrypted server-side in Kairoseth
```

The standalone plugin does not introduce a second cloud authentication protocol.

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

The current `0.5.0-dev` source must not be treated as that accepted package. CI produces separate reproducible **development-package** evidence for Phase 3.

See [`docs/PHASE2C4_CLOSURE.md`](docs/PHASE2C4_CLOSURE.md).

### Data and uninstall behavior

Deactivation preserves the stored `llms.txt` deployment and uninstall preference. Before uninstalling, an authorized administrator can choose under **Tools → AI Search Optimizer Data** whether to preserve published `llms.txt` data (safe default) or delete it. Uninstall always removes plugin setup/security state and performs Multisite cleanup site by site.

See [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md).

### Release truth

`0.4.0` is an accepted release candidate, not a claimed public release. `0.5.0-dev` is unreleased development. There is currently no GitHub Release or WordPress.org listing claimed by this repository. `ai-search-optimizer` remains the target WordPress.org slug until actually approved/reserved.

## Español

### Flujo Free local

El flujo Free aceptado funciona localmente sin exigir una cuenta Kairoseth:

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

Las protecciones incluyen capability/rol WordPress de mínimo privilegio, identidad single-site/Multisite exacta, generación determinista basada en fuentes, compare-before-write, verificación pública independiente, ausencia de escrituras arbitrarias en filesystem y ninguna transmisión silenciosa del contenido local a Kairoseth, proveedores IA o analítica de terceros.

### Phase 3A — preparación para conexión opcional con Kairoseth

`0.5.0-dev` añade la página **Herramientas → AI Search Optimizer · Kairoseth**. Comprueba únicamente prerrequisitos locales del contrato WordPress ya aceptado:

- raíz WordPress exacta, Blog ID y Network ID;
- HTTPS en la URL principal;
- disponibilidad nativa de Application Passwords de WordPress;
- presencia del rol `Kairoseth AI Web Deployer` y su capability dedicada;
- endpoint heredado exacto `/wp-json/kairoseth-ai-web-readiness/v1/connection`;
- destino `llms.txt` site-local.

La pantalla **no** llama automáticamente a Kairoseth, no recoge una Application Password, no guarda tokens Kairoseth y no decide si existe una conexión cloud. “Listo para conectar” solo significa que WordPress cumple los prerrequisitos locales.

El acceso explícito abre `https://kairoseth.com/app` únicamente cuando el usuario pulsa el botón. La URL no transporta identificador del sitio, usuario, Application Password, token ni datos de organización. Kairoseth resuelve cuenta/organización/producto server-side y valida WordPress mediante el contrato REST de mínimo privilegio heredado.

### Contrato de conexión gestionada heredado

```text
namespace REST      kairoseth-ai-web-readiness/v1
GET                 /connection
GET                 /deployment
PUT                 /deployment
pin del sitio       blogId + networkId + homeUrl exacta
mutación segura     expectedCurrentDeployed + expectedCurrentContentHash
credencial          cifrada server-side en Kairoseth
```

El plugin standalone no introduce un segundo protocolo de autenticación cloud.

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

El código actual `0.5.0-dev` no debe confundirse con ese paquete aceptado. CI genera evidencia reproducible separada para paquetes de desarrollo de Phase 3.

Consulta [`docs/PHASE2C4_CLOSURE.md`](docs/PHASE2C4_CLOSURE.md).

### Datos y desinstalación

Desactivar conserva el despliegue `llms.txt` y la preferencia de desinstalación. Antes de desinstalar, un administrador autorizado puede elegir en **Herramientas → Datos de AI Search Optimizer** entre conservar los datos publicados (opción segura por defecto) o eliminarlos. La desinstalación siempre limpia el estado de seguridad/configuración del plugin y en Multisite actúa sitio por sitio.

Consulta [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md).

### Estado de release

`0.4.0` es un release candidate aceptado, no una release pública afirmada. `0.5.0-dev` es desarrollo no publicado. Actualmente este repositorio no afirma disponer de GitHub Release ni ficha WordPress.org. `ai-search-optimizer` sigue siendo el slug objetivo hasta su aprobación/reserva real.

## Documentation / Documentación

- [`docs/PRODUCT_V1.md`](docs/PRODUCT_V1.md)
- [`docs/ARCHITECTURE.md`](docs/ARCHITECTURE.md)
- [`docs/ROADMAP.md`](docs/ROADMAP.md)
- [`docs/ACCEPTANCE.md`](docs/ACCEPTANCE.md)
- [`docs/KAIROSETH_CONNECTION.md`](docs/KAIROSETH_CONNECTION.md)
- [`docs/DATA_RETENTION.md`](docs/DATA_RETENTION.md)
- [`docs/NAMING_SEO.md`](docs/NAMING_SEO.md)
- [`docs/PROVENANCE.md`](docs/PROVENANCE.md)
- [`docs/PHASE2C4_CLOSURE.md`](docs/PHASE2C4_CLOSURE.md)
- [`docs/ENGINEERING_RULES.md`](docs/ENGINEERING_RULES.md)

## License

MIT. See [`LICENSE`](LICENSE).