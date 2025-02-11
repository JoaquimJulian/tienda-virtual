document.addEventListener("DOMContentLoaded", function () {
    const trigger = document.getElementById("user-trigger");
    const dropdown = document.getElementById("dropdownHeader");

    if (trigger && dropdown) {
        trigger.addEventListener("click", function (event) {
            // Mostrar/ocultar el dropdown
            dropdown.classList.toggle("hidden");

            // Si el dropdown está visible, recalcular su posición
            if (!dropdown.classList.contains("hidden")) {
                // Calcular la posición del trigger
                const triggerRect = trigger.getBoundingClientRect();
                const dropdownWidth = dropdown.offsetWidth; // Ancho del dropdown
                const windowWidth = window.innerWidth; // Ancho de la ventana

                console.log(triggerRect); // Verifica las coordenadas del trigger

                // Posicionar el dropdown justo debajo del trigger
                dropdown.style.top = `${triggerRect.bottom + window.scrollY + 10}px`;  // 10px de separación

                // Ajustar la posición horizontal
                let dropdownLeft = triggerRect.left + window.scrollX;

                // Si el dropdown se pasa del borde derecho de la ventana, ajustar su posición
                if (dropdownLeft + dropdownWidth > windowWidth) {
                    dropdownLeft = windowWidth - dropdownWidth - 10;  // Ajustar al borde izquierdo si sobrepasa
                }

                // Ajustar la posición en el eje X
                dropdown.style.left = `${dropdownLeft}px`;
            }

            // Evitar que el clic en el trigger cierre el dropdown inmediatamente
            event.stopPropagation();
        });

        // Cerrar el dropdown si se hace clic fuera de él
        document.addEventListener("click", function (event) {
            if (!trigger.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add("hidden");
            }
        });
    } else {
        console.error("No se encontró el trigger o el dropdown.");
    }
});
