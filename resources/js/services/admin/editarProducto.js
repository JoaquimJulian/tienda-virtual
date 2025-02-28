let inputPrecio = document.getElementById('precio')

    inputPrecio.addEventListener('input', function() {
        // Asegura que solo el valor sea numérico
        let value = inputPrecio.value;

        // Remueve cualquier valor que no sea un número
        inputPrecio.value = value.replace(/[^0-9]/g, '');  // Reemplaza todo lo que no sea un número
    });