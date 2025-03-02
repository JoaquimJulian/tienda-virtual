// LOGICA CATEGORIAS

const dropdownMenuCategoria = document.getElementById('dropdownCrearCategoria');
const btnDropdownCategoria = document.getElementById('btnDropdownCategoria')
const btnCrearCategoria = document.getElementById('btnCrearCategoria')
const inputNuevaCategoria = document.getElementById('inputNuevaCategoria')
const listaCategorias = document.getElementById('categoriasLista')
let hayCategorias = false

mostrarCategorias()

btnDropdownCategoria.addEventListener('click', function(event){
    event.stopPropagation();
    dropdownMenuCategoria.classList.toggle('hidden');

    let rect = btnDropdownCategoria.getBoundingClientRect();
    dropdownMenuCategoria.style.top = `${rect.bottom + window.scrollY}px`;
    dropdownMenuCategoria.style.right = `${window.innerWidth - rect.right - 10}px`; 
    
})

document.addEventListener('click', function(event) {
    if (!dropdownMenuCategoria.contains(event.target) && !btnDropdownCategoria.contains(event.target)) {
        dropdownMenuCategoria.classList.add('hidden');
    }
});

btnCrearCategoria.addEventListener('click', function(event) {
    event.stopPropagation();
    let nombreNuevaCategoria = inputNuevaCategoria.value;
    
    fetch("/categoria", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            nombre: nombreNuevaCategoria
        })
    })
    .then(response => response.json())
    .then(data => {
        mostrarCategorias(nombreNuevaCategoria) 
    })
    .catch(error => console.error('Error:', error));

    dropdownMenuCategoria.classList.add('hidden');
});

function mostrarCategorias(nombreNuevaCategoria){
    fetch("/categoria", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.length > 0) {
            hayCategorias = true
        } 
        const listaCategorias = document.getElementById('categoriasLista');
    
        if (!nombreNuevaCategoria) {
            // Si no hay una nueva categoría, mostrar todas las categorías
            listaCategorias.innerHTML = ''; // Limpiar solo cuando se cargan todas las categorías
            data.forEach(categoria => {
                const categoriaElement = document.createElement('div');
                categoriaElement.setAttribute('id', `categoria_${categoria.id}`);
                categoriaElement.className = 'w-full flex items-center justify-between bg-white p-4 rounded-lg shadow-md mb-4';
                categoriaElement.innerHTML = `
                    <input id="${categoria.id}" class="text-marron border-none focus:outline-none focus:ring-0 w-full" value="${categoria.nombre}" readonly>
                `;
                categoriaElement.innerHTML += `
                    <div class="flex gap-4 pr-2">
                        <img src="/images/lapiz.png" class="hover:cursor-pointer" id="editarC_${categoria.id}"> 
                        <img src="/images/papelera.png" class="hover:cursor-pointer" id="eliminarC_${categoria.id}">
                    </div>
                `                    
                listaCategorias.appendChild(categoriaElement);

                const botonEliminar = document.getElementById(`eliminarC_${categoria.id}`);
                    botonEliminar.addEventListener('click', () => {
                    eliminarCategoria(categoria.id)
                });
                const botonEditar = document.getElementById(`editarC_${categoria.id}`);
                botonEditar.addEventListener('click', () => {
                    if (botonEditar.id == `editarC_${categoria.id}`) {
                        console.log("entra")
                        editarCategoria(categoria.id)
                    }
                });
            });
        } else {
            let contador = 1
            data.forEach(categoria => {
                if (categoria.nombre == nombreNuevaCategoria && contador === 1) {
                    const categoriaElement = document.createElement('div');
                    categoriaElement.setAttribute('id', `categoria_${categoria.id}`);
                    categoriaElement.className = 'w-full flex items-center justify-between bg-white p-4 rounded-lg shadow-md mb-4';
                    categoriaElement.innerHTML = `
                        <input id="${categoria.id}" class="text-marron border-none focus:outline-none focus:ring-0 w-full" value="${categoria.nombre}" readonly>
                    `;
                    categoriaElement.innerHTML += `
                        <div class="flex gap-4 pr-2">
                            <img src="/images/lapiz.png" class="hover:cursor-pointer" id="editarC_${categoria.id}"> 
                            <img src="/images/papelera.png" class="hover:cursor-pointer" id="eliminarC_${categoria.id}">
                        </div>
                    `
                    listaCategorias.appendChild(categoriaElement);

                    const botonEliminar = document.getElementById(`eliminarC_${categoria.id}`);
                    botonEliminar.addEventListener('click', () => {
                        eliminarCategoria(categoria.id)
                    });

                    const botonEditar = document.getElementById(`editarC_${categoria.id}`);
                    botonEditar.addEventListener('click', () => {
                        editarCategoria(categoria.id)
                    });
                }
                contador ++;
            })
        }
    })
    .catch(error => console.error('Error:', error));
}

function eliminarCategoria(id) {
    fetch(`/categoria/${id}`, {
        method: 'DELETE', 
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`categoria_${id}`).remove();
        } else {
            console.error(data.message); 
        }
    })
    .catch(error => console.error('Error:', error));
}


function editarCategoria(id){
    let inputCategoria = document.getElementById(id)
    const botonEditar = document.getElementById(`editarC_${id}`);

    if (botonEditar.src.includes("/images/lapiz.png")) {
        inputCategoria.removeAttribute("readonly");
        botonEditar.src = "/images/tick.png"
        botonEditar.classList.add("w-6");
    } else {
        fetch(`/categoria/${id}`, {
            method: "PUT", 
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ nombre: inputCategoria.value })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log("editado")
                botonEditar.src = "/images/lapiz.png"
                inputCategoria.setAttribute("readonly", "true");
            } else {
                console.error("Error al actualizar:", data.error);
            }
        })
        .catch(error => console.error("Error:", error));
    }
    
}

// LOGICA PRODUCTOS

const tablaProductos = document.getElementById('tablaProductos')
let busquedaProductos = document.getElementById('busquedaProductos')
let debounceTimer;

mostrarProductos()

busquedaProductos.addEventListener('input', function() {
    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        mostrarProductos(busquedaProductos.value);
    }, 300); 
});

function mostrarProductos(busqueda = ""){
    tablaProductos.innerHTML = '';
    fetch("/producto", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(producto => {
            if(busqueda == ""){
                if (!document.getElementById(`producto_${producto.codigo}`)) {
                    // Crear la fila del producto
                    const fila = document.createElement("tr");
                    fila.className = "bg-white rounded-xl overflow-hidden";
                    fila.id = `producto_${producto.codigo}`;

                    // Celda de imagen
                    const celdaImagen = document.createElement("td");
                    celdaImagen.className = "px-4 py-4 h-auto rounded-l-xl";
                    const imagen = document.createElement("img");
                    imagen.src = producto.imagen;
                    imagen.alt = producto.nombre;
                    imagen.className = "w-16 h-16 object-cover rounded-lg";
                    celdaImagen.appendChild(imagen);
                    fila.appendChild(celdaImagen);

                    // Celda de nombre del producto
                    const celdaNombre = document.createElement("td");
                    celdaNombre.className = "px-4 py-4 text-marron h-auto text-center";
                    celdaNombre.textContent = producto.nombre;
                    fila.appendChild(celdaNombre);

                    // Celda de categoría
                    const celdaCategoria = document.createElement("td");
                    celdaCategoria.className = "px-4 py-4 text-marron h-auto text-center";
                    celdaCategoria.textContent = producto.categoria.nombre;
                    fila.appendChild(celdaCategoria);

                    // Celda de precio
                    const celdaPrecio = document.createElement("td");
                    celdaPrecio.className = "px-4 py-4 text-marron h-auto text-center";
                    celdaPrecio.textContent = `${producto.precio_unidad}$`;
                    fila.appendChild(celdaPrecio);

                    // Celda de acciones
                    const celdaAcciones = document.createElement("td");
                    celdaAcciones.className = "px-4 py-4 h-auto rounded-r-xl";

                    // Contenedor de botones
                    const contenedorBotones = document.createElement("div");
                    contenedorBotones.className = "flex items-center justify-center gap-4";

                    // Botón "Ver"
                    const botonVer = document.createElement("button");
                    botonVer.id = `editar_${producto.codigo}`;
                    botonVer.className = "bg-marron text-white px-4 py-2 rounded-lg";
                    botonVer.textContent = "Ver";
                    contenedorBotones.appendChild(botonVer);

                    // Imagen "Eliminar"
                    const imagenEliminar = document.createElement("img");
                    imagenEliminar.id = `eliminar_${producto.codigo}`;
                    imagenEliminar.src = "/images/papelera.png";
                    imagenEliminar.className = "hover:cursor-pointer";
                    contenedorBotones.appendChild(imagenEliminar);

                    // Agregar contenedor de botones a la celda
                    celdaAcciones.appendChild(contenedorBotones);
                    fila.appendChild(celdaAcciones);

                    // Agregar la fila a la tabla
                    tablaProductos.appendChild(fila);

                    let btnEditar = document.getElementById(`editar_${producto.codigo}`)
                    btnEditar.onclick = () => editarProducto(producto.codigo)

                    let btnEliminar = document.getElementById(`eliminar_${producto.codigo}`)
                    btnEliminar.onclick = () => eliminarProducto(producto.codigo)
                }
            } else {
                if (producto.nombre.toLowerCase().includes(busqueda) || producto.categoria.nombre.toLowerCase().includes(busqueda)) {
                    if (!document.getElementById(`producto_${producto.codigo}`)) {
                        // Crear la fila del producto
                        const fila = document.createElement("tr");
                        fila.className = "bg-white rounded-xl overflow-hidden";
                        fila.id = `producto_${producto.codigo}`;

                        // Celda de imagen
                        const celdaImagen = document.createElement("td");
                        celdaImagen.className = "px-4 py-4 h-auto rounded-l-xl";
                        const imagen = document.createElement("img");
                        imagen.src = producto.imagen;
                        imagen.alt = producto.nombre;
                        imagen.className = "w-16 h-16 object-cover rounded-lg";
                        celdaImagen.appendChild(imagen);
                        fila.appendChild(celdaImagen);

                        // Celda de nombre del producto
                        const celdaNombre = document.createElement("td");
                        celdaNombre.className = "px-4 py-4 text-marron h-auto text-center";
                        celdaNombre.textContent = producto.nombre;
                        fila.appendChild(celdaNombre);

                        // Celda de categoría
                        const celdaCategoria = document.createElement("td");
                        celdaCategoria.className = "px-4 py-4 text-marron h-auto text-center";
                        celdaCategoria.textContent = producto.categoria.nombre;
                        fila.appendChild(celdaCategoria);

                        // Celda de precio
                        const celdaPrecio = document.createElement("td");
                        celdaPrecio.className = "px-4 py-4 text-marron h-auto text-center";
                        celdaPrecio.textContent = `${producto.precio_unidad}$`;
                        fila.appendChild(celdaPrecio);

                        // Celda de acciones
                        const celdaAcciones = document.createElement("td");
                        celdaAcciones.className = "px-4 py-4 h-auto rounded-r-xl";

                        // Contenedor de botones
                        const contenedorBotones = document.createElement("div");
                        contenedorBotones.className = "flex items-center justify-center gap-4";

                        // Botón "Ver"
                        const botonVer = document.createElement("button");
                        botonVer.id = `editar_${producto.codigo}`;
                        botonVer.className = "bg-marron text-white px-4 py-2 rounded-lg";
                        botonVer.textContent = "Ver";
                        contenedorBotones.appendChild(botonVer);

                        // Imagen "Eliminar"
                        const imagenEliminar = document.createElement("img");
                        imagenEliminar.id = `eliminar_${producto.codigo}`;
                        imagenEliminar.src = "/images/papelera.png";
                        imagenEliminar.className = "hover:cursor-pointer";
                        contenedorBotones.appendChild(imagenEliminar);

                        // Agregar contenedor de botones a la celda
                        celdaAcciones.appendChild(contenedorBotones);
                        fila.appendChild(celdaAcciones);

                        // Agregar la fila a la tabla
                        tablaProductos.appendChild(fila);

                        let btnEditar = document.getElementById(`editar_${producto.codigo}`)
                        btnEditar.onclick = () => editarProducto(producto.codigo)

                        let btnEliminar = document.getElementById(`eliminar_${producto.codigo}`)
                        btnEliminar.onclick = () => eliminarProducto(producto.codigo)
                    }
                }
            }
        })
    })
    .catch(error => console.error('Error:', error));

}

function editarProducto(codigo){
    window.location.href = `/producto/${codigo}/edit`
}

function eliminarProducto(codigo){
    fetch(`/producto/${codigo}`, {
        method: 'DELETE', 
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById(`producto_${codigo}`).remove();
        } else {
            console.error(data.message); 
        }
    })
    .catch(error => console.error('Error:', error));
}

