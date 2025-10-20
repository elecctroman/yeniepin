import { csrfFetch, showToast, copyKey } from './app.js';

document.querySelectorAll('[data-copy-key]').forEach((button) => {
    button.addEventListener('click', () => {
        const key = button.getAttribute('data-copy-key');
        if (key) {
            copyKey(key);
        }
    });
});

document.querySelectorAll('form[data-wallet-topup]').forEach((form) => {
    form.addEventListener('submit', async (event) => {
        event.preventDefault();
        const amount = form.querySelector('input[name="amount"]').value;
        try {
            await csrfFetch('/wallet/topup', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ amount }),
            });
            showToast({ message: 'Bakiye yükleme isteğiniz alındı', variant: 'success' });
        } catch (error) {
            showToast({ message: error.message, variant: 'danger' });
        }
    });
});
