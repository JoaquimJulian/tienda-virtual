<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Comprador;
use App\Models\Producto;
use App\Models\Carrito;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;
use Stripe\Checkout\Session;


class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('comprador')->get();
        return response()->json($compras);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (session('user_type') == 'trabajador') {
            $compradores = Comprador::all();
            return view("admin.gestionPedidos", compact('compradores'));
        }
    }

    public function createComprador()
    {
        if (session('user_type') == 'comprador') {

            $carritos = Carrito::where('comprador_id', session('comprador_id'))->get();

            // Obtener todos los códigos de producto en un array
            $productosCodigos = $carritos->pluck('producto_codigo');

            // Obtener los productos correspondientes a esos códigos
            $productos = Producto::whereIn('codigo', $productosCodigos)->get();

            // Asociar los productos con la cantidad del carrito y calcular el precio total
            $productos = $productos->map(function ($producto) use ($carritos) {
                // Buscar la cantidad correspondiente en el carrito
                $cantidad = $carritos->firstWhere('producto_codigo', $producto->codigo)->cantidad;
                
                // Agregar el campo de precio total y el de cantidad
                $producto->precio_total = $producto->precio_unidad * $cantidad * 1.21;
                $producto->cantidad = $cantidad;

                return $producto;
            });

            $stockInsuficiente = false;
            $productos->each(function ($producto) use (&$stockInsuficiente) {
                if ($producto->stock < $producto->cantidad) {
                    // Si el stock es menor que la cantidad solicitada
                    Log::warning("Stock insuficiente para el producto: {$producto->nombre}");
                    $stockInsuficiente = true;
                }
            });
            
            if($stockInsuficiente) {
                return redirect()->route('app'); // Redirige a home
            }else if(!empty($carritos)){
                return view('/public/pagar', ['productos' => $productos]);
            }else {
                Log::info($carritos);
                return view('/public/carrito');
            }

        } else {
            return redirect()->route('app'); // Redirige a home
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $compra = Compra::findOrFail($id);
        $comprador = Comprador::findOrFail($compra->comprador_id);
        Log::info($compra);

        return view('admin.editCompra', compact('compra', 'comprador'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'estado' => 'required|string|max:255',
            'fecha_envio' => 'nullable|string',
        ]);

        $compra = Compra::findOrFail($id);
        $compra->update([
            'estado' => $request->estado,
            'fecha_envio' => $request->fecha_envio,
        ]);

        return redirect()->route('compra.create')->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function guardarTarjeta(Request $request) {
        // Validación de los datos del formulario
        $request->validate([
            'numero' => 'required|digits:16',
            'nombre' => 'required|string|max:255',
            'fechaExpiracion' => 'required|regex:/^\d{2}\/\d{2}$/',
            'cvv' => 'required|digits:3',
        ]);

        $datos = [
            'numero' => $request->input('numero'),
            'nombre' => $request->input('nombre'),
            'fechaExpiracion' => $request->input('fechaExpiracion'),
            'cvv' => $request->input('cvv'),
        ];
    
        // Guardar los datos en la sesión
        session(['tarjeta' => $datos]);
        Log::info(session('tarjeta'));

        // Puedes devolver una respuesta para confirmar que se guardaron los datos
        return response()->json([
            'success' => true,
            'message' => 'Tarjeta guardada en sesión correctamente.',
        ]);
    }
}
