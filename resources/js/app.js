

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener("submit", (event) => {
    if (!event.target.matches("[data-confirm]")) return;
    if (!confirm(event.target.dataset.confirm)) event.preventDefault();
});
