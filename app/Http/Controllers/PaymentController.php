<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\ProductoCompra;
use Stripe\Stripe;
use Stripe\Charge;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function showForm()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
       
        $request->validate([
            'stripeToken' => 'required',
            'total' => 'required|numeric', // Asegúrate de que el total esté validado correctamente
            'productos' => 'required|string', // Asegúrate de que los productos estén enviados correctamente como JSON
        ]);

        // Configurar Stripe
        Stripe::setApiKey(config('services.stripe.secret'));
        Log::info('entra');

        try {
            
            // Intentamos realizar el cargo a través de Stripe
            $charge = Charge::create([
                'amount' => $request->total * 100, // Convertir a centavos
                'currency' => 'eur',
                'description' => 'Pago en tu tienda online',
                'source' => $request->stripeToken, // Token de Stripe recibido
            ]);
    
            // Eliminar el carrito del comprador
            Carrito::where('comprador_id', session('comprador_id'))->delete();

            // Crear el registro de la compra
            $compra = Compra::create([
                'comprador_id' => session('comprador_id'),
                'precio_total' => $request->total,
                'estado' => 'pendiente',
                'fecha_compra' => Carbon::today()
            ]);

            // Decodificar los productos del JSON recibido
            $productosComprados = json_decode($request->productos, true); // true para obtener un array asociativo

            // Registrar los productos comprados
            if (!empty($productosComprados)) {
                foreach ($productosComprados as $producto) {
                    ProductoCompra::create([
                        'producto_codigo' => $producto['codigo'],
                        'compra_id' => $compra->id,
                        'cantidad' => $producto['cantidad'],
                        'precio_total' => $producto['precio_total'],
                    ]);
                }

                // Actualizar el stock de los productos
                foreach ($productosComprados as $producto) {
                    Producto::where('codigo', $producto['codigo'])
                        ->decrement('stock', $producto['cantidad']);
                }
            }

            // Si todo salió bien, generamos la factura en PDF
            $empresa = [
                'nombre' => 'Tempo y Tono',
                'direccion' => 'Calle de la Música, 123',
                'telefono' => '+34 123 456 789',
                'email' => 'contacto@tempoytono.com',
            ];

            // Cálculos de la factura
            $subtotal = array_sum(array_column($productosComprados, 'precio_total'));
            $iva = $subtotal * 0.21;
            $gastos_envio = 10.95;
            $total = $subtotal + $iva + $gastos_envio;

            // Crear el PDF
            $pdf = Pdf::loadView('public.factura', [
                'empresa' => $empresa,
                'productos' => $productosComprados,
                'subtotal' => $subtotal,
                'iva' => $iva,
                'gastos_envio' => $gastos_envio,
                'total' => $total,
            ]);
            
            // Generar el nombre y la ruta del archivo PDF
            $fileName = 'factura_' . time() . '.pdf';
            $path = storage_path('app/public/facturas/' . $fileName);
            $pdf->save($path);

            // Generar la URL pública para descargar el archivo PDF
            $url = asset('storage/facturas/' . $fileName);

            // Retornar la URL en un formato JSON para que JavaScript lo maneje
            return response()->json([
                'success' => true,
                'url' => $url,
            ]);

        } catch (\Exception $e) {
            // Capturar cualquier error y devolver un mensaje
            return back()->with('error', 'Error en el pago: ' . $e->getMessage());
        }
    }
}
