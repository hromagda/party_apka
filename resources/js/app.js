import './bootstrap';

import $ from 'jquery';
window.$ = window.jQuery = $;

$(document).ready(function () {
    // AJAX pro odeslání formuláře písničky
    $('#form-pisnicky').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            success: function(response) {
                // Přidání nové písničky do seznamu
                $('#pisnicky-list').append(response.html);
                form[0].reset();
            },
            error: function(xhr) {
                console.error('Chyba při odesílání písničky:', xhr);
            }
        });
    });

    // AJAX pro odeslání vzkazu
    $('#form-vzkaz').submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            method: 'POST',
            data: formData,
            success: function(response) {
                // Přidání nového vzkazu do seznamu
                $('#vzkazy-list').append(response.html);
                form[0].reset();
            },
            error: function(xhr) {
                console.error('Chyba při odesílání vzkazu:', xhr);
            }
        });
    });
});

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/service-worker.js').then(
            (registration) => {
                console.log('Service Worker registrado con éxito:', registration);
            },
            (error) => {
                console.log('Error al registrar el Service Worker:', error);
            }
        );
    });
}
