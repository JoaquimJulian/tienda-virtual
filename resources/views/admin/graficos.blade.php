@extends('layouts.app')

@section('title', 'CRUD Admin')

@section('content')

<div class="grid md:grid-cols-3">
    <!-- Gráfico de Ventas -->
    <div class="mt-8">
    <canvas id="graficVendes" width="350" height="350" class="mx-auto"></canvas>
    <p class="text-2xl text-center text-marron font-bold italic mt-2">VENDES PER TEMPS</p>
    <select id="mesSelector" class="block mx-auto mt-4 p-2">
        <option value="1">Enero</option>
        <option value="2">Febrero</option>
        <option value="3">Marzo</option>
    </select>
</div>


    <!-- Gráfico de Productos Más Vendidos -->
    <div class="mt-8">
        <p class="text-2xl text-center text-marron font-bold italic">PRODUCTES MÉS VENUTS</p>
        <canvas id="graficProductes" width="350" height="350" class="mx-auto"></canvas>
    </div>    

    <!-- Gráfico de Stock Bajo -->
    <div class="mt-8">
        <p class="text-2xl text-center text-marron font-bold italic">STOCK</p>
        <canvas id="graficStock" width="350" height="350" class="mx-auto"></canvas>
    </div>
</div>



<script>
    document.addEventListener("DOMContentLoaded", function () {
        const productosMasVendidos = @json($productosMasVendidos);
        const productosConBajoStock = @json($productosConBajoStock);
        const ventas = @json($ventas);

        // Inicializamos el gráfico con todos los datos
        const ctxVendes = document.getElementById("graficVendes").getContext("2d");

        const chartVendes = new Chart(ctxVendes, {
            type: "bar",
            data: {
                labels: ventas.map(v => `Mes ${v.mes}`),
                datasets: [{
                    label: "Ventas (€)",
                    data: ventas.map(v => v.total),
                    backgroundColor: "rgba(75, 192, 192, 0.6)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1
                }]
            },
            options: { responsive: true }
        });

        // Función para actualizar el gráfico según el mes seleccionado
        const mesSelector = document.getElementById("mesSelector");
        mesSelector.addEventListener("change", function (e) {
            const mesSeleccionado = parseInt(e.target.value);

            // Filtramos los datos para solo mostrar el mes seleccionado
            const datosMes = ventas.filter(v => v.mes === mesSeleccionado);
            
            // Actualizamos los datos del gráfico
            chartVendes.data.labels = datosMes.map(v => `Mes ${v.mes}`);
            chartVendes.data.datasets[0].data = datosMes.map(v => v.total);
            chartVendes.update();  // Actualiza el gráfico
        });

        // Gráfico de Productos Más Vendidos
        const ctxProductes = document.getElementById("graficProductes").getContext("2d");
        new Chart(ctxProductes, {
            type: "pie",
            data: {
                labels: productosMasVendidos.map(p => p.nombre),
                datasets: [{
                    label: "Cantidad Vendida",
                    data: productosMasVendidos.map(p => p.cantidad_vendida),
                    backgroundColor: [
                        "#FF6384", "#36A2EB", "#FFCE56", "#4CAF50", "#FF9800",
                        "#9C27B0", "#3F51B5", "#E91E63", "#009688", "#795548"
                    ]
                }]
            },
            options: { responsive: true }
        });

        // Gráfico de Productos con Bajo Stock
        const ctxStock = document.getElementById("graficStock").getContext("2d");
        new Chart(ctxStock, {
    type: "bar",
    data: {
        labels: productosConBajoStock.map(p => p.nombre),
        datasets: [{
            label: "Stock Disponible",
            data: productosConBajoStock.map(p => p.stock),
            backgroundColor: "rgba(255, 99, 132, 0.6)",
            borderColor: "rgba(255, 99, 132, 1)",
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        indexAxis: 'y' 
    }
});

    });

    
</script>

@endsection

@vite(['resources/js/services/admin/graficos.js'])
