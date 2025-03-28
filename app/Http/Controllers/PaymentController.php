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
        ]);

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $request->total * 100, // Convertir a centavos
                'currency' => 'eur',
                'description' => 'Pago en tu tienda online',
                'source' => $request->stripeToken,
            ]);

            Carrito::where('comprador_id', session('comprador_id'))->delete();

            $compra = Compra::create([
                'comprador_id' => session('comprador_id'),
                'precio_total' => $request->total,
                'estado' => 'pendiente',
                'fecha_compra' => Carbon::today()
            ]);
            
            $productosComprados = $request->productos;
            if (!empty($productosComprados)) {
            
                $productosComprados = json_decode($request->productos, true); // true para obtener un array asociativo

                try {
                    foreach ($productosComprados as $producto) {
                        ProductoCompra::create([
                            'producto_codigo' => $producto['codigo'],
                            'compra_id' => $compra->id,
                            'cantidad' => $producto['cantidad'],
                            'precio_total' => $producto['precio_total'],
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error('Error al registrar productos comprados: ' . $e->getMessage());
                }

                try {
                    foreach ($productosComprados as $producto) {
                        Producto::where('codigo', $producto['codigo'])
                            ->decrement('stock', $producto['cantidad']);
                    }
                } catch (\Exception $e) {
                    Log::error('Error al actualizar el stock: ' . $e->getMessage());
                }
            }

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

            // Generar el nombre y la ruta del archivo
            try {
                // Generar el nombre del archivo
                $fileName = 'factura_' . time() . '.pdf';
                $path = storage_path('app/public/facturas/' . $fileName);
                $pdf->save($path);

                // Generar la URL pública del archivo
                $url = asset('storage/facturas/' . $fileName);

                // Retornar la vista directamente con el enlace para descargar el PDF
                return redirect()->to($url);

            } catch (\Exception $e) {
                // Si ocurre un error, lo capturamos y lo registramos en los logs
                Log::error('Error al guardar y generar la URL de descarga del PDF: ' . $e->getMessage());
                
                // Redirigir al usuario con un mensaje de error
                return redirect()->route('app')->with('error', 'Hubo un error al generar la factura.');
            }
            
        } catch (\Exception $e) {
            return back()->with('error', 'Error en el pago: ' . $e->getMessage());
        }
    }
}
