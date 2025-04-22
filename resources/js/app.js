import './bootstrap';

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
