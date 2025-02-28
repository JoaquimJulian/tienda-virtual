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
                <tr class="bg-white rounded-xl overflow-hidden" id="pedido_${compra.id}">
                    <td class="px-4 py-4 text-marron h-auto text-center">
                        ${compra.fecha_compra}
                    </td>
                    <td class="px-4 py-4 text-marron h-auto text-center">
                        ${compra.comprador.id}
                    </td>
                    <td class="px-4 py-4 text-marron h-auto text-center">
                        ${compra.estado}
                    </td>
                </tr>
            `;
        });
    })
    .catch(error => console.error('Error:', error));
}