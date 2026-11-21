'use strict';

document.querySelectorAll('.toggle-pass').forEach(button => {
    button.addEventListener('click', () => {
        const input = document.getElementById(button.dataset.target);
        const visible = input.type === 'password';
        input.type = visible ? 'text' : 'password';
        button.setAttribute('aria-label', visible ? 'Ocultar contraseña' : 'Mostrar contraseña');
        button.setAttribute('aria-pressed', String(visible));
        button.querySelector('i').className = visible ? 'fas fa-eye-slash' : 'fas fa-eye';
    });
});
