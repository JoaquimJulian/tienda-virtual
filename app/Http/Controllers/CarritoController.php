<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Producto;
use Illuminate\Support\Facades\Log;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    public function getProductosCarrito(Request $request) {
        $productos = Carrito::where('comprador_id', $request->comprador_id)
                            ->with('producto')
                            ->get()
                            ->map(function ($carrito) {
                                if ($carrito->producto) {
                                    // Agregar el campo "cantidad" al producto
                                    $carrito->producto->cantidad = $carrito->cantidad;
                                }
                                return $carrito->producto;
                            });

        return response()->json($productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("public.carrito");
    }

    /**
     * Verificar si el producto ya existe en el carrito.
     */
    public function checkProducto(Request $request)
    {
        // Verificar si el producto ya está en el carrito de este comprador
        $carrito = Carrito::where('comprador_id', $request->comprador_id)
                         ->where('producto_codigo', $request->producto_codigo)
                         ->get();

        return response()->json($carrito);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos enviados
        $request->validate([
            'comprador_id' => 'required|exists:compradores,id',  // Validamos que el id del comprador exista
            'producto_codigo' => 'required|exists:productos,codigo',  // Validamos que el código del producto exista
            'cantidad' => 'required|integer|min:1',  // Validamos que la cantidad sea un entero mayor que 0
        ]);
      

        Carrito::create([
            'comprador_id' => $request->comprador_id,
            'producto_codigo' => $request->producto_codigo,
            'cantidad' => $request->cantidad,
        ]);

        return response()->json(['message' => 'Producto añadido al carrito correctamente']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Buscar el carrito con el id proporcionado
        $carrito = Carrito::find($id);

        if (!$carrito) {
            return response()->json(['error' => 'Producto no encontrado en el carrito'], 404);
        }

        return response()->json([
            'success' => true,
            'carrito' => $carrito
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Log::info('entra');

        // Validar los datos recibidos
        $request->validate([
            'cantidad' => 'required|integer|min:1',  // Aseguramos que la cantidad sea válida
        ]);

        // Encontrar el carrito por ID
        $carrito = Carrito::find($id);

        if (!$carrito) {
            return response()->json(['error' => 'Producto no encontrado en el carrito'], 404);
        }

        // Actualizar la cantidad del producto en el carrito
        $carrito->cantidad = $request->cantidad;
        $carrito->save();

        return response()->json([
            'success' => true,
            'carrito' => $carrito
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $comprador_id)
    {
        // Eliminar todos los productos del carrito con el comprador_id específico
        Carrito::where('comprador_id', $comprador_id)->delete();

        return response()->json(['message' => 'Productos eliminados del carrito correctamente']);
    }

    public function existe(Request $request)
    {
        $producto = Carrito::where('comprador_id', $request->comprador_id)
                        ->where('producto_codigo', $request->producto_codigo)
                        ->first();

        return response()->json(['existe' => $producto ? true : false]);
    }

    public function actualizar(Request $request)
    {
        $carrito = Carrito::where('comprador_id', $request->comprador_id)
                        ->where('producto_codigo', $request->producto_codigo)
                        ->first();

        if ($carrito) {
            // Si el producto existe, actualizar la cantidad
            $carrito->cantidad += $request->cantidad;
            $carrito->save();

            return response()->json(['message' => 'Cantidad actualizada correctamente']);
        } else {
            // Si no existe, puedes manejarlo aquí si lo deseas
            return response()->json(['message' => 'Producto no encontrado']);
        }
    }

}
