const fs = require('node:fs');
const path = require('node:path');
const assert = require('node:assert/strict');
const { chromium } = require(process.env.PLAYWRIGHT_MODULE || 'playwright');

(async () => {
    const root = path.resolve(__dirname, '..');
    const source = fs.readFileSync(path.join(root, 'reviews-admin-page.php'), 'utf8');
    const marker = "<?php elseif ($section === 'qrcode'): ?>";
    const head = source.slice(source.indexOf('<!doctype html>'), source.indexOf('<?php if ($error): ?>'));
    const sections = {
        menu: source.slice(source.lastIndexOf('<?php else: ?>') + '<?php else: ?>'.length).split('<?php endif; ?>')[0],
        qr: source.split(marker)[1].split('<?php else: ?>')[0]
    };
    const browser = await chromium.launch({ headless: true, ...(process.env.CHROME_PATH ? { executablePath: process.env.CHROME_PATH } : {}) });
    try {
        for (const width of [320, 390, 1280]) {
            const page = await browser.newPage({ viewport: { width, height: 1000 } });
            for (const [name, segment] of Object.entries(sections)) {
                await page.setContent((head + segment + '</main></body></html>').replace(/<script[\s\S]*?<\/script>/g, '').replace(/<\?[\s\S]*?\?>/g, 'test'));
                if (name === 'menu') {
                    assert.equal(await page.locator('nav .section-link').count(), 3);
                    assert.equal(await page.getByRole('link', { name: /Gestione recensioni/ }).getAttribute('href'), 'gestione-recensioni.php?sezione=recensioni');
                    assert.equal(await page.getByRole('link', { name: /QR code/ }).getAttribute('href'), 'gestione-recensioni.php?sezione=qrcode');
                    assert.equal(await page.getByRole('link', { name: /Statistiche visite/ }).getAttribute('href'), 'gestione-recensioni.php?sezione=statistiche');
                } else {
                    const expected = ['https://www.ferriristrutturazioni.com/', 'https://www.instagram.com/ferriristrutturazioni/'];
                    assert.deepEqual(await page.locator('[data-qr-url]').evaluateAll(elements => elements.map(element => element.dataset.qrUrl)), expected);
                    await page.addScriptTag({ path: path.join(root, 'assets/js/vendor/qrcode.min.js') });
                    await page.addScriptTag({ path: path.join(root, 'assets/js/admin-qrcodes.js') });
                    assert.equal(await page.locator('.qr-image canvas').count(), 2);
                    for (let index = 0; index < 2; index++) {
                        const matches = await page.locator('.qr-image').nth(index).evaluate((element, url) => {
                            const test = document.createElement('div');
                            new QRCode(test, { text: url, width: 240, height: 240, colorDark: '#000000', colorLight: '#ffffff', correctLevel: QRCode.CorrectLevel.M });
                            return element.querySelector('canvas').toDataURL() === test.querySelector('canvas').toDataURL();
                        }, expected[index]);
                        assert.ok(matches, 'Rendered QR must encode the expected destination');
                    }
                    assert.equal(await page.getByRole('link', { name: 'Apri Instagram', exact: true }).getAttribute('href'), expected[1]);
                    if (width === 1280 && process.env.ADMIN_PREVIEW_PATH) await page.screenshot({ path: process.env.ADMIN_PREVIEW_PATH, fullPage: true });
                }
                assert.ok(await page.evaluate(() => document.documentElement.scrollWidth <= innerWidth), `${name} fits ${width}px`);
                assert.equal(await page.locator('header input[name=csrf]').count(), 1);
            }
            await page.close();
        }
        console.log('Three-section dashboard, QR destinations and mobile layout checks passed.');
    } finally { await browser.close(); }
})().catch(error => { console.error(error); process.exitCode = 1; });
