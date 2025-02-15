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
                    <span class="text-marron">${categoria.nombre}</span>
                `;
                categoriaElement.innerHTML += `
                    <div class="flex gap-4">
                        <img src="/images/lapiz.png" class="hover:cursor-pointer" id="editar_${categoria.id}"> 
                        <img src="/images/papelera.png" class="hover:cursor-pointer" id="eliminarC_${categoria.id}">
                    </div>
                `                    
                listaCategorias.appendChild(categoriaElement);

                const botonEliminar = document.getElementById(`eliminarC_${categoria.id}`);
                    botonEliminar.addEventListener('click', () => {
                    eliminarCategoria(categoria.id)
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
                        <span class="text-marron">${nombreNuevaCategoria}</span>
                    `;
                    categoriaElement.innerHTML += `
                        <div class="flex gap-4">
                            <img src="/images/lapiz.png" class="hover:cursor-pointer" id="editar_${categoria.id}"> 
                            <img src="/images/papelera.png" class="hover:cursor-pointer" id="eliminarC_${categoria.id}">
                        </div>
                    `
                    listaCategorias.appendChild(categoriaElement);

                    const botonEliminar = document.getElementById(`eliminarC_${categoria.id}`);
                        botonEliminar.addEventListener('click', () => {
                        eliminarCategoria(categoria.id)
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
            console.log(data.message); 
          
            document.getElementById(`categoria_${id}`).remove();
        } else {
            console.error(data.message); 
        }
    })
    .catch(error => console.error('Error:', error));
}

