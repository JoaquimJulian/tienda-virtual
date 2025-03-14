let divProductos = document.getElementById('productos');

for (let i = 0; i < localStorage.length; i++) {
    let clave = localStorage.key(i); // Obtener la clave (producto)

    let producto = JSON.parse(localStorage.getItem(clave)); // Obtener el producto y convertirlo a objeto

    // Verificamos si la clave empieza con 'producto_' para evitar incluir otras claves
    if (clave.startsWith('producto_')) {
        console.log('entra')
        // Crear el HTML para mostrar el producto
        divProductos.innerHTML += `
            <div class="producto">
                <p><strong>Código:</strong> ${producto.codigo}</p>
                <p><strong>Nombre:</strong> ${producto.nombre}</p>
                <p><strong>Cantidad:</strong> ${producto.cantidad}</p>
            </div>
        `;
    }
}