const precioUnidad = parseFloat(document.getElementById('precioUnidad').getAttribute('data-precio'));
const cantidadInput = document.getElementById('cantidad');
let cantidad = parseInt(cantidadInput.value);

document.getElementById('btnRestarCantidad').addEventListener('click', function() {
    if (cantidad > 1) {
        cantidad--;
        cantidadInput.value = cantidad;
        actualizarTotal(cantidad); 
    }
});

document.getElementById('btnAumentarCantidad').addEventListener('click', function() {
    cantidad++;
    cantidadInput.value = cantidad;
    actualizarTotal(cantidad); 
});

function actualizarTotal(cantidad) {
    const total = precioUnidad * cantidad;
    document.getElementById('total').textContent = total.toFixed(2) + '$';
}

// CARRITO
let btnAnadirProducto = document.getElementById('btnAnadirProducto')
let productoString = btnAnadirProducto.value;
let producto = JSON.parse(productoString);

btnAnadirProducto.addEventListener('click', function() {
    if (userType == 'comprador'){ //Si estas logueado

        let productoObjeto = {
            comprador_id: userId,       
            producto_codigo: producto.codigo,   
            cantidad: cantidad          
        };

        fetch(`/carrito/checkProducto?comprador_id=${userId}&producto_codigo=${producto.codigo}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data && data.length > 0) {
                // Si el producto existe, se actualizará la cantidad
                let carritoId = data[0].id;  // Suponiendo que el carrito tiene un ID único

                // Actualizamos la cantidad del producto
                fetch(`/carrito/actualizar`, {
                    method: 'POST', 
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        cantidad: cantidad, 
                        comprador_id : userId,
                        producto_codigo: producto.codigo
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('msjAnadido').classList.remove('hidden');
                    setTimeout(function() {
                        document.getElementById('msjAnadido').classList.add('hidden');
                    }, 2000);
                })
                .catch(error => console.error('Error actualizando el carrito:', error));
            } else {
                // Si el producto no existe, lo agregamos al carrito
                fetch("/carrito", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(productoObjeto)  // Agregar el nuevo producto
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('msjAnadido').classList.remove('hidden');
                    setTimeout(function() {
                        document.getElementById('msjAnadido').classList.add('hidden');
                    }, 2000);
                })
                .catch(error => console.error('Error añadiendo al carrito:', error));
            }
        })
        .catch(error => console.error('Error consultando el carrito:', error));

    } else { //Si no estas logueado
        let key = 'producto_' + producto.codigo;
        let productoGuardado = localStorage.getItem(key);

        if (productoGuardado) {
            // Si el producto ya existe, parseamos el JSON y sumamos la cantidad
            let productoExistente = JSON.parse(productoGuardado);
            productoExistente.cantidad += cantidad; // Sumamos la nueva cantidad a la existente

            // Guardamos el producto actualizado
            localStorage.setItem(key, JSON.stringify(productoExistente));
            document.getElementById('msjAnadido').classList.remove('hidden');
            setTimeout(function() {
                document.getElementById('msjAnadido').classList.add('hidden');
            }, 2000);
        } else {
            // Si el producto no existe, lo guardamos con la nueva cantidad
            let productoConCantidad = { ...producto, cantidad: cantidad };
            localStorage.setItem(key, JSON.stringify(productoConCantidad));
            document.getElementById('msjAnadido').classList.remove('hidden');
            setTimeout(function() {
                document.getElementById('msjAnadido').classList.add('hidden');
            }, 2000);
        }
        Object.keys(localStorage).forEach(clave => {
            if (clave.startsWith('carrito_fusionado')) {
                localStorage.removeItem(clave);
            }
        });
    }
})