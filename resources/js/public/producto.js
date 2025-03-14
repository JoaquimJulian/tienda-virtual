const precioUnidad = parseFloat(document.getElementById('precioUnidad').getAttribute('data-precio'));

document.getElementById('btnRestarCantidad').addEventListener('click', function() {
    const cantidadInput = document.getElementById('cantidad');
    let cantidad = parseInt(cantidadInput.value);
    if (cantidad > 1) {
        cantidad--;
        cantidadInput.value = cantidad;
        actualizarTotal(cantidad); 
    }
});

document.getElementById('btnAumentarCantidad').addEventListener('click', function() {
    const cantidadInput = document.getElementById('cantidad');
    let cantidad = parseInt(cantidadInput.value);
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
let producto = JSON.parse(document.getElementById('btnAnadirProducto').value)

btnAnadirProducto.addEventListener('click', function() {
    if (userType === 'comprador') {
        anadirBbdd()
        console.log('entra')
    } else {
        anadirLocalStorage()
    }
})

function anadirLocalStorage() {
    let cantidad = parseInt(document.getElementById('cantidad').value, 10);

    let storedProducto = localStorage.getItem('producto_' + producto.codigo);
    
    if (storedProducto) {
        storedProducto = JSON.parse(storedProducto); // Convertir a objeto
        storedProducto.cantidad += cantidad; // Sumar la cantidad que se está añadiendo
    } else {
        // Si no existe, creamos el producto con la cantidad inicial
        storedProducto = { ...producto, cantidad: cantidad };
    }

    for (let i = 0; i < cantidad; i++) {
        localStorage.setItem('producto_' + producto.codigo, JSON.stringify(storedProducto));
    }
}

function anadirBbdd() {
    let cantidad = parseInt(document.getElementById('cantidad').value, 10);
    const data = {
        comprador_id: userId,  // Asumimos que 'userId' contiene el id del comprador desde la sesión
        producto_codigo: producto.codigo,  // El código del producto
        cantidad: cantidad  // La cantidad seleccionada
    };
    fetch('/carrito', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',   // Definir el tipo de contenido como JSON
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Token CSRF
        },
        body: JSON.stringify(data) // Convertir el objeto a una cadena JSON
    })
    .then(response => response.json())  // Parsear la respuesta como JSON
    .then(data => {
        if (data.message) {
            console.log(data.message);  // Mostrar mensaje de éxito
        } else {
            console.error('Error al añadir el producto al carrito');
        }
    })
    .catch(error => {
        console.error('Error en la solicitud fetch:', error);
    });
}