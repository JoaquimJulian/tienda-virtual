const tablaPedidos = document.getElementById('tablaPedidos')
let busquedaPedidos = document.getElementById('busquedaPedidos')
let debounceTimer
const filtroEstado = document.getElementById('filtroEstado')
const filtroCliente = document.getElementById('filtroCliente')

let valorFiltroEstado 
let valorFiltroCliente 

filtroEstado.addEventListener('change', function(){
    valorFiltroEstado = filtroEstado.value
    console.log(valorFiltroEstado)
    mostrarPedidos('', valorFiltroEstado, '')
})

filtroCliente.addEventListener('change', function(){
    valorFiltroCliente = filtroCliente.value
    mostrarPedidos('', '', valorFiltroCliente)
})

mostrarPedidos()

busquedaPedidos.addEventListener('input', function() {
    clearTimeout(debounceTimer);

    debounceTimer = setTimeout(() => {
        console.log('entra')
        mostrarPedidos(busquedaPedidos.value);
    }, 300); 
})

function mostrarPedidos(busqueda = '', estado = '', cliente = '') {
    console.log("mostrarPedidos")
    tablaPedidos.innerHTML = ''
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
            // SI LA BARRA DE BUSQUEDA ESTA VACIA
            if(busqueda == '') { 
                // SI NO HAY FILTROS
                if((estado == '' && cliente == '') || (cliente == 'no-cliente' && estado == 'no-estado') || (cliente == 'no-cliente' && estado == '') || (cliente == '' && estado == 'no-estado')) { // SI NO HAY FILTROS 
                    if (!document.getElementById(`pedido_${compra.id}`)) {
                        const fila = document.createElement("tr");
                        fila.id = `pedido_${compra.id}`;
                        fila.className = "bg-white cursor-pointer mb-2 transition-all duration-300 ease-in-out transform hover:scale-105";

                        // Celda de Fecha
                        const celdaFecha = document.createElement("td");
                        celdaFecha.className = "px-4 py-4 text-marron h-auto text-center";
                        celdaFecha.textContent = compra.fecha_compra;
                        fila.appendChild(celdaFecha);

                        // Celda de Comprador
                        const celdaComprador = document.createElement("td");
                        celdaComprador.className = "px-4 py-4 text-marron h-auto text-center";
                        celdaComprador.textContent = compra.comprador.nombre;
                        fila.appendChild(celdaComprador);

                        // Celda de Estado
                        const celdaEstado = document.createElement("td");
                        celdaEstado.className = "px-4 py-4 h-auto text-center";
                        celdaEstado.textContent = compra.estado;

                        // Aplicar color según el estado
                        if (compra.estado === "enviado") {
                            celdaEstado.classList.add("text-green-500");
                        } else if (compra.estado === "pendiente") {
                            celdaEstado.classList.add("text-yellow-400");
                        }

                        // Agregar la celda de estado a la fila
                        fila.appendChild(celdaEstado);

                        // Agregar la fila completa a la tabla
                        tablaPedidos.appendChild(fila);

                        tablaPedidos.addEventListener('click', function() {
                            window.location.href = `/compra/${compra.id}/edit`
                        })
                    }
                // SI LA BARRA DE BUSQUEDA ESTA VACIA Y HAY FILTROS
                }else{
                    if(compra.estado == estado || compra.comprador.id == cliente){
                        if (!document.getElementById(`pedido_${compra.id}`)) {
                            const fila = document.createElement("tr");
                            fila.id = `pedido_${compra.id}`;
                            fila.className = "bg-white cursor-pointer mb-2 transition-all duration-300 ease-in-out transform hover:scale-105";

                            // Celda de Fecha
                            const celdaFecha = document.createElement("td");
                            celdaFecha.className = "px-4 py-4 text-marron h-auto text-center";
                            celdaFecha.textContent = compra.fecha_compra;
                            fila.appendChild(celdaFecha);

                            // Celda de Comprador
                            const celdaComprador = document.createElement("td");
                            celdaComprador.className = "px-4 py-4 text-marron h-auto text-center";
                            celdaComprador.textContent = compra.comprador.nombre;
                            fila.appendChild(celdaComprador);

                            // Celda de Estado
                            const celdaEstado = document.createElement("td");
                            celdaEstado.className = "px-4 py-4 h-auto text-center";
                            celdaEstado.textContent = compra.estado;

                            // Aplicar color según el estado
                            if (compra.estado === "enviado") {
                                celdaEstado.classList.add("text-green-500");
                            } else if (compra.estado === "pendiente") {
                                celdaEstado.classList.add("text-yellow-400");
                            }

                            // Agregar la celda de estado a la fila
                            fila.appendChild(celdaEstado);

                            // Agregar la fila completa a la tabla
                            tablaPedidos.appendChild(fila);

                            tablaPedidos.addEventListener('click', function() {
                                window.location.href = `/compra/${compra.id}/edit`
                            })
                        }
                    } 
                } 
            } else {
                // SI LA BARRA DE BUSQUEDA ESTA LLENA Y NO HAY FILTROS
                if ((estado == '' && cliente == '') || (cliente == 'no-cliente' && estado == 'no-estado')) {
                    if(compra.comprador.nombre.toLowerCase().includes(busqueda) || compra.estado.includes(busqueda)) {
                        if (!document.getElementById(`pedido_${compra.id}`)) {
                            const fila = document.createElement("tr");
                            fila.id = `pedido_${compra.id}`;
                            fila.className = "bg-white overflow-hidden rounded-xl cursor-pointer transition-all duration-200 hover:shadow-lg hover:bg-gray-50";

                            // Celda de Fecha
                            const celdaFecha = document.createElement("td");
                            celdaFecha.className = "px-4 py-4 text-marron h-auto text-center rounded-l-xl overflow-hidden";
                            celdaFecha.textContent = compra.fecha_compra;
                            fila.appendChild(celdaFecha);

                            // Celda de Comprador
                            const celdaComprador = document.createElement("td");
                            celdaComprador.className = "px-4 py-4 text-marron h-auto text-center";
                            celdaComprador.textContent = compra.comprador.nombre;
                            fila.appendChild(celdaComprador);

                            // Celda de Estado
                            const celdaEstado = document.createElement("td");
                            celdaEstado.className = "px-4 py-4 h-auto text-center rounded-r-xl overflow-hidden";
                            celdaEstado.textContent = compra.estado;

                            // Aplicar color según el estado
                            if (compra.estado === "enviado") {
                                celdaEstado.classList.add("text-green-500");
                            } else if (compra.estado === "pendiente") {
                                celdaEstado.classList.add("text-yellow-400");
                            }

                            // Agregar la celda de estado a la fila
                            fila.appendChild(celdaEstado);

                            // Agregar la fila completa a la tabla
                            tablaPedidos.appendChild(fila);

                            tablaPedidos.addEventListener('click', function() {
                                window.location.href = `/compra/${compra.id}/edit`
                            })
                        } 
                    }
                }else {
                    // SI LA BARRA DE BUSQUEDA ESTA LLENA Y HAY FILTROS
                    if(compra.estado == estado || compra.comprador.id == cliente){
                        if (!document.getElementById(`pedido_${compra.id}`)) {
                            const fila = document.createElement("tr");
                            fila.id = `pedido_${compra.id}`;
                            fila.className = "bg-white cursor-pointer mb-2 transition-all duration-300 ease-in-out transform hover:scale-105";

                            // Celda de Fecha
                            const celdaFecha = document.createElement("td");
                            celdaFecha.className = "px-4 py-4 text-marron h-auto text-center";
                            celdaFecha.textContent = compra.fecha_compra;
                            fila.appendChild(celdaFecha);

                            // Celda de Comprador
                            const celdaComprador = document.createElement("td");
                            celdaComprador.className = "px-4 py-4 text-marron h-auto text-center";
                            celdaComprador.textContent = compra.comprador.nombre;
                            fila.appendChild(celdaComprador);

                            // Celda de Estado
                            const celdaEstado = document.createElement("td");
                            celdaEstado.className = "px-4 py-4 h-auto text-center";
                            celdaEstado.textContent = compra.estado;

                            // Aplicar color según el estado
                            if (compra.estado === "enviado") {
                                celdaEstado.classList.add("text-green-500");
                            } else if (compra.estado === "pendiente") {
                                celdaEstado.classList.add("text-yellow-400");
                            }

                            // Agregar la celda de estado a la fila
                            fila.appendChild(celdaEstado);

                            // Agregar la fila completa a la tabla
                            tablaPedidos.appendChild(fila);

                            tablaPedidos.addEventListener('click', function() {
                                window.location.href = `/compra/${compra.id}/edit`
                            })
                        }
                    }
                }
                
            }
        });

    })
    .catch(error => console.error('Error:', error));
}