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
      supportHeading: 'Soporte de AI Search Optimizer',
      supportLocalFirst: 'Cargar esta página no envía nada a Kairoseth. El análisis, selección de contenido, generación de llms.txt, validación, publicación y verificación pública siguen disponibles sin una cuenta externa.',
      supportCta: 'Abrir soporte Kairoseth',
      customCta: 'Solicitar desarrollo a medida',
    }
  : {
      inventory: 'Eligible public content',
      privacy: 'This local analysis does not send site content to Kairoseth, AI providers, or third-party analytics.',
      preview: 'llms.txt preview',
      publish: 'Publish llms.txt',
      verify: 'Verify public llms.txt',
      dataHeading: 'AI Search Optimizer — Data & uninstall',
      preserve: 'Preserve published llms.txt data',
      supportHeading: 'AI Search Optimizer Support',
      supportLocalFirst: 'Loading this page sends nothing to Kairoseth. Analysis, content selection, llms.txt generation, validation, publication and public verification remain available without an external account.',
      supportCta: 'Open Kairoseth support',
      customCta: 'Request custom development',
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

    const kairosethRequests = [];
    const captureKairoseth = (request) => {
      try {
        if (new URL(request.url()).hostname === 'kairoseth.com') kairosethRequests.push(request.url());
      } catch {}
    };
    page.on('request', captureKairoseth);
    await page.goto(`${baseUrl}/wp-admin/tools.php?page=ai-search-optimizer-support`, { waitUntil: 'networkidle' });
    page.off('request', captureKairoseth);

    const supportRoot = page.locator('.ai-search-optimizer-support');
    await supportRoot.waitFor({ state: 'visible' });
    assert(kairosethRequests.length === 0, `${locale}/${viewport.name}: support page made an automatic Kairoseth request`);
    assert(await page.getByRole('heading', { name: copy.supportHeading, exact: true }).isVisible(), `${locale}/${viewport.name}: support heading missing`);
    assert(await page.getByText(copy.supportLocalFirst, { exact: true }).isVisible(), `${locale}/${viewport.name}: local-first support disclosure missing`);

    const supportLink = page.getByRole('link', { name: copy.supportCta, exact: true });
    const customLink = page.getByRole('link', { name: copy.customCta, exact: true });
    assert(await supportLink.isVisible(), `${locale}/${viewport.name}: support CTA missing`);
    assert(await customLink.isVisible(), `${locale}/${viewport.name}: custom-development CTA missing`);

    for (const [kind, link, requestType] of [
      ['support', supportLink, 'implementation_support'],
      ['custom', customLink, 'business_customization'],
    ]) {
      const href = await link.getAttribute('href');
      assert(Boolean(href), `${locale}/${viewport.name}: ${kind} CTA has no href`);
      const url = new URL(href);
      assert(url.origin === 'https://kairoseth.com', `${locale}/${viewport.name}: ${kind} CTA origin changed`);
      assert(url.pathname === '/custom-requests', `${locale}/${viewport.name}: ${kind} CTA path changed`);
      const keys = Array.from(url.searchParams.keys());
      const expectedKeys = ['source', 'extensionSlug', 'extensionName', 'extensionVersion', 'hostPlatform', 'hostPlatformVersion', 'locale', 'requestType'];
      assert(JSON.stringify(keys) === JSON.stringify(expectedKeys), `${locale}/${viewport.name}: ${kind} CTA query allow-list changed (${keys.join(',')})`);
      assert(url.searchParams.get('source') === 'extension', `${locale}/${viewport.name}: ${kind} source context changed`);
      assert(url.searchParams.get('extensionSlug') === 'ai-search-optimizer', `${locale}/${viewport.name}: ${kind} extension slug changed`);
      assert(url.searchParams.get('extensionName') === 'AI Search Optimizer', `${locale}/${viewport.name}: ${kind} extension name changed`);
      assert(url.searchParams.get('extensionVersion') === '0.5.0-dev', `${locale}/${viewport.name}: ${kind} extension version changed`);
      assert(url.searchParams.get('hostPlatform') === 'wordpress', `${locale}/${viewport.name}: ${kind} host platform changed`);
      assert(url.searchParams.get('locale') === locale, `${locale}/${viewport.name}: ${kind} locale changed`);
      assert(url.searchParams.get('requestType') === requestType, `${locale}/${viewport.name}: ${kind} request type changed`);
      assert(await link.getAttribute('target') === '_blank', `${locale}/${viewport.name}: ${kind} CTA must open separately`);
      const rel = (await link.getAttribute('rel')) || '';
      assert(rel.includes('noopener') && rel.includes('noreferrer'), `${locale}/${viewport.name}: ${kind} CTA rel protections missing`);
    }

    const supportDimensions = await supportRoot.evaluate((element) => ({
      clientWidth: element.clientWidth,
      scrollWidth: element.scrollWidth,
      left: element.getBoundingClientRect().left,
      right: element.getBoundingClientRect().right,
      viewport: document.documentElement.clientWidth,
    }));
    assert(supportDimensions.scrollWidth <= supportDimensions.clientWidth + 1, `${locale}/${viewport.name}: support page overflows horizontally`);
    assert(supportDimensions.left >= -1 && supportDimensions.right <= supportDimensions.viewport + 1, `${locale}/${viewport.name}: support page escapes viewport bounds`);

    if (viewport.name === 'mobile') {
      const supportHeight = await supportLink.evaluate((element) => element.getBoundingClientRect().height);
      const customHeight = await customLink.evaluate((element) => element.getBoundingClientRect().height);
      assert(supportHeight >= 43, `${locale}/mobile: support CTA is below touch target height (${supportHeight})`);
      assert(customHeight >= 43, `${locale}/mobile: custom CTA is below touch target height (${customHeight})`);
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
  console.log(`PASS: browser admin UX locale=${locale} desktop=1280x900 mobile=390x844 overflow=contained accessible-controls=present contextual-support=privacy-bounded`);
} finally {
  await browser.close();
}
