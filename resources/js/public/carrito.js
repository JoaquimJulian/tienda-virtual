let carritoLocal = [];
let carritoDb = []

for (let i = 0; i < localStorage.length; i++) {
    let key = localStorage.key(i); // Obtener la clave actual

    if (key.startsWith('producto_')) {
        let producto = JSON.parse(localStorage.getItem(key)); // Obtener y parsear el valor
        carritoLocal.push(producto); // Rellenar el array con los datos de localStorage
    }
}

if (userType == 'comprador') { // SI ESTAS LOGUEADO
    console.log('carrito local: ')
    console.log(carritoLocal)

    if (localStorage.getItem('carrito_fusionado') === null) {
        localStorage.setItem('carrito_fusionado', 'true')
    }
    if (localStorage.getItem('carrito_fusionado') === 'true') {
        let carritoFinal = []
        let carritoFusionado = {};
        console.log(localStorage)
        fetch(`/carrito/productos?comprador_id=${userId}`)
        .then(response => response.json())
        .then(data => {
            data.forEach(productoDb => {
                carritoDb.push(productoDb) // rellenar array con los datos de la bd

                // Agregar productos de carritoDb
                carritoDb.forEach(producto => {
                    let codigo = producto.codigo;
                    if (!carritoFusionado[codigo]) {
                        carritoFusionado[codigo] = { ...producto };
                    } else {
                        carritoFusionado[codigo].cantidad += producto.cantidad;
                    }
                });

            })
            
        }) 
        .catch(error => console.error('Error obteniendo productos del carrito:', error));

        carritoLocal.forEach(producto => {
            let codigo = producto.codigo; // Asumimos que el código es el identificador único
            if (!carritoFusionado[codigo]) {
                carritoFusionado[codigo] = { ...producto }; // Clonar el producto
            } else {
                carritoFusionado[codigo].cantidad += producto.cantidad; // Sumar cantidad
            }
        });

        // Convertir el objeto a array
        carritoFinal = Object.values(carritoFusionado);

        console.log('Carrito fusionado:', carritoFinal);

        // Añadir a la bd la fusion de local storage y lo añadido a la bd hasta ahora.
        carritoFinal.forEach(producto => {
            console.log('entra')
        
            // Hacer una solicitud para comprobar si el producto ya existe en la base de datos
            fetch(`/carrito/existe?comprador_id=${userId}&producto_codigo=${producto.codigo}`)
            .then(response => response.json())
            .then(data => {
                if (data.existe) {
                    // Si el producto ya existe, actualizar la cantidad
                    fetch(`/carrito/actualizar`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({
                            comprador_id: userId,
                            producto_codigo: producto.codigo,
                            cantidad: producto.cantidad // Incrementar la cantidad en la base de datos
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Cantidad actualizada:', data);
                    })
                    .catch(error => {
                        console.error('Error actualizando cantidad:', error);
                    });
                } else {
                    // Si el producto no existe, crear un nuevo registro
                    fetch('/carrito', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Obtener el token CSRF
                        },
                        body: JSON.stringify({
                            comprador_id: userId, // ID del comprador
                            producto_codigo: producto.codigo, // Código del producto
                            cantidad: producto.cantidad // Cantidad del producto
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Producto añadido al carrito:', data);
                    })
                    .catch(error => {
                        console.error('Error añadiendo producto al carrito:', error);
                    });
                }
            })
            .catch(error => {
                console.error('Error comprobando producto en la base de datos:', error);
            });
        });

        
        localStorage.setItem('carrito_fusionado', 'false')
        Object.keys(localStorage).forEach(clave => {
            if (clave.startsWith('producto_')) {
                localStorage.removeItem(clave);
            }
        });
    }

    const divProductos = document.getElementById('productos');
    const divResumen = document.getElementById('resumen');
    let productosCarrito = [];
    
    // Fetch cart products from database
    fetch(`/carrito/productos?comprador_id=${userId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => response.json())
    .then(data => {
        productosCarrito = data;
        console.log(productosCarrito)
        renderizarCarrito();
        calcularResumen();
    })
    .catch(error => {
        console.error('Error cargando carrito:', error);
    });
    
    // Function to render cart items
    function renderizarCarrito() {
        divProductos.innerHTML = '';
        
        productosCarrito.forEach(producto => {
            const productoElement = document.createElement('div');
            productoElement.className = 'flex bg-white p-3 rounded-md shadow-sm relative p-2 gap-2';
            productoElement.innerHTML = `
                <div class="flex-shrink-0 w-1/3 h-auto">
                    <img src="/storage/${producto.imagen_principal}" alt="${producto.nombre}" class="h-auto object-cover rounded-md w-full">
                </div>
                <div class="flex flex-col flex-grow">
                    <div class="flex justify-between items-start">
                        <h3 class="font-medium text-sm">${producto.nombre}</h3>
                        <button class="remove-item text-gray-400" data-id="${producto.id}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500">${producto.descripcion}</p>
                    <div>
                        <p class="text-xs text-gray-500 mt-4">Cantidad: </p>
                        <div class="flex w-fit items-center">
                            <button class="decrement-btn px-2 py-1 text-gray-600 hover:bg-gray-100" data-id="${producto.codigo}">-</button>
                            <span class="quantity-display px-3 cantidad" id="${producto.codigo}">${producto.cantidad}</span>
                            <button class="increment-btn px-2 py-1 text-gray-600 hover:bg-gray-100" data-id="${producto.codigo}">+</button>
                        </div>
                    </div>
                    <div class="flex">
                        <p class="text-sm font-medium mt-4">Total: </p>
                        <p class="text-sm font-medium mt-4 text-naranja ml-2"> ${formatCurrency(producto.precio_unidad * producto.cantidad)}</p>
                    </div>
                </div>
            `;
            
            // Add event listener to remove button
            productoElement.querySelector('.remove-item').addEventListener('click', () => {
                eliminarProducto(producto.codigo);
            });

            const incrementBtn = productoElement.querySelector('.increment-btn');
            const decrementBtn = productoElement.querySelector('.decrement-btn');
            
            incrementBtn.addEventListener('click', () => {
                actualizarCantidad(producto.codigo, producto.cantidad + 1);
            });
            
            decrementBtn.addEventListener('click', () => {
                if (producto.cantidad > 1) {
                    actualizarCantidad(producto.codigo, producto.cantidad - 1);
                }
            });
            
            divProductos.appendChild(productoElement);

            
        });


    }

    function actualizarCantidad(productoCodigo, nuevaCantidad) {
        fetch(`/carrito/${userId}/${productoCodigo}`, { // Se pasan comprador_id y producto_codigo en la URL
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                cantidad: nuevaCantidad // Solo enviamos la cantidad porque los otros datos van en la URL
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Buscar el producto en el array del carrito y actualizar la cantidad
                const producto = productosCarrito.find(p => p.codigo === productoCodigo);
                if (producto) {
                    producto.cantidad = nuevaCantidad;
    
                    // Actualizar la UI
                    renderizarCarrito();
                    calcularResumen();
                }
            } else {
                console.error('Error en la actualización:', data.error);
            }
        })
        .catch(error => {
            console.error('Error en la petición:', error);
        });
    }            

    function calcularResumen() {
        let subtotal = 0;
        let iva = 0;
        let envio = 10.95; 
        
        // Calculate subtotal
        productosCarrito.forEach(producto => {
            subtotal += producto.precio_unidad * producto.cantidad;
        });
        
        // Calculate IVA (21%)
        iva = subtotal * 0.21;
        
        // Total with IVA and shipping
        const total = subtotal + iva + envio;
        
        // Create summary HTML
        divResumen.innerHTML = `
            <table class="w-full text-sm">
                <tr class="border-b border-gray-100">
                    <td class="py-1 text-gray-600">PRODUCTOS</td>
                    <td class="py-1 text-right">${getTotalItems()}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-1 text-gray-600">PRECIO</td>
                    <td class="py-1 text-right">${formatCurrency(subtotal)}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-1 text-gray-600">IVA</td>
                    <td class="py-1 text-right">${formatCurrency(iva)}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-1 text-gray-600">ENVÍO</td>
                    <td class="py-1 text-right">${formatCurrency(envio)}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium">TOTAL</td>
                    <td class="py-2 font-medium text-right">${formatCurrency(total)}</td>
                </tr>
            </table>
        `;
    }
    
    // Function to get total items
    function getTotalItems() {
        return productosCarrito.reduce((total, producto) => total + producto.cantidad, 0);
    }
    
    // Function to format currency
    function formatCurrency(amount) {
        return `${amount.toFixed(2)}€`;
    }
    
    // Function to remove product
    function eliminarProducto(productoCodigo) {
        fetch(`/carrito/eliminar`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                comprador_id: userId,
                producto_codigo: productoCodigo
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Remove product from array
                productosCarrito = productosCarrito.filter(p => p.codigo !== productoCodigo);
                
                // Update UI
                renderizarCarrito();
                calcularResumen();
            }
        })
        .catch(error => {
            console.error('Error eliminando producto:', error);
        });

    }


    
} else { // SI NO ESTAS LOGUEADO
    renderizarCarritoLocal()

    function renderizarCarritoLocal() {
        carritoLocal = []
        for (let i = 0; i < localStorage.length; i++) {
            let key = localStorage.key(i); // Obtener la clave actual
        
            if (key.startsWith('producto_')) {
                let producto = JSON.parse(localStorage.getItem(key)); // Obtener y parsear el valor
                carritoLocal.push(producto); // Rellenar el array con los datos de localStorage
            }
        }
    
        let divProductos = document.getElementById('productos');
        let divResumen = document.getElementById('resumen');
        
        divProductos.innerHTML = '';
        
        carritoLocal.forEach(producto => {
            const productoElement = document.createElement('div');
            productoElement.className = 'flex bg-white p-3 rounded-md shadow-sm relative p-2 gap-4';
            productoElement.innerHTML = `
                <div class="flex-shrink-0 w-1/3 h-auto mr-3">
                    <img src="/storage/${producto.imagen_principal}" alt="${producto.nombre}" class="h-auto object-cover rounded-md w-full">
                </div>
                <div class="flex flex-col flex-grow">
                    <div class="flex justify-between items-start">
                        <h3 class="font-medium text-sm">${producto.nombre}</h3>
                        <button class="remove-item text-gray-400" data-id="${producto.codigo}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-xs text-gray-500">${producto.descripcion}</p>
                    <div>
                        <p class="text-xs text-gray-500 mt-4">Cantidad: </p>
                        <div class="flex w-fit items-center">
                            <button class="decrement-btn px-2 py-1 text-gray-600 hover:bg-gray-100" data-id="${producto.codigo}">-</button>
                            <span class="quantity-display px-3 cantidad" id="${producto.codigo}">${producto.cantidad}</span>
                            <button class="increment-btn px-2 py-1 text-gray-600 hover:bg-gray-100" data-id="${producto.codigo}">+</button>
                        </div>
                    </div>
                    <div class="flex">
                        <p class="text-sm font-medium mt-4">Total: </p>
                        <p class="text-sm font-medium mt-4 text-naranja ml-2"> ${formatCurrency(producto.precio_unidad * producto.cantidad)}</p>
                    </div>
                </div>
            `;
            
            // Add event listener to remove button
            productoElement.querySelector('.remove-item').addEventListener('click', () => {
                eliminarProductoLocal(producto.codigo);
            });
            
            // Add quantity control event listeners
            const incrementBtn = productoElement.querySelector('.increment-btn');
            const decrementBtn = productoElement.querySelector('.decrement-btn');
            
            incrementBtn.addEventListener('click', () => {
                actualizarCantidadLocal(producto.codigo, producto.cantidad + 1);
            });
            
            decrementBtn.addEventListener('click', () => {
                if (producto.cantidad > 1) {
                    actualizarCantidadLocal(producto.codigo, producto.cantidad - 1);
                }
            });
           
            divProductos.appendChild(productoElement);
        });
        
        // Calculate and display summary
        calcularResumenLocal();
    }

    function actualizarCantidadLocal(productoCodigo, nuevaCantidad) {
        // Find the product in the local cart
        const producto = carritoLocal.find(p => p.codigo === productoCodigo);
        
        if (producto) {
            // Actualizar la cantidad
            producto.cantidad = nuevaCantidad;
            
            // Guardar el producto actualizado en localStorage
            localStorage.setItem(`producto_${productoCodigo}`, JSON.stringify(producto));

            // Refrescar la interfaz
            renderizarCarritoLocal();
            calcularResumenLocal();
        } else {
            console.error("Producto no encontrado en el carrito local.");
        }
    }
    
    // Function to remove product locally
    function eliminarProductoLocal(productoCodigo) {
        console.log(carritoLocal)
        // Find the product in the local cart
        const producto = carritoLocal.find(p => p.codigo === productoCodigo);
        
        if (producto) {
            localStorage.removeItem(`producto_${productoCodigo}`, JSON.stringify(producto));

            // Refrescar la interfaz
            renderizarCarritoLocal();
            calcularResumenLocal();
        } else {
            console.error("Producto no encontrado en el carrito local.");
        }
    }
    
    // Function to calculate summary for local cart
    function calcularResumenLocal() {
        let divResumen = document.getElementById('resumen');
        let subtotal = 0;
        let iva = 0;
        let envio = 10.95;
        
        // Calculate subtotal
        carritoLocal.forEach(producto => {
            subtotal += producto.precio_unidad * producto.cantidad;
        });
        
        // Calculate IVA (21%)
        iva = subtotal * 0.21;
        
        // Total with IVA and shipping
        const total = subtotal + iva + envio;
        
        // Create summary HTML
        divResumen.innerHTML = `
            <table class="w-full text-sm">
                <tr class="border-b border-gray-100">
                    <td class="py-1 text-gray-600">PRODUCTOS</td>
                    <td class="py-1 text-right">${getTotalItemsLocal()}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-1 text-gray-600">PRECIO</td>
                    <td class="py-1 text-right">${formatCurrency(subtotal)}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-1 text-gray-600">IVA</td>
                    <td class="py-1 text-right">${formatCurrency(iva)}</td>
                </tr>
                <tr class="border-b border-gray-100">
                    <td class="py-1 text-gray-600">ENVÍO</td>
                    <td class="py-1 text-right">${formatCurrency(envio)}</td>
                </tr>
                <tr>
                    <td class="py-2 font-medium">TOTAL</td>
                    <td class="py-2 font-medium text-right">${formatCurrency(total)}</td>
                </tr>
            </table>
        `;
    }
    
    function getTotalItemsLocal() {
        return carritoLocal.reduce((total, producto) => total + producto.cantidad, 0);
    }
    
    function formatCurrency(amount) {
        return `${amount.toFixed(2)}€`;
    }
}