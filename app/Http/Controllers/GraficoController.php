<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Producto;

class GraficoController extends Controller
{
    public function mostrarGraficos()
    {
        // 🟠 Gráfico de ventas por período de tiempo (Ventas mensuales)
        $ventas = Compra::selectRaw('MONTH(fecha_compra) as mes, SUM(precio_total) as total')
            ->groupBy('mes')
            ->orderBy('mes', 'asc')
            ->get();

        // 🟢 Gráfico de productos más vendidos (Top 10)
        $productosMasVendidos = Producto::selectRaw('productos.codigo, productos.nombre, COUNT(productos_compras.producto_codigo) as cantidad_vendida')
            ->join('productos_compras', 'productos.codigo', '=', 'productos_compras.producto_codigo')
            ->groupBy('productos.codigo', 'productos.nombre')
            ->orderBy('cantidad_vendida', 'desc')
            ->limit(10)
            ->get();

        // 🔴 Gráfico de stock bajo (Productos con menor stock)
        $productosConBajoStock = Producto::where('stock', '<', 10)
            ->orderBy('stock', 'asc')
            ->get();

        return view('admin.graficos', compact('ventas', 'productosMasVendidos', 'productosConBajoStock'));
    }
}
