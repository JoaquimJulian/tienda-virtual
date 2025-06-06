let header = document.getElementById('header');

document.getElementById('menu-toggle').addEventListener('click', function() {
    document.getElementById('user-actions').classList.toggle('hidden')
    document.getElementById('nav-general').classList.toggle('hidden');
})

// BARRA DE BUSQUEDA  

let inputBusqueda = document.getElementById('inputBusqueda')
let contenedorResultados = document.getElementById('resultadosBusquedaContainer')
let controller = new AbortController();

inputBusqueda.addEventListener('input', function(){
    contenedorResultados.innerHTML = ""
    let busqueda = inputBusqueda.value

    controller.abort();
    controller = new AbortController();

    if(busqueda == "") {
        contenedorResultados.className = "hidden"
    }

    fetch("/producto/indexSinPaginarJson", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        signal: controller.signal
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(producto => {
            console.log(producto)
            if (producto.nombre.toLowerCase().includes(busqueda) && busqueda != "" && !document.getElementById(`producto_${producto.codigo}`)) {
                contenedorResultados.className = "absolute left-0 shadow-md w-full rounded-lg p-4 z-10 bg-white";

                let productoDiv = document.createElement('div');
                productoDiv.className = "flex justify-between px-4 py-2 cursor-pointer hover:bg-marron hover:text-white rounded"
                productoDiv.id = `producto_${producto.codigo}`

                let nombreProducto = document.createElement('p');
                nombreProducto.textContent = producto.nombre; 

                let precioProducto = document.createElement('p');
                precioProducto.textContent = producto.precio_unidad + "$"; 

                // Agregar el nombre y precio al div del producto
                productoDiv.appendChild(nombreProducto);
                productoDiv.appendChild(precioProducto);

                // Agregar el div del producto al contenedor de resultados
                contenedorResultados.appendChild(productoDiv);

                productoDiv.addEventListener('click', function() {
                    window.location.href = `/producto/${producto.codigo}`;
                })
            }
        });
    })

})


document.addEventListener('DOMContentLoaded', function() {

  const categoriasMovilOculto = document.getElementById('categorias-movil-oculto');
  const categoriasMovilVisible = document.getElementById('categorias-movil-visible');
  const categoriasMovilOpciones = document.getElementById('categorias-movil-opciones');
  
  // Mostrar/Ocultar opciones de categorías en móvil
  categoriasMovilOculto.addEventListener('click', () => {
    categoriasMovilOpciones.classList.toggle('hidden');
    categoriasMovilOculto.classList.toggle('hidden');
    categoriasMovilVisible.classList.toggle('hidden');
  });

  categoriasMovilVisible.addEventListener('click', () => {
    categoriasMovilOpciones.classList.toggle('hidden');
    categoriasMovilVisible.classList.toggle('hidden');
    categoriasMovilOculto.classList.toggle('hidden');
  });
});  

// DROPBOX OPCIONES USUARIO

const dropdownBtn = document.getElementById("dropdownBtn");
const dropdownMenu = document.getElementById("dropdownMenu");
let timeout;

// Mostrar el dropdown al pasar el mouse
dropdownBtn.addEventListener("mouseenter", function() {
    clearTimeout(timeout); // Evitar que se cierre si el mouse entra rápidamente
    dropdownMenu.classList.remove("hidden");
});

// Ocultar el dropdown al salir del botón o del menú
dropdownBtn.addEventListener("mouseleave", function() {
    timeout = setTimeout(() => {
    dropdownMenu.classList.add("hidden");
    }, 300); // Pequeño retraso para evitar cierres bruscos
});

dropdownMenu.addEventListener("mouseenter", function() {
    clearTimeout(timeout); // Evitar que se cierre si el mouse entra en el dropdown
});

dropdownMenu.addEventListener("mouseleave", function() {
    dropdownMenu.classList.add("hidden");
});

