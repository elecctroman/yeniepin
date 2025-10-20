import { csrfFetch, showToast } from './app.js';

document.querySelectorAll('[data-action="toggle-maintenance"]').forEach((button) => {
    button.addEventListener('click', async () => {
        try {
            await csrfFetch('/admin/maintenance/toggle', { method: 'POST' });
            showToast({ message: 'Bakım modu güncellendi', variant: 'success' });
        } catch (error) {
            showToast({ message: error.message, variant: 'danger' });
        }
    });
});

const charts = document.querySelectorAll('[data-chart]');
charts.forEach((element) => {
    element.addEventListener('click', () => {
        showToast({ message: `${element.dataset.chart} grafiği yakında`, variant: 'warning' });
    });
});
