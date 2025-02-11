let divCategorias = document.getElementById('categorias');
let categorias = [];
let form = document.getElementById("categoriaForm");

actualizarCategorias()

function actualizarCategorias(nombre){
    fetch('/categoria') 
    .then(response => response.json()) // Convertir la respuesta a JSON
    .then(data => {
        categorias = data; // Almacenar las categorías en el array
        if(nombre){
            divCategorias.innerHTML += nombre + "<br>"
        }else {
            categorias.forEach(categoria => {
                divCategorias.innerHTML += categoria.nombre + "<br>"
            });
        }    
    })
    .catch(error => console.error('Error al obtener las categorías:', error))
}

form.addEventListener("submit", function (event) {
    event.preventDefault()
    let nombre = document.getElementById("nombre").value;

    fetch("/categoria", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
        },
        body: JSON.stringify({ nombre: nombre })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            actualizarCategorias(nombre)
            form.reset();
        } else {
            console.log("Error al crear la categoría.");
        }
    })
    .catch(error => {
        console.error("Error:", error);
    });
});

