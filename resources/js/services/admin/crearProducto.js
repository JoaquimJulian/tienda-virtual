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

        // Formatear el valor según el formato AA-000-AA
        let part1 = value.substring(0, 2); 
        let part2 = value.substring(2, 5); 
        let part3 = value.substring(5); 

        // Reemplazar la parte de los números por lo que se haya escrito (si no es un número, no se permite)
        part2 = part2.replace(/\D/g, '');  

        // Ensamblar el código con las partes correctamente formateadas
        if (part1.length > 2) part1 = part1.substring(0, 2); 
        if (part2.length > 3) part2 = part2.substring(0, 3);
        if (part3.length > 2) part3 = part3.substring(0, 2); 

        value = part1 + (part2.length ? '-' + part2 : '') + (part3.length ? '-' + part3 : '');

        // Asignar el valor formateado al campo de entrada
        e.target.value = value.toUpperCase(); 
    });
})