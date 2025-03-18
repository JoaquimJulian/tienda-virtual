let divProductos = document.getElementById('productos');

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

    
} else { // SI NO ESTAS LOGUEADO
    carritoLocal.forEach(producto => {
        let productoDiv = document.createElement("div"); // Crear un div contenedor
        let nombreP = document.createElement("p");
        let precioP = document.createElement("p");
        let cantidadP = document.createElement("p");
        
        producto.precio_unidad * producto.cantidad

        // Asignar contenido a los elementos
        nombreP.textContent = `Nombre: ${producto.nombre}`;
        precioP.textContent = `Precio: $${producto.precio_unidad}`;
        cantidadP.textContent = `Cantidad: ${producto.cantidad}`;

        // Agregar elementos al div
        productoDiv.appendChild(nombreP);
        productoDiv.appendChild(precioP);
        productoDiv.appendChild(cantidadP);

        // Agregar el div al contenedor principal
        divProductos.appendChild(productoDiv);
    });
    console.log(localStorage)
}
