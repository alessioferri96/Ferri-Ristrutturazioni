document.querySelectorAll('[data-qr-url]').forEach(function (element) {
    try {
        new QRCode(element, {
            text: element.dataset.qrUrl,
            width: 240,
            height: 240,
            colorDark: '#000000',
            colorLight: '#ffffff',
            correctLevel: QRCode.CorrectLevel.M
        });
        element.removeAttribute('title');
    } catch (error) {
        element.removeAttribute('role');
        element.textContent = 'QR non disponibile. Usa il pulsante qui sotto.';
    }
});
