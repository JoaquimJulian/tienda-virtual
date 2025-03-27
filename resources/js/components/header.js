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

    fetch("/producto", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        signal: controller.signal
    })
    .then(response => response.json())
    .then(data => {
        data.data.forEach(producto => {
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


