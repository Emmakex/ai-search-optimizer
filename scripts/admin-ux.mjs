import { chromium } from 'playwright-core';

const baseUrl = process.env.BASE_URL;
const chromeBin = process.env.CHROME_BIN;
const locale = process.env.EXPECT_LOCALE || 'en';

if (!baseUrl || !chromeBin) {
  throw new Error('BASE_URL and CHROME_BIN are required');
}

const copy = locale === 'es'
  ? {
      inventory: 'Contenido público elegible',
      privacy: 'Este análisis local no envía contenido del sitio a Kairoseth, proveedores de IA ni analítica de terceros.',
      preview: 'Vista previa de llms.txt',
      publish: 'Publicar llms.txt',
      verify: 'Verificar llms.txt público',
      dataHeading: 'AI Search Optimizer — Datos y desinstalación',
      preserve: 'Conservar los datos publicados de llms.txt',
      connectionHeading: 'Conectar AI Search Optimizer con Kairoseth',
      connectionPrivacy: 'Esta comprobación no hace ninguna petición a Kairoseth ni envía contenido, credenciales, analítica o estado de conexión. Kairoseth solo se abre cuando eliges el botón de abajo.',
      openKairoseth: 'Abrir Kairoseth AI Search Optimizer',
      connectionEndpoint: 'Endpoint de conexión',
    }
  : {
      inventory: 'Eligible public content',
      privacy: 'This local analysis does not send site content to Kairoseth, AI providers, or third-party analytics.',
      preview: 'llms.txt preview',
      publish: 'Publish llms.txt',
      verify: 'Verify public llms.txt',
      dataHeading: 'AI Search Optimizer — Data & uninstall',
      preserve: 'Preserve published llms.txt data',
      connectionHeading: 'Connect AI Search Optimizer to Kairoseth',
      connectionPrivacy: 'This readiness page makes no request to Kairoseth and sends no site content, credentials, analytics, or connection state. Kairoseth opens only when you choose the button below.',
      openKairoseth: 'Open Kairoseth AI Search Optimizer',
      connectionEndpoint: 'Connection endpoint',
    };

function assert(condition, message) {
  if (!condition) {
    throw new Error(message);
  }
}

const browser = await chromium.launch({
  executablePath: chromeBin,
  headless: true,
  args: ['--no-sandbox', '--disable-dev-shm-usage'],
});

try {
  const context = await browser.newContext({ viewport: { width: 1280, height: 900 } });
  const page = await context.newPage();
  const pageErrors = [];
  page.on('pageerror', (error) => pageErrors.push(String(error)));

  await page.goto(`${baseUrl}/wp-login.php`, { waitUntil: 'domcontentloaded' });
  await page.locator('#user_login').fill('admin');
  await page.locator('#user_pass').fill('runtime-test-password');
  await Promise.all([
    page.waitForURL(/wp-admin/),
    page.locator('#wp-submit').click(),
  ]);

  for (const viewport of [
    { width: 1280, height: 900, name: 'desktop' },
    { width: 390, height: 844, name: 'mobile' },
  ]) {
    await page.setViewportSize({ width: viewport.width, height: viewport.height });
    await page.goto(`${baseUrl}/wp-admin/tools.php?page=ai-search-optimizer`, { waitUntil: 'networkidle' });

    const root = page.locator('.ai-search-optimizer-local');
    await root.waitFor({ state: 'visible' });
    assert(await page.getByText(copy.inventory, { exact: true }).isVisible(), `${locale}/${viewport.name}: inventory heading missing`);
    assert(await page.getByText(copy.privacy, { exact: true }).isVisible(), `${locale}/${viewport.name}: privacy disclosure missing`);
    assert(await page.getByText(copy.preview, { exact: true }).isVisible(), `${locale}/${viewport.name}: preview heading missing`);

    const checkbox = page.locator('input[name="aiso_selected[]"]').first();
    await checkbox.waitFor({ state: 'visible' });
    const checkboxName = await checkbox.getAttribute('aria-label');
    assert(Boolean(checkboxName && checkboxName.trim()), `${locale}/${viewport.name}: resource checkbox has no accessible name`);

    const textarea = page.locator('textarea[readonly]').first();
    const textareaName = await textarea.getAttribute('aria-label');
    assert(Boolean(textareaName && textareaName.trim()), `${locale}/${viewport.name}: preview textarea has no accessible name`);

    const publish = page.getByRole('button', { name: copy.publish, exact: true });
    const verify = page.getByRole('button', { name: copy.verify, exact: true });
    assert(await publish.isVisible(), `${locale}/${viewport.name}: publish button missing`);
    assert(await verify.isVisible(), `${locale}/${viewport.name}: verify button missing`);

    const dimensions = await root.evaluate((element) => ({
      clientWidth: element.clientWidth,
      scrollWidth: element.scrollWidth,
      left: element.getBoundingClientRect().left,
      right: element.getBoundingClientRect().right,
      viewport: document.documentElement.clientWidth,
    }));
    assert(dimensions.scrollWidth <= dimensions.clientWidth + 1, `${locale}/${viewport.name}: workflow root overflows horizontally (${dimensions.scrollWidth} > ${dimensions.clientWidth})`);
    assert(dimensions.left >= -1 && dimensions.right <= dimensions.viewport + 1, `${locale}/${viewport.name}: workflow escapes viewport bounds`);

    if (viewport.name === 'mobile') {
      const table = page.locator('.ai-search-optimizer-local .widefat').first();
      const tableStyle = await table.evaluate((element) => ({
        overflowX: getComputedStyle(element).overflowX,
        maxWidth: getComputedStyle(element).maxWidth,
      }));
      assert(['auto', 'scroll'].includes(tableStyle.overflowX), `${locale}/mobile: inventory table is not horizontally contained`);

      const publishHeight = await publish.evaluate((element) => element.getBoundingClientRect().height);
      assert(publishHeight >= 43, `${locale}/mobile: publish control is below touch target height (${publishHeight})`);
    }

    await page.goto(`${baseUrl}/wp-admin/tools.php?page=ai-search-optimizer-kairoseth`, { waitUntil: 'networkidle' });
    const connectionRoot = page.locator('.ai-search-optimizer-kairoseth');
    await connectionRoot.waitFor({ state: 'visible' });
    assert(await page.getByRole('heading', { name: copy.connectionHeading, exact: true }).isVisible(), `${locale}/${viewport.name}: Kairoseth connection heading missing`);
    assert(await page.getByText(copy.connectionPrivacy, { exact: true }).isVisible(), `${locale}/${viewport.name}: Kairoseth no-transmission disclosure missing`);
    assert(await page.getByText(copy.connectionEndpoint, { exact: true }).isVisible(), `${locale}/${viewport.name}: connection endpoint label missing`);

    const handoff = page.getByRole('link', { name: copy.openKairoseth, exact: true });
    assert(await handoff.isVisible(), `${locale}/${viewport.name}: Kairoseth handoff missing`);
    assert(await handoff.getAttribute('href') === 'https://kairoseth.com/app', `${locale}/${viewport.name}: Kairoseth handoff URL changed`);
    assert(await handoff.getAttribute('target') === '_blank', `${locale}/${viewport.name}: Kairoseth handoff must open separately`);
    const rel = (await handoff.getAttribute('rel')) || '';
    assert(rel.includes('noopener') && rel.includes('noreferrer'), `${locale}/${viewport.name}: Kairoseth handoff rel protections missing`);

    const endpointCode = connectionRoot.locator('code').filter({ hasText: '/wp-json/kairoseth-ai-web-readiness/v1/connection' });
    assert(await endpointCode.count() === 1, `${locale}/${viewport.name}: inherited connection endpoint not shown exactly once`);

    const connectionDimensions = await connectionRoot.evaluate((element) => ({
      clientWidth: element.clientWidth,
      scrollWidth: element.scrollWidth,
      left: element.getBoundingClientRect().left,
      right: element.getBoundingClientRect().right,
      viewport: document.documentElement.clientWidth,
    }));
    assert(connectionDimensions.scrollWidth <= connectionDimensions.clientWidth + 1, `${locale}/${viewport.name}: connection page overflows horizontally`);
    assert(connectionDimensions.left >= -1 && connectionDimensions.right <= connectionDimensions.viewport + 1, `${locale}/${viewport.name}: connection page escapes viewport bounds`);

    if (viewport.name === 'mobile') {
      const handoffHeight = await handoff.evaluate((element) => element.getBoundingClientRect().height);
      assert(handoffHeight >= 43, `${locale}/mobile: Kairoseth handoff is below touch target height (${handoffHeight})`);
    }
  }

  await page.setViewportSize({ width: 390, height: 844 });
  await page.goto(`${baseUrl}/wp-admin/tools.php?page=ai-search-optimizer-data`, { waitUntil: 'networkidle' });
  assert(await page.getByRole('heading', { name: copy.dataHeading, exact: true }).isVisible(), `${locale}/mobile: data heading missing`);
  assert(await page.getByText(copy.preserve, { exact: true }).isVisible(), `${locale}/mobile: preserve option label missing`);
  const preserveRadio = page.locator('input[name="aiso_uninstall_mode"][value="preserve"]');
  assert(await preserveRadio.isVisible(), `${locale}/mobile: preserve radio missing`);

  const lifecycleRoot = page.locator('.ai-search-optimizer-lifecycle');
  const lifecycleDims = await lifecycleRoot.evaluate((element) => ({ clientWidth: element.clientWidth, scrollWidth: element.scrollWidth }));
  assert(lifecycleDims.scrollWidth <= lifecycleDims.clientWidth + 1, `${locale}/mobile: lifecycle page overflows horizontally`);

  assert(pageErrors.length === 0, `${locale}: browser page errors: ${pageErrors.join(' | ')}`);
  console.log(`PASS: browser admin UX locale=${locale} desktop=1280x900 mobile=390x844 overflow=contained accessible-controls=present Kairoseth-readiness=present`);
} finally {
  await browser.close();
}
