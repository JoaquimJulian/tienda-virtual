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
                    <input id="${categoria.id}" class="text-marron border-none focus:outline-none focus:ring-0 w-full" value="${categoria.nombre}">
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
                if (categoria.nombre = nombreNuevaCategoria && contador === 1) {
                    const categoriaElement = document.createElement('div');
                    categoriaElement.setAttribute('id', `categoria_${categoria.id}`);
                    categoriaElement.className = 'w-full flex items-center justify-between bg-white p-4 rounded-lg shadow-md mb-4';
                    categoriaElement.innerHTML = `
                        <input id="inputCategoria" class="text-marron border-none focus:outline-none focus:ring-0 w-full" value="${nombreNuevaCategoria}">
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
           
        } else {
            console.error(data.message); 
        }
    })
    .catch(error => console.error('Error:', error));
}


function editarCategoria(id){
    let inputCategoria = document.getElementById(id)
    
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
        } else {
            console.error("Error al actualizar:", data.error);
        }
    })
    .catch(error => console.error("Error:", error));
    
}

// LOGICA PRODUCTOS

const tablaProductos = document.getElementById('tablaProductos')

mostrarProductos()

function mostrarProductos(){
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
            tablaProductos.innerHTML += `
                <tr class="bg-white rounded-xl overflow-hidden">
                    <td class="px-4 py-4 h-auto rounded-l-xl">
                        <img src="${producto.imagen}" alt="${producto.nombre}" class="w-16 h-16 object-cover rounded-lg">
                    </td>
                    <td class="px-4 py-4 text-marron h-auto text-center">
                        ${producto.nombre}
                    </td>
                    <td class="px-4 py-4 text-marron h-auto text-center">
                        ${producto.categoria.nombre}
                    </td>
                    <td class="px-4 py-4 text-marron h-auto text-center">
                        ${producto.precio_unidad}$
                    </td>
                    <td class="px-4 py-4 h-auto rounded-r-xl">
                        <div class="flex items-center justify-center gap-4 roundex-xl">
                            <button class="bg-marron text-white px-4 py-2 rounded-lg">Ver</button>
                            <img src="/images/papelera.png">
                        </div>
                    </td>
                </tr>
            `;
        })
    })
    .catch(error => console.error('Error:', error));
}