window.enviarFormularioAuth = function (formId, url, onSuccess) {
    document.getElementById(formId).addEventListener('submit', async function (e) {
        e.preventDefault();

        const errorBox = document.getElementById('mensaje-error');
        errorBox.classList.add('hidden');
        errorBox.innerHTML = '';

        const datos = {};
        for (const el of this.elements) {
            if (el.name) datos[el.name] = el.value;
        }

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(datos),
            });

            const data = await response.json();

            if (!response.ok) {
                const mensajes = data.message ? [data.message] : Object.values(data).flat();
                errorBox.innerHTML = mensajes.join('<br>');
                errorBox.classList.remove('hidden');
                return;
            }

            onSuccess(data);

        } catch (error) {
            errorBox.textContent = 'No se pudo conectar con el servidor.';
            errorBox.classList.remove('hidden');
        }
    });
};

async function cerrarSesion() {
    const token = localStorage.getItem('token');
    try {
        await fetch('/api/logout', {
            method: 'POST',
            headers: {
                'Authorization': 'Bearer ' + token,
                'Accept': 'application/json',
            },
        });
    } catch (error) { }

    localStorage.removeItem('token');
    window.location.href = '/';
}

document.addEventListener('DOMContentLoaded', function () {
    const token = localStorage.getItem('token');

    const linkInicio = document.getElementById('link-inicio');
    const btnLogoutDesktop = document.getElementById('btn-logout-desktop');
    const navModulos = document.getElementById('nav-modulos');
    const btnHamburguesa = document.getElementById('btn-hamburguesa');
    const menuMovil = document.getElementById('menu-movil');

    if (token) {
        if (linkInicio) {
            linkInicio.href = '/dashboard';
        }
        if (btnLogoutDesktop) {
            btnLogoutDesktop.classList.remove('hidden');
            btnLogoutDesktop.classList.add('inline-block');
            btnLogoutDesktop.addEventListener('click', cerrarSesion);
        }
        if (navModulos) {
            navModulos.classList.remove('hidden');
            navModulos.classList.add('flex');
        }
        if (btnHamburguesa) {
            btnHamburguesa.classList.remove('hidden');
            btnHamburguesa.classList.add('md:hidden');
            btnHamburguesa.addEventListener('click', function () {
                menuMovil.classList.toggle('hidden');
                menuMovil.classList.toggle('flex');
            });
        }
        const btnLogoutMovil = document.getElementById('btn-logout-movil');
        if (btnLogoutMovil) {
            btnLogoutMovil.addEventListener('click', cerrarSesion);
        }
        document.getElementById('nav-derecha').classList.add('hidden', 'md:flex');
    }
});

window.protegerPagina = function () {
    if (!localStorage.getItem('token')) {
        window.location.href = '/login';
    }
};

document.addEventListener('DOMContentLoaded', function () {
    const token = localStorage.getItem('token');
    if (!token) return;

    document.querySelectorAll('form').forEach(function (form) {
        const inputToken = document.createElement('input');
        inputToken.type = 'hidden';
        inputToken.name = 'token';
        inputToken.value = token;
        form.appendChild(inputToken);
    });
});