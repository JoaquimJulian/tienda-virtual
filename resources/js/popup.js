// Función para abrir un popup por su ID
function abrirPopup(popupId) {
    const popups = document.querySelectorAll('.popup');
    popups.forEach((popup) => {
        if (popupId.endsWith('Registrado')) {
            // Ocultar todos los popups excepto "registroPopup"
            document.querySelectorAll('.popup').forEach(p => {
                if (p.id !== 'registroPopup') {
                    p.classList.add('hidden');
                }
            });
        } else {
            popup.classList.add('hidden');
        }
    });

    // Abrir el popup solicitado
    const popupAbrir = document.getElementById(popupId);
    if (popupAbrir) {
        popupAbrir.classList.remove('hidden');
    } else {
        console.log("No existe este popup");
    }
}

// Función para cerrar un popup por su ID
function cerrarPopup(popupId) {
    const popup = document.getElementById(popupId);
    if (popup) {
        popup.classList.add('hidden');
    }
}

// Cerrar el popup con el botón de cerrar
document.addEventListener('click', (event) => {
    if (event.target.classList.contains('close')) {
        const popup = event.target.closest('.popup');
        if (popup) {
            popup.classList.add('hidden');
        }
    }
});

// Exponer las funciones al ámbito global
window.abrirPopup = abrirPopup;
window.cerrarPopup = cerrarPopup;