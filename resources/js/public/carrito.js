let divProductos = document.getElementById('productos');

// Almacenaremos los productos de la BD y del localStorage
let productosBD = [];
let productosLocalStorage = [];

// Si el usuario es comprador
if (userType === 'comprador') {
    for (let i = 0; i < localStorage.length; i++) {
        let clave = localStorage.key(i); 
        let producto = JSON.parse(localStorage.getItem(clave)); 
        
        if (clave.startsWith('producto_')) {
            productosLocalStorage.push({
                codigo: producto.codigo,
                nombre: producto.nombre,
                cantidad: producto.cantidad
            });
        }
    }

    fetch('/carrito', {
        method: 'GET',
        headers: {
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        // Almacenamos los productos de la base de datos
        productosBD = data.map(carrito => ({
            codigo: carrito.producto.codigo,
            nombre: carrito.producto.nombre,
            cantidad: carrito.cantidad
        }));

        // Llamamos a la función para combinar con los productos del localStorage
        combinarProductos();
    })
    .catch(error => {
        console.error('Error al obtener los productos del carrito:', error);
    });
} else {
    // Si no es comprador, solo mostramos lo del localStorage
    for (let i = 0; i < localStorage.length; i++) {
        console.log(localStorage)
        let clave = localStorage.key(i); 
        let producto = JSON.parse(localStorage.getItem(clave)); 
        
        if (clave.startsWith('producto_')) {
            productosLocalStorage.push({
                codigo: producto.codigo,
                nombre: producto.nombre,
                cantidad: producto.cantidad
            });
        }

        // Mostrar los productos solo del localStorage
        productosLocalStorage.forEach(producto => {
            divProductos.innerHTML += `
                <div class="producto">
                    <p><strong>Código:</strong> ${producto.codigo}</p>
                    <p><strong>Nombre:</strong> ${producto.nombre}</p>
                    <p><strong>Cantidad:</strong> ${producto.cantidad}</p>
                </div>
            `;
        });
    }
}

function combinarProductos() {
    // Combinamos los productos de la base de datos y del localStorage
    let productosCombinados = [...productosBD];

    // Recorremos los productos del localStorage
    productosLocalStorage.forEach(productoLS => {
        // Buscamos si el producto ya existe en productosCombinados (BD)
        let productoExistente = productosCombinados.find(productoBD => productoBD.codigo === productoLS.codigo);

        if (productoExistente) {
            // Si existe, sumamos las cantidades
            productoExistente.cantidad += productoLS.cantidad;
        } else {
            // Si no existe, lo añadimos al array
            productosCombinados.push(productoLS);
        }
    });

    // Ahora mostramos los productos combinados
    productosCombinados.forEach(producto => {
        divProductos.innerHTML += `
            <div class="producto">
                <p><strong>Código:</strong> ${producto.codigo}</p>
                <p><strong>Nombre:</strong> ${producto.nombre}</p>
                <p><strong>Cantidad:</strong> ${producto.cantidad}</p>
            </div>
        `;
    });
}
