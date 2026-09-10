# AI Search Optimizer — Product v1

[English](#english) · [Español](#español)

Status: **Incubating / Building — release not accepted yet**  
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
Standalone baseline: 0.4.0 unreleased
```

### User problem

WordPress site owners need a practical way to inspect and prepare public content for AI/search/agent consumption without being forced into a cloud account for basic functionality.

### Free v1 promise

Free must provide useful local functionality before public release:

1. inspect public AI Search readiness signals relevant to the plugin;
2. detect `robots.txt`, sitemap and `llms.txt` state;
3. select eligible public WordPress content;
4. produce a deterministic, source-grounded `llms.txt` preview;
5. validate the generated artifact;
6. publish the site-local `llms.txt` under explicit user control;
7. show actionable status and diagnostics;
8. support WordPress Multisite correctly;
9. recognize WooCommerce public content without requiring WooCommerce API keys.

### Optional Kairoseth-connected layer

A connected Kairoseth Platform workflow may add advanced whole-site analysis, Importance / AI Readiness evidence, source-grounded curation, immutable revisions, history/diff, optional provider-neutral AI assistance, managed publication orchestration and independent public hash verification.

The plugin never grants Kairoseth organization roles or entitlements. Those remain server-authoritative.

### Commercial boundary

```text
Free    useful WordPress-local AI Search + llms.txt workflow
Pro     deferred until repeated reusable demand justifies it
Custom  contextual Kairoseth Custom Request for bespoke work
```

Custom must use the shared Kairoseth Custom Requests path before the product is marked Available in the Kairoseth Extensions catalog.

### Claims boundary

Allowed: readiness, source-grounded optimization, deterministic artifacts, publication and verification.

Not allowed: guaranteed ranking, citation, indexing, crawling, model ingestion, training inclusion or provider endorsement. GEO/AEO/LLMO/AI SEO may be used as market/search terms only without guaranteed-outcome claims.

### Data and privacy baseline

The local Free workflow should operate on public WordPress content and local WordPress state. No telemetry or remote transmission is assumed by default. Any Kairoseth-connected feature must be explicit, documented and limited to the data needed for the requested operation. Provider credentials must never be embedded in the distributed plugin.

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
Baseline standalone: 0.4.0 sin publicar
```

### Promesa Free v1

La versión Free debe aportar valor local real antes de publicarse: inspeccionar señales de preparación AI Search, detectar `robots.txt`/sitemap/`llms.txt`, seleccionar contenido público, generar y validar `llms.txt` determinista, publicarlo con control explícito, mostrar diagnósticos accionables, soportar Multisite y reconocer contenido WooCommerce sin API keys WooCommerce.

### Capa Kairoseth opcional

La conexión con Kairoseth Platform podrá añadir análisis global, Importance / AI Readiness, curación basada en fuentes, revisiones/historial, asistencia IA provider-neutral opcional, publicación gestionada y verificación pública independiente.

El plugin nunca concede roles ni entitlements de organización Kairoseth; son server-authoritative.

### Modelo comercial

```text
Free    workflow local útil de AI Search + llms.txt
Pro     diferido hasta que exista demanda reutilizable repetida
Custom  Kairoseth Custom Request contextual
```

No se permiten garantías de ranking, citación, indexación, crawling, ingestión o entrenamiento por terceros.
