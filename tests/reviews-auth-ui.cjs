// Local visual smoke test. Uses the bundled Playwright runtime on this PC.
const fs = require('node:fs');
const path = require('node:path');
const assert = require('node:assert/strict');
const { chromium } = require(process.env.PLAYWRIGHT_MODULE || 'playwright');

(async () => {
    const root = path.resolve(__dirname, '..');
    const source = fs.readFileSync(path.join(root, 'reviews-auth-page.php'), 'utf8');
    const head = source.slice(source.indexOf('<!doctype html>'), source.indexOf('<?php if ($error): ?>'));
    const uri = 'otpauth://totp/Ferri%20Ristrutturazioni%3AArea%20riservata?secret=GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ&issuer=Ferri%20Ristrutturazioni&algorithm=SHA1&digits=6&period=30';
    const segments = {
        setup: source.split('<?php elseif ($setup && !$enabled): ?>')[1].split('<?php elseif ($enabled): ?>')[0],
        login: source.split('<?php elseif ($enabled): ?>')[1].split('<?php else: ?>')[0],
        first: source.split('<?php else: ?>')[1].split('<?php endif; ?>')[0],
    };
    const browser = await chromium.launch({ headless: true, ...(process.env.CHROME_PATH ? { executablePath: process.env.CHROME_PATH } : {}) });
    try {
        for (const width of [320, 390, 1280]) {
            const page = await browser.newPage({ viewport: { width, height: 900 } });
            for (const [name, segment] of Object.entries(segments)) {
                const html = (head + segment + '</main></body></html>')
                    .replace(/<script[\s\S]*?<\/script>/g, '')
                    .replace(/<\?= reviews_auth_escape\(\$uri\) \?>/g, uri.replace(/&/g, '&amp;'))
                    .replace(/<\?= reviews_auth_escape\(\$setup\['secret'\]\) \?>/g, 'GEZDGNBVGY3TQOJQGEZDGNBVGY3TQOJQ')
                    .replace(/<\?[\s\S]*?\?>/g, 'test');
                await page.setContent(html);
                if (name === 'setup') {
                    await page.addScriptTag({ path: path.join(root, 'assets/js/vendor/qrcode.min.js') });
                    const result = await page.evaluate(() => {
                        const element = document.getElementById('auth-qr');
                        const qr = new QRCode(element, { text: element.dataset.uri, width: 224, height: 224, correctLevel: QRCode.CorrectLevel.M });
                        element.removeAttribute('title');
                        return { encoded: qr._oQRCode.dataList[0].data, modules: qr._oQRCode.moduleCount };
                    });
                    assert.equal(result.encoded, uri, 'QR must encode the complete setup URI');
                    assert.ok(result.modules >= 21, 'QR matrix generated');
                    await page.locator('details').evaluate(element => { element.open = true; });
                }
                assert.ok(await page.evaluate(() => document.documentElement.scrollWidth <= innerWidth), `${name} must fit at ${width}px`);
                if (name === 'login') {
                    assert.equal(await page.locator('input[type=password]').count(), 0, 'No password after activation');
                    await page.locator('#code').fill('12345');
                    assert.equal(await page.locator('#code').evaluate(element => element.checkValidity()), false);
                    await page.locator('#code').fill('012345');
                    assert.equal(await page.locator('#code').evaluate(element => element.checkValidity()), true);
                    assert.equal(await page.locator('input[name=csrf]').count(), 2, 'Login and recovery include CSRF tokens');
                }
                if (name === 'first') assert.equal(await page.locator('input[type=password]').count(), 1, 'Owner verification for first setup');
            }
            await page.close();
        }
        console.log('Auth UI, QR and mobile layout checks passed.');
    } finally {
        await browser.close();
    }
})().catch(error => { console.error(error); process.exitCode = 1; });
