const fs = require('node:fs');
const path = require('node:path');
const assert = require('node:assert/strict');
const { chromium } = require(process.env.PLAYWRIGHT_MODULE || 'playwright');
const script = path.resolve(__dirname, '../assets/js/statistics-client.js');
const privacy = fs.readFileSync(path.resolve(__dirname, '../statistiche-privacy.html'), 'utf8').replace(/<script[\s\S]*?<\/script>/g, '');

(async () => {
    const browser = await chromium.launch({ headless: true, ...(process.env.CHROME_PATH ? { executablePath: process.env.CHROME_PATH } : {}) });
    async function setup({ category, dnt, blocked } = {}) {
        const context = await browser.newContext({ viewport: { width: 320, height: 800 } });
        const events = [];
        await context.addInitScript(({ category, dnt, blocked }) => {
            window._iub = { cs: { api: { isPreferenceExpressed: () => true, getPreferences: () => ({ purposes: category === undefined ? { 1: true, 3: true } : { 1: true, 4: category } }) } } };
            if (dnt) Object.defineProperty(navigator, 'doNotTrack', { get: () => '1' });
            if (blocked) Object.defineProperty(window, 'localStorage', { get: () => { throw new Error('Storage blocked'); } });
        }, { category, dnt, blocked });
        await context.route('https://www.ferriristrutturazioni.com/**', async route => {
            if (route.request().url().endsWith('/statistics-collect.php')) {
                events.push(route.request().postDataJSON());
                await route.fulfill({ status: 204 });
            } else await route.fulfill({ status: 200, contentType: 'text/html', body: route.request().url().includes('statistiche-privacy.html') ? privacy : '<!doctype html><html><head><meta name="viewport" content="width=device-width,initial-scale=1"></head><body>Test page</body></html>' });
        });
        const page = await context.newPage();
        await page.goto('https://www.ferriristrutturazioni.com/');
        return { context, page, events };
    }
    try {
        const normal = await setup();
        await normal.page.addScriptTag({ path: script });
        assert.equal(normal.events.length, 0, 'No event without measurement consent');
        assert.equal(await normal.page.evaluate(() => localStorage.getItem('ferri_statistics_visitor')), null, 'No visitor identifier before consent');
        assert.equal(await normal.page.getByRole('button', { name: 'Consenti', exact: true }).count(), 1);
        const consentResponse = normal.page.waitForResponse(response => response.url().endsWith('/statistics-collect.php'));
        await normal.page.getByRole('button', { name: 'Consenti', exact: true }).click();
        await consentResponse;
        assert.equal(normal.events.length, 1);
        const first = normal.events[0];
        assert.match(first.visitor, /^[a-f0-9]{32}$/);
        await normal.page.evaluate(() => document.dispatchEvent(new Event('visibilitychange')));
        assert.equal(normal.events.length, 1, 'One count per document');
        await normal.page.goto('https://www.ferriristrutturazioni.com/contatti.html?email=private@example.com#private');
        const nextResponse = normal.page.waitForResponse(response => response.url().endsWith('/statistics-collect.php'));
        await normal.page.addScriptTag({ path: script });
        await nextResponse;
        assert.equal(normal.events[1].visitor, first.visitor, 'Same browser across pages');
        assert.notEqual(normal.events[1].event, first.event, 'New view for new page');
        assert.equal(normal.events[1].path, '/contatti.html', 'No query strings or fragment sent');
        assert.deepEqual(Object.keys(normal.events[1]).sort(), ['consent', 'event', 'path', 'visitor']);
        await normal.page.goto('https://www.ferriristrutturazioni.com/statistiche-privacy.html');
        await normal.page.addScriptTag({ path: script });
        await normal.page.getByRole('button', { name: 'Rifiuta statistiche', exact: true }).click();
        assert.equal(await normal.page.evaluate(() => localStorage.getItem('ferri_statistics_visitor')), null, 'Revocation removes browser ID');
        await normal.page.goto('https://www.ferriristrutturazioni.com/servizi.html');
        await normal.page.addScriptTag({ path: script });
        assert.equal(normal.events.length, 2, 'No tracking after revocation');
        await normal.context.close();

        for (const options of [{ category: false }, { category: true, dnt: true }, { category: true, blocked: true }]) {
            const denied = await setup(options);
            await denied.page.addScriptTag({ path: script });
            assert.equal(denied.events.length, 0, 'Category denial, DNT and blocked storage prevent collection');
            await denied.context.close();
        }
        const enabled = await setup({ category: true });
        const enabledResponse = enabled.page.waitForResponse(response => response.url().endsWith('/statistics-collect.php'));
        await enabled.page.addScriptTag({ path: script });
        await enabledResponse;
        assert.equal(enabled.events.length, 1, 'Explicit CMP measurement consent supported');
        await enabled.page.goto('https://www.ferriristrutturazioni.com/gestione-recensioni.php?sezione=statistiche');
        await enabled.page.addScriptTag({ path: script });
        assert.equal(enabled.events.length, 1, 'Private area excluded');
        await enabled.context.close();
        console.log('Statistics consent, revocation, privacy and browser deduplication checks passed.');
    } finally { await browser.close(); }
})().catch(error => { console.error(error); process.exitCode = 1; });
