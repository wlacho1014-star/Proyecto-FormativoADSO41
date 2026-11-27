/**
 * FERREAGRO TYT – Comportamiento del sitio web público.
 * Evidencia GA7-220501096-AA4-EV03 · Componente front-end.
 * Autor: José Wladimir Carrillo López · Ficha 3336129 (ADSO 41).
 *
 * Contiene:
 *  1. Menú desplegable para pantallas de celular.
 *  2. Validación en el navegador del formulario de contacto.
 *
 * La validación del navegador mejora la experiencia, pero no reemplaza a la
 * del servidor: Laravel vuelve a validar los datos en la ruta POST /contacto.
 *
 * Convenciones: modo estricto, const/let, funciones con nombres en español,
 * comillas simples, sangría de 4 espacios y punto y coma al final.
 */
(function () {
    'use strict';

    /* ----------------------------------------------------------------------
     * Configuración de las reglas de validación.
     * Los textos son los mismos que devuelve el servidor (routes/web.php).
     * ---------------------------------------------------------------------- */
    const MINIMO_NOMBRE = 3;
    const MAXIMO_NOMBRE = 60;
    const MAXIMO_CORREO = 100;
    const MINIMO_MENSAJE = 10;
    const MAXIMO_MENSAJE = 1000;
    const PATRON_CORREO = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    /* ----------------------------------------------------------------------
     * 1. Menú desplegable
     * ---------------------------------------------------------------------- */

    /**
     * Abre y cierra el menú de navegación en pantallas pequeñas.
     * Actualiza aria-expanded para que los lectores de pantalla conozcan
     * el estado del botón.
     */
    function iniciarMenu() {
        const boton = document.querySelector('.menu__boton');
        const menu = document.getElementById('menu-principal');

        // Si la página no tiene menú, no hay nada que hacer.
        if (!boton || !menu) {
            return;
        }

        boton.addEventListener('click', function () {
            const abierto = menu.classList.toggle('menu--abierto');
            boton.setAttribute('aria-expanded', String(abierto));
        });

        // Con la tecla Escape se cierra el menú y el foco vuelve al botón.
        document.addEventListener('keydown', function (evento) {
            if (evento.key === 'Escape' && menu.classList.contains('menu--abierto')) {
                menu.classList.remove('menu--abierto');
                boton.setAttribute('aria-expanded', 'false');
                boton.focus();
            }
        });
    }

    /* ----------------------------------------------------------------------
     * 2. Validación del formulario de contacto
     * ---------------------------------------------------------------------- */

    /**
     * Revisa un campo y devuelve el mensaje de error correspondiente.
     *
     * @param {HTMLInputElement|HTMLTextAreaElement} campo Campo a validar.
     * @returns {string} Mensaje de error, o cadena vacía si el valor es válido.
     */
    function validarCampo(campo) {
        const valor = campo.value.trim();

        switch (campo.name) {
            case 'nombre':
                if (valor === '') {
                    return 'Escribe tu nombre.';
                }
                if (valor.length < MINIMO_NOMBRE) {
                    return 'El nombre debe tener al menos ' + MINIMO_NOMBRE + ' caracteres.';
                }
                if (valor.length > MAXIMO_NOMBRE) {
                    return 'El nombre no puede tener más de ' + MAXIMO_NOMBRE + ' caracteres.';
                }
                return '';

            case 'correo':
                if (valor === '') {
                    return 'Escribe tu correo electrónico.';
                }
                if (!PATRON_CORREO.test(valor)) {
                    return 'Escribe un correo electrónico válido.';
                }
                if (valor.length > MAXIMO_CORREO) {
                    return 'El correo no puede tener más de ' + MAXIMO_CORREO + ' caracteres.';
                }
                return '';

            case 'mensaje':
                if (valor === '') {
                    return 'Escribe tu mensaje.';
                }
                if (valor.length < MINIMO_MENSAJE) {
                    return 'El mensaje debe tener al menos ' + MINIMO_MENSAJE + ' caracteres.';
                }
                if (valor.length > MAXIMO_MENSAJE) {
                    return 'El mensaje no puede tener más de ' + MAXIMO_MENSAJE + ' caracteres.';
                }
                return '';

            default:
                return '';
        }
    }

    /**
     * Muestra u oculta el mensaje de error de un campo.
     *
     * @param {HTMLInputElement|HTMLTextAreaElement} campo Campo revisado.
     * @param {string} mensaje Texto del error; vacío para limpiar el error.
     */
    function mostrarError(campo, mensaje) {
        const contenedor = campo.closest('.campo');
        const zonaError = document.getElementById(campo.id + '-error');
        const hayError = mensaje !== '';

        if (zonaError) {
            zonaError.textContent = mensaje;
        }
        if (contenedor) {
            contenedor.classList.toggle('campo--invalido', hayError);
        }
        campo.setAttribute('aria-invalid', hayError ? 'true' : 'false');
    }

    /**
     * Activa la validación del formulario marcado con data-validar.
     * Los campos se revisan al salir de ellos y al enviar el formulario.
     */
    function iniciarFormulario() {
        const formulario = document.querySelector('[data-validar]');

        if (!formulario) {
            return;
        }

        const campos = formulario.querySelectorAll('[required]');

        campos.forEach(function (campo) {
            // Al salir del campo se revisa su valor.
            campo.addEventListener('blur', function () {
                mostrarError(campo, validarCampo(campo));
            });

            // Mientras escribe, solo se actualiza un error que ya se mostró.
            campo.addEventListener('input', function () {
                if (campo.getAttribute('aria-invalid') === 'true') {
                    mostrarError(campo, validarCampo(campo));
                }
            });
        });

        formulario.addEventListener('submit', function (evento) {
            let primerInvalido = null;

            campos.forEach(function (campo) {
                const mensaje = validarCampo(campo);
                mostrarError(campo, mensaje);

                if (mensaje !== '' && primerInvalido === null) {
                    primerInvalido = campo;
                }
            });

            // Si hay errores, no se envía y el foco va al primer campo inválido.
            if (primerInvalido !== null) {
                evento.preventDefault();
                primerInvalido.focus();
            }
        });
    }

    /* ----------------------------------------------------------------------
     * Arranque: se inicia todo cuando el documento está listo.
     * ---------------------------------------------------------------------- */
    document.addEventListener('DOMContentLoaded', function () {
        iniciarMenu();
        iniciarFormulario();
    });
}());
