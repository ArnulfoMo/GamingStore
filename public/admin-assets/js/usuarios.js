'use strict';

document.querySelectorAll('[data-role-form]').forEach(form => {
    form.addEventListener('submit', async event => {
        event.preventDefault();
        const button = form.querySelector('button[type="submit"]');
        const select = form.querySelector('select');
        const status = document.getElementById('role-status');
        const data = new FormData(form);
        button.disabled = true;
        select.disabled = true;
        status.className = 'alert d-none';

        try {
            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: data,
            });
            const result = await response.json();

            if (!response.ok) {
                const message = result.errors ? Object.values(result.errors).flat().join(' ') : 'No se pudo guardar el rol. Revisa tu sesión e inténtalo nuevamente.';
                throw new Error(message);
            }

            form.closest('tr').querySelector('[data-current-role]').textContent = result.role;
            status.textContent = result.message;
            status.className = 'alert alert-success';
        } catch (error) {
            status.textContent = error instanceof SyntaxError || error instanceof TypeError
                ? 'No se pudo guardar el rol. Revisa tu conexión y tu sesión.'
                : error.message;
            status.className = 'alert alert-danger';
        } finally {
            button.disabled = false;
            select.disabled = false;
        }
    });
});
