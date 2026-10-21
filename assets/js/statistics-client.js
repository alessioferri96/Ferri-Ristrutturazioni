(function () {
    'use strict';
    const allowed = ['/', '/index.html', '/chi-siamo.html', '/contatti.html', '/servizi.html', '/progetti.html', '/progetto-appartamento-frascati.html', '/progetto-locale-frascati.html', '/progetto-negozio-roma.html', '/ristrutturazioni-frascati.html'];
    if (location.protocol !== 'https:') return;
    const trackable = allowed.includes(location.pathname);
    if (!trackable && location.pathname !== '/statistiche-privacy.html') return;
    if (window.ferriStatisticsLoaded) return;
    window.ferriStatisticsLoaded = true;
    const storageKey = 'ferri_statistics_visitor';
    const consentKey = 'ferri_statistics_consent';
    let sent = false;
    let sending = false;
    let attempts = 0;
    let timer;
    const randomId = () => Array.from(crypto.getRandomValues(new Uint8Array(16)), byte => byte.toString(16).padStart(2, '0')).join('');
    let eventId = randomId();

    function localPreference() {
        try {
            const stored = JSON.parse(localStorage.getItem(consentKey) || 'null');
            return stored && stored.expires > Date.now() && typeof stored.granted === 'boolean' ? stored.granted : undefined;
        } catch (error) { return undefined; }
    }

    function categoryPreference() {
        try {
            const preferences = window._iub?.cs?.api?.getPreferences?.();
            if (preferences?.purposes && Object.prototype.hasOwnProperty.call(preferences.purposes, '4')) return preferences.purposes[4] === true;
        } catch (error) { /* Wait for the existing privacy controls. */ }
        return undefined;
    }

    function choose(granted) {
        try {
            localStorage.setItem(consentKey, JSON.stringify({ granted, expires: Date.now() + 30 * 86400000 }));
            if (!granted) localStorage.removeItem(storageKey);
        } catch (error) { return; }
        document.getElementById('statistics-notice')?.remove();
        const feedback = document.getElementById('statistics-preference-status');
        if (feedback) feedback.textContent = granted ? 'Hai consentito alle statistiche delle visite.' : 'Hai rifiutato le statistiche delle visite.';
        measure();
    }

    function consentControls() {
        const knownCategory = categoryPreference();
        document.querySelectorAll('[data-statistics-choice]').forEach(button => {
            if (button.dataset.bound) return;
            button.dataset.bound = 'true';
            button.addEventListener('click', () => {
                if (categoryPreference() !== undefined) window._iub?.cs?.api?.openPreferences?.();
                else choose(button.dataset.statisticsChoice === 'yes');
            });
        });
        if (!trackable || knownCategory !== undefined || localPreference() !== undefined || navigator.globalPrivacyControl === true || navigator.doNotTrack === '1') {
            document.getElementById('statistics-notice')?.remove();
            return;
        }
        // Do not overlap the existing banner: ask after its first choice.
        try { if (window._iub?.cs?.api?.isPreferenceExpressed?.() !== true) return; } catch (error) { return; }
        if (document.getElementById('statistics-notice')) return;
        const notice = document.createElement('aside');
        notice.id = 'statistics-notice';
        notice.setAttribute('aria-label', 'Preferenze statistiche delle visite');
        notice.style.cssText = 'position:fixed;bottom:20px;right:20px;width:min(380px,calc(100vw - 40px));padding:22px;background:#171717;color:#fff;border:1px solid #777;z-index:10000;font:14px/1.5 Arial,sans-serif;box-shadow:0 8px 30px #0008';
        const text = document.createElement('p');
        text.style.cssText = 'margin:0 0 14px';
        text.textContent = 'Possiamo misurare le visite del sito? Useremo un codice casuale del browser per 30 giorni, senza raccogliere nomi, email o indirizzi IP nelle statistiche.';
        const more = document.createElement('a');
        more.href = '/statistiche-privacy.html';
        more.textContent = 'Come funziona e modifica preferenze';
        more.style.cssText = 'display:block;color:#fff;text-decoration:underline;margin-bottom:16px';
        notice.append(text, more);
        [false, true].forEach(granted => {
            const button = document.createElement('button');
            button.type = 'button';
            button.textContent = granted ? 'Consenti' : 'Rifiuta';
            button.style.cssText = 'padding:10px 18px;margin:0 10px 0 0;background:#fff;color:#111;border:1px solid #fff;cursor:pointer;font:inherit';
            button.addEventListener('click', () => choose(granted));
            notice.append(button);
        });
        document.body.append(notice);
    }

    function permission() {
        if (navigator.globalPrivacyControl === true || navigator.doNotTrack === '1') return false;
        const category = categoryPreference();
        return category !== undefined ? category : localPreference();
    }

    async function measure() {
        consentControls();
        const consent = permission();
        if (consent === false) {
            try { localStorage.removeItem(storageKey); } catch (error) { /* Storage unavailable. */ }
            return;
        }
        if (!trackable || consent !== true || document.visibilityState !== 'visible' || sent || sending || attempts >= 3) return;
        let visitor;
        try {
            const stored = JSON.parse(localStorage.getItem(storageKey) || 'null');
            if (stored && /^[a-f0-9]{32}$/.test(stored.id) && stored.expires > Date.now()) visitor = stored.id;
            else {
                visitor = randomId();
                localStorage.setItem(storageKey, JSON.stringify({ id: visitor, expires: Date.now() + 30 * 86400000 }));
            }
        } catch (error) { return; } // Do not replace blocked storage with fingerprinting.
        if (permission() !== true) return;
        sending = true;
        attempts++;
        try {
            const response = await fetch('/statistics-collect.php', {
                method: 'POST', credentials: 'omit', keepalive: true,
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ path: location.pathname, visitor, event: eventId, consent: true })
            });
            if (response.ok) sent = true;
        } catch (error) { /* Retry with the same event ID; the server deduplicates. */ }
        finally { sending = false; }
    }

    function start() { clearInterval(timer); measure(); timer = setInterval(measure, 2000); }
    document.addEventListener('visibilitychange', measure);
    window.addEventListener('online', () => { if (!sent) attempts = 0; measure(); });
    window.addEventListener('pagehide', () => clearInterval(timer));
    window.addEventListener('pageshow', event => { if (event.persisted) { sent = false; attempts = 0; eventId = randomId(); start(); } });
    start();
}());
