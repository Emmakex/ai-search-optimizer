#!/usr/bin/env bash
set -euo pipefail

BASE_URL="${KAIROSETH_CUSTOM_REQUESTS_URL:-https://kairoseth.com/custom-requests}"
PLUGIN_VERSION="${AISO_RELEASE_VERSION:-0.5.1}"
WORDPRESS_VERSION="${AISO_WORDPRESS_VERSION:-7.1}"
BROWSER_USER_AGENT="${AISO_CTA_USER_AGENT:-Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36}"
WORK_DIR="${RUNNER_TEMP:-$(mktemp -d)}/aiso-cta-check-$$"
mkdir -p "$WORK_DIR"
trap 'rm -rf "$WORK_DIR"' EXIT

fail() {
  echo "$*" >&2
  exit 1
}

for command in curl python3 grep sed awk; do
  command -v "$command" >/dev/null 2>&1 || fail "Required CTA verification tool missing: $command"
done

build_request_url() {
  local locale="$1"
  local request_type="$2"
  local plugin_version="$3"

  python3 - "$BASE_URL" "$locale" "$request_type" "$plugin_version" "$WORDPRESS_VERSION" <<'PY'
import sys
from urllib.parse import urlencode
base, locale, request_type, plugin_version, wp_version = sys.argv[1:]
params = {
    "source": "extension",
    "extensionSlug": "ai-search-optimizer",
    "extensionName": "AI Search Optimizer",
    "extensionVersion": plugin_version,
    "hostPlatform": "wordpress",
    "hostPlatformVersion": wp_version,
    "locale": locale,
    "requestType": request_type,
}
print(base + "?" + urlencode(params))
PY
}

http_fetch() {
  local request_url="$1"
  local prefix="$2"
  local user_agent="${3:-}"
  local body="$WORK_DIR/${prefix}.html"
  local headers="$WORK_DIR/${prefix}.headers"
  local meta="$WORK_DIR/${prefix}.meta"
  local -a curl_args=(
    --silent
    --show-error
    --location
    --connect-timeout 10
    --max-time 30
    --retry 2
    --retry-delay 2
    --retry-all-errors
    --output "$body"
    --dump-header "$headers"
    --write-out '%{http_code}\n%{url_effective}\n'
  )

  if [[ -n "$user_agent" ]]; then
    curl_args+=(--user-agent "$user_agent")
  fi

  if ! curl "${curl_args[@]}" "$request_url" > "$meta"; then
    fail "Kairoseth CTA network request failed before an HTTP response was available prefix=$prefix"
  fi

  printf '%s\n%s\n%s\n' "$body" "$headers" "$meta"
}

safe_edge_summary() {
  local headers="$1"
  local body="$2"
  local header_summary marker_summary

  header_summary="$(awk 'BEGIN { IGNORECASE=1 } /^(server|via|cf-ray|x-vercel-id|x-vercel-error|x-matched-path|location):/ { gsub(/\r$/, ""); print }' "$headers" | tail -n 20 || true)"
  marker_summary="$(grep -Eio 'cloudflare|vercel|forbidden|access denied|security checkpoint|request blocked' "$body" | sort -u | paste -sd ',' - || true)"

  [[ -n "$header_summary" ]] && printf '%s\n' "$header_summary" >&2
  [[ -n "$marker_summary" ]] && printf 'body_markers=%s\n' "$marker_summary" >&2
}

probe_client_profile() {
  local plugin_version="$1"
  local profile="$2"
  local user_agent="${3:-}"
  local request_url prefix body headers meta status final_url

  request_url="$(build_request_url en implementation_support "$plugin_version")"
  prefix="probe-${plugin_version}-${profile}"
  mapfile -t files < <(http_fetch "$request_url" "$prefix" "$user_agent")
  body="${files[0]}"
  headers="${files[1]}"
  meta="${files[2]}"
  status="$(sed -n '1p' "$meta")"
  final_url="$(sed -n '2p' "$meta")"

  printf 'CTA_PROBE version=%s profile=%s status=%s final=%s\n' "$plugin_version" "$profile" "$status" "$final_url" >&2
  if [[ "$status" != "200" ]]; then
    safe_edge_summary "$headers" "$body"
  fi
  printf '%s\n' "$status"
}

# The CTA is opened by a human browser. Keep one curl-default probe as an edge diagnostic,
# but make the blocking contract representative of the real navigation client class.
default_status="$(probe_client_profile "$PLUGIN_VERSION" curl-default)"
browser_status="$(probe_client_profile "$PLUGIN_VERSION" browser "$BROWSER_USER_AGENT")"

if [[ "$default_status" != "$browser_status" ]]; then
  echo "CTA_DIAG client-profile differential version=$PLUGIN_VERSION curl_default=$default_status browser=$browser_status" >&2
fi

if [[ "$browser_status" != "200" ]]; then
  control_default="$(probe_client_profile 0.5.0 curl-default)"
  control_browser="$(probe_client_profile 0.5.0 browser "$BROWSER_USER_AGENT")"
  fail "Kairoseth CTA browser-equivalent preflight failed candidate=$PLUGIN_VERSION candidate_status=$browser_status control=0.5.0 control_curl_status=$control_default control_browser_status=$control_browser"
fi

verify_case() {
  local locale="$1"
  local request_type="$2"
  local request_url body headers meta status final_url

  request_url="$(build_request_url "$locale" "$request_type" "$PLUGIN_VERSION")"
  mapfile -t files < <(http_fetch "$request_url" "case-${locale}-${request_type}" "$BROWSER_USER_AGENT")
  body="${files[0]}"
  headers="${files[1]}"
  meta="${files[2]}"
  status="$(sed -n '1p' "$meta")"
  final_url="$(sed -n '2p' "$meta")"

  if [[ "$status" != "200" ]]; then
    safe_edge_summary "$headers" "$body"
    fail "Kairoseth CTA returned HTTP $status for locale=$locale requestType=$request_type"
  fi

  python3 - "$final_url" "$locale" "$request_type" "$PLUGIN_VERSION" "$WORDPRESS_VERSION" <<'PY'
import sys
from urllib.parse import urlparse, parse_qs
url, locale, request_type, plugin_version, wp_version = sys.argv[1:]
parsed = urlparse(url)
if parsed.scheme != "https" or parsed.hostname != "kairoseth.com" or parsed.path != "/custom-requests":
    raise SystemExit(f"CTA final destination drifted: {url}")
query = parse_qs(parsed.query, keep_blank_values=True)
expected = {
    "source": "extension",
    "extensionSlug": "ai-search-optimizer",
    "extensionName": "AI Search Optimizer",
    "extensionVersion": plugin_version,
    "hostPlatform": "wordpress",
    "hostPlatformVersion": wp_version,
    "locale": locale,
    "requestType": request_type,
}
for key, value in expected.items():
    if query.get(key) != [value]:
        raise SystemExit(f"CTA query drift for {key}: expected={value!r} received={query.get(key)!r}")
for forbidden in ("siteUrl", "homeUrl", "llmsTxt", "contentHash", "username", "email", "token", "credential", "woocommerce"):
    if forbidden in query:
        raise SystemExit(f"Forbidden automatic CTA context present: {forbidden}")
PY

  grep -Fq 'AI Search Optimizer' "$body" || fail "Production Custom Requests page did not render canonical AI Search Optimizer identity."
  grep -Fq 'ai-search-optimizer' "$body" || fail "Production Custom Requests page did not render canonical AI Search Optimizer slug."
  grep -Fq "$PLUGIN_VERSION" "$body" || fail "Production Custom Requests page did not render plugin version $PLUGIN_VERSION."
  grep -Fq 'wordpress' "$body" || fail "Production Custom Requests page did not render canonical WordPress host context."
  grep -Fq "$WORDPRESS_VERSION" "$body" || fail "Production Custom Requests page did not render WordPress version $WORDPRESS_VERSION."

  if [[ "$locale" == "es" ]]; then
    grep -Fq 'Cuéntanos qué necesitas.' "$body" || fail "Spanish Custom Requests copy is not live."
    grep -Fq 'Contexto recibido' "$body" || fail "Spanish bounded-context panel is not live."
    grep -Fq 'Enviar solicitud' "$body" || fail "Spanish Custom Requests form is not live."
  else
    grep -Fq 'Tell us what you need.' "$body" || fail "English Custom Requests copy is not live."
    grep -Fq 'Received context' "$body" || fail "English bounded-context panel is not live."
    grep -Fq 'Send request' "$body" || fail "English Custom Requests form is not live."
  fi

  echo "PASS: Kairoseth CTA production locale=$locale requestType=$request_type status=200 final=$final_url"
}

verify_case en implementation_support
verify_case en business_customization
verify_case es implementation_support
verify_case es business_customization

echo "PASS: Kairoseth Custom Requests CTA production contract for AI Search Optimizer"
