# AI Search Optimizer — Product v1

[English](#english) · [Español](#español)

Status: **Building — local Free product accepted; WordPress.org-first support/custom path in development**  
Last reviewed: **10 September 2026**

## English

### Product identity

```text
Name: AI Search Optimizer
Descriptor: AI Search & llms.txt Optimization for WordPress
System: Kairoseth Extensions
Host: WordPress / WooCommerce
Repository: Emmakex/ai-search-optimizer
License: MIT
Text domain: ai-search-optimizer
Current development line: 0.5.0-dev
Accepted Free release candidate: 0.4.0
```

### User problem

WordPress site owners need a practical way to inspect and prepare public content for AI/search/agent consumption without being forced into a cloud account for basic functionality.

### Free promise

The WordPress.org plugin must provide useful functionality on its own:

1. inspect public AI Search readiness signals relevant to the plugin;
2. detect `robots.txt`, sitemap and `llms.txt` state;
3. select eligible public WordPress content;
4. produce deterministic, source-grounded `llms.txt`;
5. validate the generated artifact;
6. publish the site-local `llms.txt` under explicit administrator control;
7. independently verify the public result and exact SHA-256;
8. show actionable status/diagnostics;
9. support WordPress Multisite correctly;
10. recognize public WooCommerce content without WooCommerce API keys.

No Kairoseth account, paid entitlement, remote license or trial unlock is required for these accepted local features.

### Optional Kairoseth path

The plugin may offer contextual links for:

```text
Get optimization support
Request a custom improvement / custom development
```

Those links are not part of the Free feature entitlement. Loading the WordPress support page performs no external request. Only an explicit administrator CTA opens `https://kairoseth.com/custom-requests` with a strict non-sensitive context allow-list.

The user decides what contact, business or technical information to submit after arriving on Kairoseth.

### Product boundary

```text
Free     complete useful WordPress-local AI Search + llms.txt workflow
CTA      optional contextual support
Custom   optional development / integration / automation work
```

A separate paid local feature tier is deferred. The WordPress.org plugin must never use trial expiry, quota or paid feature locks for functionality shipped locally in the directory package.

### Privacy baseline

The Free workflow processes public WordPress content and local WordPress state. No telemetry or remote transmission is assumed by default.

The contextual support link must never automatically attach site URL, administrator identity, `llms.txt` body, selected resources, findings, plugin/theme inventory, WooCommerce customer/order data, credentials, prompts, conversations, logs or database contents.

### Claims boundary

Allowed: technical readiness, source-grounded optimization, deterministic artifacts, explicit publication and verification.

Not allowed: guaranteed ranking, citation, indexing, crawling, model ingestion, training inclusion or provider endorsement. GEO/AEO/LLMO/AI SEO may be used only as descriptive/search terminology without guaranteed-outcome claims.

### WordPress.org boundary

WordPress.org compatibility is a blocking product requirement, not a final packaging afterthought. See [`WORDPRESS_ORG_POLICY.md`](WORDPRESS_ORG_POLICY.md).

## Español

### Identidad

```text
Nombre: AI Search Optimizer
Descriptor: AI Search & llms.txt Optimization for WordPress
Sistema: Kairoseth Extensions
Host: WordPress / WooCommerce
Repositorio: Emmakex/ai-search-optimizer
Licencia: MIT
Text domain: ai-search-optimizer
Línea de desarrollo: 0.5.0-dev
Release candidate Free aceptada: 0.4.0
```

### Promesa Free

El plugin para WordPress.org debe aportar valor completo por sí mismo: analizar señales AI Search, detectar `robots.txt`/sitemap/`llms.txt`, seleccionar contenido público, generar y validar `llms.txt` determinista, publicar bajo control explícito, verificar públicamente SHA-256, mostrar diagnósticos, soportar Multisite y reconocer contenido WooCommerce público sin API keys.

Ninguna de esas funciones requiere cuenta Kairoseth, entitlement de pago, licencia remota ni desbloqueo trial.

### Ruta Kairoseth opcional

El plugin puede ofrecer CTAs contextuales para:

```text
Obtener soporte de optimización
Solicitar una mejora / desarrollo a medida
```

Cargar la página de soporte no contacta Kairoseth. Solo un clic explícito del administrador abre `https://kairoseth.com/custom-requests` con contexto técnico no sensible allow-listed. El usuario decide después qué información enviar.

### Modelo del producto

```text
Free     workflow local completo AI Search + llms.txt
CTA      soporte contextual opcional
Custom   desarrollo / integración / automatización opcionales
```

No se introduce un tier local de pago por ahora. El plugin de WordPress.org no usará expiración trial, cuotas ni bloqueos de funciones locales incluidas en el paquete.

### Privacidad

No se transmite automáticamente URL del sitio, identidad del administrador, contenido `llms.txt`, recursos seleccionados, hallazgos, inventario plugins/temas, datos de clientes/pedidos WooCommerce, credenciales, prompts, conversaciones, logs ni base de datos.

### WordPress.org

La compatibilidad con WordPress.org es un requisito bloqueante desde desarrollo. Consulta [`WORDPRESS_ORG_POLICY.md`](WORDPRESS_ORG_POLICY.md).
