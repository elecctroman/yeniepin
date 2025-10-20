const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

export async function csrfFetch(url, options = {}) {
    const headers = new Headers(options.headers || {});
    headers.set('X-CSRF-TOKEN', csrfToken);
    headers.set('X-Requested-With', 'XMLHttpRequest');
    const config = { ...options, headers };
    const response = await fetch(url, config);
    if (!response.ok) {
        throw new Error('İstek başarısız oldu');
    }
    return response;
}

export function openModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.add('active');
    }
}

export function closeModal(id) {
    const modal = document.getElementById(id);
    if (modal) {
        modal.classList.remove('active');
    }
}

export function showToast({ message, variant = 'success', timeout = 4000 }) {
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `toast ${variant}`;
    toast.textContent = message;
    container.appendChild(toast);

    setTimeout(() => {
        toast.classList.add('hide');
        toast.addEventListener('transitionend', () => toast.remove());
    }, timeout);
}

export function copyKey(text) {
    navigator.clipboard.writeText(text).then(() => {
        showToast({ message: 'Anahtar panoya kopyalandı', variant: 'success' });
    }).catch(() => {
        showToast({ message: 'Anahtar kopyalanamadı', variant: 'danger' });
    });
}

export function validateForm(form) {
    const invalid = Array.from(form.querySelectorAll('[required]'))
        .filter((field) => !field.value.trim());

    invalid.forEach((field) => {
        field.classList.add('is-invalid');
    });

    return invalid.length === 0;
}

window.addEventListener('submit', (event) => {
    const form = event.target;
    if (form instanceof HTMLFormElement && !validateForm(form)) {
        event.preventDefault();
        showToast({ message: 'Lütfen zorunlu alanları doldurun', variant: 'warning' });
    }
});
