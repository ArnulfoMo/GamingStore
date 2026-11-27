'use strict';

document.querySelectorAll('[data-register-form]').forEach(form => {
    form.querySelectorAll('[data-availability-field]').forEach(input => {
        const status = document.getElementById(`${input.id}-status`);
        const field = input.dataset.availabilityField;
        let timer;
        let controller;
        let revision = 0;

        const showStatus = (message, state = 'muted') => {
            status.textContent = message;
            status.className = `d-block mt-1 text-${state}`;
            input.classList.toggle('is-invalid', state === 'danger');
            input.classList.toggle('is-valid', state === 'success');
            input.setAttribute('aria-invalid', String(state === 'danger'));
            input.setCustomValidity(state === 'danger' ? message : '');
        };

        const scheduleCheck = () => {
            clearTimeout(timer);
            controller?.abort();
            const currentRevision = ++revision;
            showStatus('');

            const value = input.value.trim();
            if (!value || !input.validity.valid) {
                return;
            }

            showStatus('Comprobando disponibilidad…');
            timer = setTimeout(async () => {
                controller = new AbortController();

                try {
                    const response = await fetch(form.dataset.availabilityUrl, {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                        },
                        body: JSON.stringify({ field, value }),
                        signal: controller.signal,
                    });

                    if (currentRevision !== revision) return;

                    if (response.status === 422) {
                        const result = await response.json();
                        if (currentRevision !== revision) return;
                        showStatus(result.errors?.value?.[0] ?? 'Revisa el valor introducido.', 'danger');
                        return;
                    }

                    if (!response.ok) throw new Error('Availability check failed');

                    const result = await response.json();
                    if (currentRevision !== revision) return;
                    if (typeof result.available !== 'boolean') throw new Error('Invalid availability response');

                    const label = field === 'email' ? 'Correo electrónico' : 'Gamertag';
                    showStatus(
                        result.available ? `${label} disponible.` : `${label} ya está en uso.`,
                        result.available ? 'success' : 'danger',
                    );
                } catch (error) {
                    if (error.name === 'AbortError' || currentRevision !== revision) return;
                    showStatus('No se pudo comprobar la disponibilidad. Se validará al crear la cuenta.');
                }
            }, 400);
        };

        input.addEventListener('input', scheduleCheck);
        input.addEventListener('change', scheduleCheck);
        if (input.value) scheduleCheck();
    });
});
