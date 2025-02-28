const tablaPedidos = document.getElementById('tablaPedidos')

mostrarPedidos()

function mostrarPedidos() {
    fetch("/compra", {
        method: "GET",
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })
    .then(response => response.json())
    .then(data => {
        data.forEach(compra => {
            tablaPedidos.innerHTML += `
                <tr id="pedido_${compra.id}" class="bg-white overflow-hidden rounded-xl cursor-pointer
                transition-all duration-200 hover:shadow-lg hover:bg-gray-50">
                    <td class="px-4 py-4 text-marron h-auto text-center rounded-l-xl overflow-hidden">
                        ${compra.fecha_compra}
                    </td>
                    <td class="px-4 py-4 text-marron h-auto text-center">
                        ${compra.comprador.nombre}
                    </td>
                    <td class="px-4 py-4 text-marron h-auto text-center rounded-r-xl overflow-hidden">
                        ${compra.estado}
                    </td>
                </tr>
            `;

            tablaPedidos.addEventListener('click', function() {
                console.log('entra')
                window.location.href = `/compra/${compra.id}/edit`
            })
        });

    })
    .catch(error => console.error('Error:', error));
}