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
            
            Log::info($request->productos);
            $productosComprados = $request->productos;
            if (!empty($productosComprados)) {
                Log::info($productosComprados);
            
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
            
            // Redirigir con mensaje de éxito
            return redirect()->route('app');
        } catch (\Exception $e) {
            return back()->with('error', 'Error en el pago: ' . $e->getMessage());
        }
    }
}
