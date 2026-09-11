#!/usr/bin/env python3
from pathlib import Path
import re

FILES = {
    'ai-search-optimizer.php': 'Main plugin bootstrap, REST connector, and llms.txt delivery.',
    'uninstall.php': 'Plugin uninstall and retention cleanup.',
    'includes/local-admin.php': 'Local analysis administration UI and workflow helpers.',
    'includes/local-publish.php': 'Local llms.txt publication and verification helpers.',
    'includes/kairoseth-support.php': 'Contextual Kairoseth support integration helpers.',
    'includes/local-admin-assets.php': 'Local administration presentation hardening.',
    'includes/local-core.php': 'Local analysis and llms.txt generation primitives.',
    'includes/local-lifecycle.php': 'Plugin lifecycle and retention settings.',
    'includes/kairoseth-connection-readiness.php': 'Kairoseth connection readiness bootstrap.',
}

FUNC_RE = re.compile(r'(?m)^function\s+([A-Za-z_][A-Za-z0-9_]*)\s*\(([^\n]*)\)\s*\{\s*$')


def humanize(value):
    return value.strip('_').replace('_', ' ').strip()


def function_description(name):
    stem = name
    for prefix in ('kairoseth_aiwr_', 'kairoseth_aiso_'):
        if stem.startswith(prefix):
            stem = stem[len(prefix):]
            break
    return 'Provides the {} operation.'.format(humanize(stem))


def split_params(raw):
    if not raw.strip():
        return []
    return [part.strip() for part in raw.split(',') if part.strip()]


def param_doc(param):
    match = re.search(r'(?:(?P<type>[A-Za-z_\\][A-Za-z0-9_\\|?]*)\s+)?(?P<var>\$[A-Za-z_][A-Za-z0-9_]*)(?:\s*=\s*(?P<default>.*))?$', param)
    if not match:
        raise RuntimeError('Unsupported parameter syntax: {}'.format(param))
    typ = (match.group('type') or '').lstrip('?')
    var = match.group('var')
    default = (match.group('default') or '').strip()
    if not typ:
        if default in ('true', 'false'):
            typ = 'bool'
        elif re.fullmatch(r'-?\d+', default):
            typ = 'int'
        elif default.startswith(('array(', '[')):
            typ = 'array'
        elif default.startswith(("'", '"')):
            typ = 'string'
        else:
            typ = 'mixed'
    desc = 'The {} value.'.format(humanize(var[1:]))
    return typ, var, desc


def has_return(body):
    return re.search(r'(?m)^\s*return(?:\s+[^;]+)?;', body) is not None


def normalize_file_comment_spacing(text):
    if not text.startswith('<?php\n'):
        return text
    after = text[len('<?php\n'):]
    stripped = after.lstrip('\n')
    if not stripped.startswith('/**'):
        return text
    comment_end = stripped.find('*/')
    if comment_end < 0:
        return text
    comment_end += 2
    comment = stripped[:comment_end]
    remainder = stripped[comment_end:].lstrip('\n')
    return '<?php\n' + comment + '\n\n' + remainder


def add_file_docblock(path, text, description):
    if path.name == 'ai-search-optimizer.php':
        header_end = text.find('*/')
        if header_end < 0:
            raise RuntimeError('Main plugin header not found')
        header = text[:header_end]
        if '@package ' not in header:
            text = text[:header_end] + ' *\n * @package AI_Search_Optimizer\n ' + text[header_end:]
        return text

    if not text.startswith('<?php\n'):
        raise RuntimeError('Unexpected PHP header in {}'.format(path))
    after = text[len('<?php\n'):]
    if after.lstrip().startswith('/**'):
        return normalize_file_comment_spacing(text)
    block = (
        '/**\n'
        ' * {}\n'.format(description)
        + ' *\n'
        + ' * @package AI_Search_Optimizer\n'
        + ' */\n\n'
    )
    return '<?php\n' + block + after.lstrip('\n')


def add_function_docblocks(text):
    matches = list(FUNC_RE.finditer(text))
    insertions = []
    for idx, match in enumerate(matches):
        before = text[:match.start()].rstrip()
        if before.endswith('*/'):
            between = text[before.rfind('*/') + 2:match.start()]
            if not between.strip():
                continue

        body_end = matches[idx + 1].start() if idx + 1 < len(matches) else len(text)
        body = text[match.end():body_end]
        lines = ['/**', ' * {}'.format(function_description(match.group(1)))]
        params = split_params(match.group(2))
        if params or has_return(body):
            lines.append(' *')
        for param in params:
            typ, var, desc = param_doc(param)
            lines.append(' * @param {} {} {}'.format(typ, var, desc))
        if has_return(body):
            lines.append(' * @return mixed The operation result.')
        lines.append(' */')
        insertions.append((match.start(), '\n'.join(lines) + '\n'))

    for pos, block in reversed(insertions):
        text = text[:pos] + block + text[pos:]
    return text


def main():
    root = Path('.')
    for rel, description in FILES.items():
        path = root / rel
        text = path.read_text(encoding='utf-8')
        text = add_file_docblock(path, text, description)
        text = add_function_docblocks(text)
        if rel == 'includes/local-publish.php':
            text = text.replace(
                "hash( 'sha256', json_encode( $snapshot, JSON_UNESCAPED_SLASHES ) )",
                "hash( 'sha256', wp_json_encode( $snapshot, JSON_UNESCAPED_SLASHES ) )",
            )
        if rel == 'includes/kairoseth-support.php':
            text = text.replace(
                "isset( $parts[ $forbidden ] ) && (string) $parts[ $forbidden ] !== ''",
                "isset( $parts[ $forbidden ] ) && '' !== (string) $parts[ $forbidden ]",
            )
        path.write_text(text, encoding='utf-8')


if __name__ == '__main__':
    main()
