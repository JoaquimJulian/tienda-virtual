@extends('layouts.app')

@section('title', 'CRUD Admin')

@section('content')
<div class="grid md:grid-cols-3 gap-4 pb-8 mb-16 bg-white mt-8 mx-6 rounded-2xl">
    <!-- Gráfico de Ventas Mensuales (Barras Verticales) -->
    <div class="mt-8">
        <p class="text-2xl text-center text-marron font-bold italic mb-4">VENDES PER TEMPS</p>
        <canvas id="graficVendes" width="350" height="350" class="mx-auto"></canvas>
        <div id="legendVendes" class="mt-4 text-center"></div>
    </div>

    <!-- Gráfico de Productos Más Vendidos (Circular) -->
    <div class="mt-8">
        <p class="text-2xl text-center text-marron font-bold italic mb-4">PRODUCTES MÉS VENUTS</p>
        <canvas id="graficProductes" width="350" height="350" class="mx-auto"></canvas>
        <div id="legendProductes" class="mt-4 text-center"></div>
    </div>

    <!-- Gráfico de Stock Bajo (Barras Horizontales) -->
    <div class="mt-8">
        <p class="text-2xl text-center text-marron font-bold italic mb-4">STOCK</p>
        <canvas id="graficStock" width="350" height="350" class="mx-auto mt-6"></canvas>
        <div id="legendStock" class="ml-6 mt-4 text-center"></div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ventas = @json($ventas);
        const productosMasVendidos = @json($productosMasVendidos);
        const productosConBajoStock = @json($productosConBajoStock);

        const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];

        function getRandomColor() {
            return `hsl(${Math.random() * 360}, 100%, 70%)`;
        }

        function drawBarChart(canvasId, labels, data, legendId) {
            const canvas = document.getElementById(canvasId);
            const ctx = canvas.getContext("2d");
            
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            const max = Math.max(...data);
            const scale = canvas.height / max;
            const barWidth = canvas.width / data.length - 10;
            const colors = labels.map(() => getRandomColor());
            
            data.forEach((value, index) => {
                const x = index * (barWidth + 10) + 10;
                const y = canvas.height - value * scale;
                const height = value * scale;
                ctx.fillStyle = colors[index];
                ctx.fillRect(x, y, barWidth, height);
            });
            
            const legend = document.getElementById(legendId);
            legend.innerHTML = labels.map((label, index) => `<span style="color:${colors[index]}; font-weight:bold;">■</span> ${label}`).join(" | ");
        }

        function drawPieChart(canvasId, labels, data, legendId) {
            const canvas = document.getElementById(canvasId);
            const ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            
            const total = data.reduce((acc, val) => acc + val, 0);
            let startAngle = 0;
            const colors = labels.map(() => getRandomColor());
            
            data.forEach((value, index) => {
                const sliceAngle = (value / total) * 2 * Math.PI;
                ctx.fillStyle = colors[index];
                ctx.beginPath();
                ctx.moveTo(canvas.width / 2, canvas.height / 2);
                ctx.arc(canvas.width / 2, canvas.height / 2, canvas.width / 2, startAngle, startAngle + sliceAngle);
                ctx.closePath();
                ctx.fill();
                startAngle += sliceAngle;
            });
            
            const legend = document.getElementById(legendId);
            legend.innerHTML = labels.map((label, index) => `<span style="color:${colors[index]}; font-weight:bold;">■</span> ${label}`).join(" | ");
        }

        function drawHorizontalBarChart(canvasId, labels, data, legendId) {
            const canvas = document.getElementById(canvasId);
            const ctx = canvas.getContext("2d");
            ctx.clearRect(0, 0, canvas.width, canvas.height);

            const max = Math.max(...data);
            const scale = canvas.width / max;
            const barHeight = canvas.height / data.length - 10;
            const colors = labels.map(() => getRandomColor());

            const legend = document.getElementById(legendId);
            legend.innerHTML = labels
                .map((label, index) => `<p style="text-align: left; margin-left: 10px;"><span style="color:${colors[index]}; font-weight:bold;">■</span> ${label}</p>`)
                .join("");

            data.forEach((value, index) => {
                const x = 0;
                const y = index * (barHeight + 10) + 10;
                const width = value * scale;
                ctx.fillStyle = colors[index];
                ctx.fillRect(x, y, width, barHeight);
            });
        }



        drawBarChart("graficVendes", ventas.map(v => meses[v.mes - 1]), ventas.map(v => v.total), "legendVendes");
        drawPieChart("graficProductes", productosMasVendidos.map(p => p.nombre), productosMasVendidos.map(p => p.cantidad_vendida), "legendProductes");
        drawHorizontalBarChart("graficStock", productosConBajoStock.map(p => p.nombre), productosConBajoStock.map(p => p.stock), "legendStock");
    });
</script>
@endsection
