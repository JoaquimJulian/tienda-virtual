class ManejadorPopups {
    constructor() {
        this.popups = document.querySelectorAll('.popup');

        document.addEventListener('click', (event) => this.cerrarDesdeBoton(event));
    }

    abrirPopup(popupId) {
        if (popupId.endsWith('Registrado')) {
            this.popups.forEach(popup => {
                if (popup.id !== 'registroPopup') {
                    popup.classList.add('hidden');
                }
            });
        } else {
            this.popups.forEach(popup => popup.classList.add('hidden'));
        }

        const popupAbrir = document.getElementById(popupId);
        if (popupAbrir) {
            popupAbrir.classList.remove('hidden');
        } else {
            console.log("⚠️ No existe este popup:", popupId);
        }
    }

    cerrarPopup(popupId) {
        const popup = document.getElementById(popupId);
        if (popup) {
            popup.classList.add('hidden');
        }
    }

    cerrarDesdeBoton(evento) {
        if (evento.target.classList.contains('close')) {
            const popup = evento.target.closest('.popup');
            if (popup) {
                popup.classList.add('hidden');
            }
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const manejador = new ManejadorPopups();

    window.abrirPopup = manejador.abrirPopup.bind(manejador);
    window.cerrarPopup = manejador.cerrarPopup.bind(manejador);
});
