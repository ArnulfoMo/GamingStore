'use strict';

document.querySelectorAll('[data-role-form], [data-status-form]').forEach(form => {
    form.addEventListener('submit', async event => {
        event.preventDefault();
        const button = form.querySelector('button[type="submit"]');
        const select = form.querySelector('select');
        const status = document.getElementById('user-status');
        const data = new FormData(form);
        button.disabled = true;
        if (select) select.disabled = true;
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
                const message = result.errors ? Object.values(result.errors).flat().join(' ') : (result.message || 'No se pudo guardar el cambio. Revisa tu sesión e inténtalo nuevamente.');
                throw new Error(message);
            }

            const row = form.closest('tr');
            if (form.hasAttribute('data-role-form')) {
                row.querySelector('[data-current-role]').textContent = result.role;
            } else {
                const badge = row.querySelector('[data-current-status]');
                const action = result.activo ? 'Desactivar' : 'Activar';
                badge.textContent = result.activo ? 'Activa' : 'Desactivada';
                badge.className = `badge ${result.activo ? 'text-bg-success' : 'text-bg-secondary'}`;
                form.querySelector('[name="activo"]').value = result.activo ? '0' : '1';
                button.textContent = action;
                button.className = `btn btn-sm ${result.activo ? 'btn-outline-danger' : 'btn-outline-success'}`;
                button.setAttribute('aria-label', `${action} cuenta de ${form.dataset.userName}`);
            }
            status.textContent = result.message;
            status.className = 'alert alert-success';
        } catch (error) {
            status.textContent = error instanceof SyntaxError || error instanceof TypeError
                ? 'No se pudo guardar el cambio. Revisa tu conexión y tu sesión.'
                : error.message;
            status.className = 'alert alert-danger';
        } finally {
            button.disabled = false;
            if (select) select.disabled = false;
        }
    });
});
