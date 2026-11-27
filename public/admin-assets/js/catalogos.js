'use strict';

document.addEventListener('DOMContentLoaded', () => {
    const lista = document.querySelector('[data-catalogo-lista]');
    if (!lista) return;

    const ventana = document.getElementById('catalogo-modal');
    const modal = new bootstrap.Modal(ventana);
    const contenido = document.getElementById('catalogo-modal-contenido');
    const titulo = document.getElementById('catalogo-modal-titulo');
    const estado = document.getElementById('catalogo-status');

    function mostrarMensaje(mensaje, tipo) {
        estado.textContent = mensaje;
        estado.className = `alert alert-${tipo}`;
    }

    async function cargarVista(url) {
        const respuesta = await fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
        });
        if (respuesta.redirected) {
            window.location.href = respuesta.url;
            return null;
        }
        if (!respuesta.ok) throw new Error('No se pudo cargar la información. Revisa tu sesión y vuelve a intentarlo.');
        return respuesta.text();
    }

    async function actualizarLista(url) {
        const html = await cargarVista(url);
        if (html !== null) lista.innerHTML = html;
    }

    document.addEventListener('click', async event => {
        if (event.button !== 0 || event.ctrlKey || event.metaKey || event.shiftKey || event.altKey) return;

        const cerrar = event.target.closest('[data-catalogo-cerrar]');
        if (cerrar) {
            event.preventDefault();
            modal.hide();
            return;
        }

        const enlace = event.target.closest('a[data-catalogo-modal]');
        if (enlace) {
            event.preventDefault();
            titulo.textContent = enlace.dataset.titulo;
            contenido.textContent = 'Cargando…';
            modal.show();
            try {
                const html = await cargarVista(enlace.href);
                if (html !== null) contenido.innerHTML = html;
            } catch (error) {
                contenido.textContent = error.message;
            }
            return;
        }

        const pagina = event.target.closest('[data-catalogo-paginacion] a');
        if (pagina) {
            event.preventDefault();
            try {
                await actualizarLista(pagina.href);
            } catch (error) {
                mostrarMensaje(error.message, 'danger');
            }
        }
    });

    document.addEventListener('submit', async event => {
        const formulario = event.target;
        if (!formulario.matches('[data-catalogo-form]') || event.defaultPrevented) return;
        event.preventDefault();

        const boton = formulario.querySelector('button[type="submit"]');
        const errores = formulario.querySelector('[data-catalogo-errores]');
        const datos = new FormData(formulario);
        boton.disabled = true;
        if (errores) errores.classList.add('d-none');
        formulario.querySelectorAll('.is-invalid').forEach(campo => campo.classList.remove('is-invalid'));

        try {
            const respuesta = await fetch(formulario.action, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: datos,
            });
            if (respuesta.status === 419 || respuesta.status === 401) {
                throw new Error('Tu sesión venció. Recarga la página para continuar.');
            }
            if (respuesta.status === 403) throw new Error('No tienes permiso para realizar esta acción.');
            if (respuesta.status >= 500) throw new Error('No se pudo guardar el cambio. Inténtalo nuevamente.');

            const resultado = await respuesta.json();
            if (!respuesta.ok) {
                if (resultado.errors) {
                    for (const nombre in resultado.errors) {
                        const campo = formulario.elements.namedItem(nombre);
                        if (campo && campo.classList) campo.classList.add('is-invalid');
                    }
                    throw new Error(Object.values(resultado.errors).flat().join(' '));
                }
                throw new Error('No se pudo guardar el cambio. Revisa los datos.');
            }

            modal.hide();
            mostrarMensaje(resultado.message, 'success');
            try {
                await actualizarLista(lista.dataset.url);
            } catch {
                mostrarMensaje('El cambio se guardó, pero no se pudo actualizar el listado. Recarga la página.', 'warning');
            }
        } catch (error) {
            const mensaje = error instanceof TypeError || error instanceof SyntaxError
                ? 'No se pudo guardar el cambio. Revisa tu conexión e inténtalo nuevamente.'
                : error.message;
            if (errores) {
                errores.textContent = mensaje;
                errores.classList.remove('d-none');
            } else {
                mostrarMensaje(mensaje, 'danger');
            }
        } finally {
            boton.disabled = false;
        }
    });
});
