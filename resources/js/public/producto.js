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
