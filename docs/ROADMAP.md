# AI Search Optimizer — Roadmap

Status: **Phase 5C.2 complete — public GitHub Release `0.5.1` verified; Phase 5C.3 exact-ZIP WordPress.org submission is next; directory availability is not yet claimed.**  
Last reviewed: **12 September 2026**

```text
Phase 0  product/repository foundation              COMPLETE
Phase 1  standalone connector extraction           COMPLETE
Phase 2  useful local Free workflow                 COMPLETE
Phase 3  optional support / custom-development UX   COMPLETE
Phase 4  Extensions catalog integration             COMPLETE
Phase 5  stable public distribution / WordPress.org IN PROGRESS
  5A     stable candidate identity                  COMPLETE
  5B     GitHub release + lifecycle proof           COMPLETE
  5C     WordPress.org submission/review            IN PROGRESS
    5C.0 submission-hardening contract              COMPLETE
    5C.1 0.5.1 package hardening                    COMPLETE
    5C.2 public 0.5.1 GitHub release                COMPLETE
    5C.3 WordPress.org exact-ZIP submission          NEXT
    5C.4 external review findings                    FUTURE
    5C.5 live directory verification                 FUTURE
```

## Product model

```text
useful local Free plugin
→ optional explicit Kairoseth CTA
→ support / improvement / custom development when requested
```

The local Free plugin is not a trial, license shell or mandatory cloud onboarding funnel.

## Accepted release lineage

Historical `0.4.0` candidate:

```text
source commit       4d68b111d1f796fdc9bfbc3e670eeecc69c09a76
source tree         472e8c5e5bc20ed8f4eed412ab5515561b89ff16
package SHA-256     27e5212a6bba188bc79d30a0edf3d1d662339f50f9938fa3618bb6b21bcd558c
```

Previous public release `0.5.0`:

```text
source commit       b116ae5df76c7a72ad37ff4e8e80632d6ebb457b
source tree         6a837ed67049ae04cdf59656cc15997a8d9bb7b3
package SHA-256     0eb87610ddd5c2d348d3450c45792f63e5a47acc8dc103e650d188f98f10c85e
GitHub Release ID   387492480
```

## Phase 5C

### 5C.0 — submission hardening — complete

The immutable `0.5.0` release contained stale packaged pre-publication wording, so it was not rewritten in place. A minimal `0.5.1` submission-hardening release was selected.

### 5C.1 — exact `0.5.1` package — complete

```text
source commit       c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
source tree         e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
package             ai-search-optimizer-0.5.1.zip
package bytes       29560
package entries     13
package SHA-256     2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
final PR CI         #107 / run 34692689075 — PASS
post-merge CI       #108 / run 34692826856 — PASS
```

### 5C.2 — public GitHub Release `0.5.1` — complete

```text
publication tooling PR   #34
PR CI                    #111 / run 34695699823 — PASS
publication tooling main 108f276dc0774b6cf9c85d77d14546d01495cfc1
post-merge CI            #112 / run 34695819740 — PASS
publication run          34695973744 — PASS
annotated tag object     32a51daf4e32a8919114b6dc734a54a00952aed0
tag target               c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
GitHub Release ID        387576797
published at             2026-09-12T13:17:34Z
package SHA-256          2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
```

The publisher reconstructed the frozen source, verified SHA/bytes/entries, ran lifecycle acceptance, created the release as draft, downloaded and byte-compared all assets, reran lifecycle against the downloaded ZIP and only then made it public. The live CTA gate ran before any release mutation.

Canonical evidence: [`PHASE5C2_GITHUB_RELEASE.md`](PHASE5C2_GITHUB_RELEASE.md).

### 5C.3 — WordPress.org exact-ZIP submission — next

Submit **the exact released ZIP** with SHA-256 `2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b`. Any automated/manual WordPress.org finding becomes a structured incident and must be resolved through the normal branch → PR → CI → merge → verification process.

`ai-search-optimizer` remains only the target directory slug until WordPress.org actually accepts/reserves and publishes it. No customer-facing availability claim is allowed before that point.
