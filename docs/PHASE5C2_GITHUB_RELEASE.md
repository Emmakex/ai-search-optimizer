# Phase 5C.2 — GitHub Release `0.5.1`

Status: **ACCEPTED — public release verified; exact package identity preserved; WordPress.org submission is next.**

Date: 2026-09-12

## Accepted release identity

```text
version                0.5.1
tag                    0.5.1
annotated tag object   32a51daf4e32a8919114b6dc734a54a00952aed0
tag target             c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
source tree            e1cc7c3f017e92a5ed3de8835e3f9c8764f3d37b
GitHub Release ID      387576797
release URL            https://github.com/Emmakex/ai-search-optimizer/releases/tag/0.5.1
published at           2026-09-12T13:17:34Z
package                ai-search-optimizer-0.5.1.zip
package bytes          29560
package entries        13
package SHA-256        2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b
publication run        34695973744
```

GitHub reports the release as `draft=false` and `prerelease=false`. The GitHub API `immutable` field is `false`; this document therefore describes the release identity as **accepted/frozen by project contract**, not as GitHub-native immutable enforcement.

## Published assets

```text
ai-search-optimizer-0.5.1.zip
  asset ID   559297134
  size       29560
  digest     sha256:2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b

ai-search-optimizer-0.5.1.sha256
  asset ID   559297135
  size       96
  digest     sha256:91eaa4fb5169db7af3644cb7c4e3ae733be985ad1481d740f13b338b30c66c8b

release-manifest.txt
  asset ID   559297132
  size       356
  digest     sha256:8a2c5117eec6f5ae912774a7bf724230568a027460c6c4eba5243180bb88687b
```

## Publication evidence

```text
5C.1 implementation PR     #32
final implementation CI    #107 / 34692689075 — PASS
implementation merge       c93ac68c3698fa2c7e003dabc41f72e2e423b5cd
5C.1 post-merge CI         #108 / 34692826856 — PASS
5C.1 closure CI            #109 / 34693128380 — PASS
5C.1 closure post-merge    #110 / 34695428487 — PASS
5C.2 tooling PR            #34
5C.2 PR CI                 #111 / 34695699823 — PASS
5C.2 tooling merge         108f276dc0774b6cf9c85d77d14546d01495cfc1
5C.2 post-merge CI         #112 / 34695819740 — PASS
publication workflow       34695973744 — PASS
```

## Fail-closed sequence proved

- confirmed no pre-existing `0.5.1` tag or release;
- required the one-shot trigger branch to equal current canonical `main`;
- ran live Kairoseth CTA validation for `0.5.1` before any release mutation;
- reconstructed exact accepted `c93ac68c...` source/tree and package identity;
- rebuilt exact accepted `0.5.0` as the upgrade baseline;
- passed clean install + `0.5.0 → 0.5.1` + preserve/reinstall/delete lifecycle;
- created annotated tag `0.5.1` pointing exactly to `c93ac68c...`;
- created the GitHub Release as draft;
- uploaded ZIP/checksum/manifest;
- downloaded all assets back from GitHub;
- required exact SHA, byte count, entry count, checksum, manifest and ZIP byte identity;
- reran lifecycle against the downloaded ZIP;
- converted the draft to public only after all verification passed.

The old `0.5.0` publication workflow received the same branch-create event but its guard correctly produced a skipped publish job, so `0.5.0` was untouched.

## Lifecycle evidence

First publication lifecycle preserved verified deployment hash:

```text
a015a23bd7d2b49baec3d8a2acd93ef9730db821f7292fcbb71bdcea85983d56
```

Second lifecycle, using the ZIP downloaded back from GitHub, preserved:

```text
4c25aee0e09c41eb9994963c5fe6d64ebd46294b71a4b6ebe1281cd88711d851
```

Both completed clean install, upgrade, preserve/reinstall and delete-uninstall acceptance with package SHA `2193c5ba79c467cff22d821abc5527ea775ce34705c0b2d040a7b05608e0507b`.

## WordPress.org boundary

This GitHub Release does **not** mean AI Search Optimizer is available on WordPress.org. Phase 5C.3 must submit this exact released ZIP. External review/approval and actual directory publication remain separate gates.
