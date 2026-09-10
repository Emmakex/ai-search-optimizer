#!/usr/bin/env bash
set -uo pipefail

if [[ $# -lt 2 ]]; then
  echo "usage: ci-run.sh <step-name> <command> [args...]" >&2
  exit 2
fi

STEP="$1"
shift
COMMAND="$(printf '%q ' "$@")"
LOG="$(mktemp)"
trap 'rm -f "$LOG"' EXIT

set +e
"$@" >"$LOG" 2>&1
STATUS=$?
set -e

cat "$LOG"

if [[ $STATUS -eq 0 ]]; then
  exit 0
fi

PRIMARY="$(awk 'NF { line=$0 } END { print line }' "$LOG" | tr -d '\r' | head -c 500)"
[[ -n "$PRIMARY" ]] || PRIMARY="Command failed without a textual error line."
SIGNATURE="$(printf '%s\n%s\n%s' "$STEP" "$COMMAND" "$PRIMARY" | sha256sum | awk '{print $1}')"
CONTEXT="$(tail -n 20 "$LOG")"

{
  echo "## CI failure diagnosis"
  echo
  echo "- **Pipeline:** CI"
  echo "- **Job:** ${GITHUB_JOB:-validate}"
  echo "- **Step:** $STEP"
  echo "- **Command:** \`$COMMAND\`"
  echo "- **Exit code:** $STATUS"
  echo "- **Primary error:** $PRIMARY"
  echo "- **Signature:** \`$SIGNATURE\`"
  echo "- **Root cause:** unconfirmed — inspect the bounded context below"
  echo
  echo '<details><summary>Bounded failure context</summary>'
  echo
  echo '```text'
  printf '%s\n' "$CONTEXT"
  echo '```'
  echo '</details>'
} >> "${GITHUB_STEP_SUMMARY:-/dev/null}"

printf '::error title=%s failed::exit=%s signature=%s primary=%s\n' "$STEP" "$STATUS" "$SIGNATURE" "$PRIMARY"
exit "$STATUS"
