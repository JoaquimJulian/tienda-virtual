document.addEventListener("DOMContentLoaded", function(){
    fetch("/categoria", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => response.json())
    .then(data => {
        let select = document.getElementById("categoria");
        data.forEach(categoria => {
            let option = document.createElement("option");
            option.value = categoria.id; 
            option.textContent = categoria.nombre; 
            select.appendChild(option);
        });
    })
    .catch(error => console.error("Error al cargar las categorías:", error));

    let inputPrecio = document.getElementById('precio')

    inputPrecio.addEventListener('input', function() {
        // Asegura que solo el valor sea numérico
        let value = inputPrecio.value;

        // Remueve cualquier valor que no sea un número
        inputPrecio.value = value.replace(/[^0-9]/g, '');  // Reemplaza todo lo que no sea un número
    });
})