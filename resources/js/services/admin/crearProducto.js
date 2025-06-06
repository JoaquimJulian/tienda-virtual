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

    document.getElementById('codigo').addEventListener('input', function(e) {
        let value = e.target.value;
    
        // Eliminar caracteres no válidos (solo letras y números)
        value = value.replace(/[^A-Za-z0-9]/g, '');
    
        // Convertir a mayúsculas
        value = value.toUpperCase();
    
        // Dividir en partes: 2 letras, 3 números, 2 letras
        let part1 = value.substring(0, 2).replace(/[^A-Z]/g, '');
        let part2 = value.substring(2, 5).replace(/\D/g, '');
        let part3 = value.substring(5, 7).replace(/[^A-Z]/g, '');
    
        // Ensamblar el valor como AA000-AA
        let formatted = part1 + part2;
        if (part3.length > 0) {
            formatted += '-' + part3;
        }
    
        // Asignar el valor formateado al input
        e.target.value = formatted;
    });
})