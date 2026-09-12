# Changelog

All notable standalone AI Search Optimizer changes are recorded here.

## 0.5.1 — Public GitHub release

### Changed
- Aligned plugin header, inherited connector version and WordPress Stable tag to `0.5.1`.
- Removed stale pre-publication wording from the packaged WordPress readme.
- Changed the plugin header description to describe the actual local-first AI Search / `llms.txt` workflow.
- Added blocking live Kairoseth CTA EN/ES validation for the exact `0.5.1` line.
- Proved clean install and `0.5.0 → 0.5.1` upgrade/preserve/delete lifecycle behavior.
- Published the accepted `0.5.1` package through a fail-closed draft-first GitHub release workflow.

### Release evidence

```text
accepted source          c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
accepted source tree     e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
package                  ai-search-optimizer-0.5.1.zip
package bytes            29560
package entries          13
package SHA-256          2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
implementation PR        #32
final implementation CI  #107 / run 34692689075 — PASS
post-merge CI            #108 / run 34692826856 — PASS
5C.1 closure CI          #109 / run 34693128380 — PASS
5C.1 post-merge CI       #110 / run 34695428487 — PASS
publication tooling PR   #34
publication tooling CI   #111 / run 34695699823 — PASS
publication main CI      #112 / run 34695819740 — PASS
publication run          34695973744 — PASS
annotated tag object     32a51daf4e32a8919114b6dc734a54a00952aed0
tag target               c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
GitHub Release ID        387576797
published                2026-09-12T13:17:34Z
```

The publication workflow rebuilt the accepted package, verified exact SHA/bytes/entries, ran lifecycle acceptance, created a draft, downloaded the three assets back from GitHub, required byte identity/checksum/manifest integrity, reran lifecycle acceptance against the downloaded ZIP and only then published the release.

### Boundary
- No customer feature, data model, REST namespace, authorization rule, storage schema or outbound-data policy change.
- Plugin URI and Author URI remain intentionally absent.
- Public GitHub Release `0.5.0` remains frozen historical evidence.
- WordPress.org availability is not claimed until actual directory publication.

## 0.5.0 — Public GitHub release

### Added
- Account-free local AI Search / `llms.txt` workflow for WordPress and WooCommerce.
- Optional EN/ES AI Search Optimizer Support page and bounded Kairoseth CTA.
- Deterministic generation, explicit publication and public SHA-256 verification.
- WPCS + PHPCompatibilityWP, official Plugin Check, runtime matrix, Multisite/WooCommerce and browser EN/ES blocking gates.
- Release lifecycle proof and fail-closed draft-first GitHub publication.

### Historical release evidence

```text
source commit           b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree             6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package bytes           29397
package entries         13
package SHA-256         0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
annotated tag object    6433cca08a8d8a213f0c0326447910c5ee732ff5
GitHub Release ID       387492480
publication run         34681042749 — PASS
```

`0.5.0` remains a public historical GitHub Release. It was not modified in place when Phase 5C discovered stale packaged readme wording; the submission line advanced to `0.5.1` instead.

## 0.4.0 — Release candidate

### Added
- Dedicated public repository and MIT licensing.
- Account-free local AI Search readiness checks, public content inventory and WooCommerce awareness.
- Deterministic `llms.txt` preview/validation, resource selection, explicit publication and public read-back SHA verification.
- EN/ES UX, lifecycle/retention behavior and reproducible package evidence.

### Acceptance evidence

```text
source commit       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256     27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

## Historical predecessor

Connector `0.3.2` was accepted inside `Emmakex/kairoseth-platform`. See `docs/PROVENANCE.md`.
