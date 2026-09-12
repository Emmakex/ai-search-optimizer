#!/usr/bin/env bash
set -euo pipefail

BASE_URL="${KAIROSETH_CUSTOM_REQUESTS_URL:-https://kairoseth.com/custom-requests}"
PLUGIN_VERSION="${AISO_RELEASE_VERSION:-0.5.0}"
WORDPRESS_VERSION="${AISO_WORDPRESS_VERSION:-7.1}"
WORK_DIR="${RUNNER_TEMP:-$(mktemp -d)}/aiso-cta-check-$$"
mkdir -p "$WORK_DIR"
trap 'rm -rf "$WORK_DIR"' EXIT

fail() {
  echo "$*" >&2
  exit 1
}

for command in curl python3 grep; do
  command -v "$command" >/dev/null 2>&1 || fail "Required CTA verification tool missing: $command"
done

verify_case() {
  local locale="$1"
  local request_type="$2"
  local body="$WORK_DIR/body-${locale}-${request_type}.html"
  local meta="$WORK_DIR/meta-${locale}-${request_type}.txt"

  local request_url
  request_url="$(python3 - "$BASE_URL" "$locale" "$request_type" "$PLUGIN_VERSION" "$WORDPRESS_VERSION" <<'PY'
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
)"

  curl \
    --fail-with-body \
    --silent \
    --show-error \
    --location \
    --connect-timeout 10 \
    --max-time 30 \
    --retry 2 \
    --retry-delay 2 \
    --retry-all-errors \
    --output "$body" \
    --write-out '%{http_code}\n%{url_effective}\n' \
    "$request_url" > "$meta"

  local status final_url
  status="$(sed -n '1p' "$meta")"
  final_url="$(sed -n '2p' "$meta")"
  [[ "$status" == "200" ]] || fail "Kairoseth CTA returned HTTP $status for locale=$locale requestType=$request_type"

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
