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
    public function index(Request $request)
    {
        $carritos = Carrito::where('comprador_id', session('comprador_id'))
        ->with('producto')
        ->get();

        if ($request->wantsJson()) {
            return response()->json($carritos);
        }

        return view("public.carrito");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
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
    public function show(string $codigo)
    {
        // Buscar el producto por su código
        $producto = Producto::where('codigo', $codigo)->first();

        // Si el producto no existe, devolver error
        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado']);
        }

        // Buscar el carrito asociado a ese producto
        $carrito = Carrito::where('producto_codigo', $producto->codigo)->first();

        // Si no hay carrito con ese producto, devolver error
        if (!$carrito) {
            return response()->json(['error' => 'No hay carritos con este producto']);
        }

        // Devolver el carrito en JSON
        return response()->json(['success' => 'Existe en el carrito', 'cantidad' => $carrito->cantidad]);
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
    public function update(Request $request, string $codigo)
    {
        // Buscar el producto por su código
        $producto = Producto::where('codigo', $codigo)->first();

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado']);
        }

        // Buscar el carrito del comprador con ese producto
        $carrito = Carrito::where('producto_codigo', $producto->codigo)
                        ->where('comprador_id', $request->comprador_id)
                        ->first();

        if (!$carrito) {
            return response()->json(['error' => 'El producto no está en el carrito']);
        }

        // Sumar la cantidad nueva a la cantidad actual
        $carrito->cantidad += $request->cantidad;
        $carrito->save();

        return response()->json([
            'success' => 'Cantidad actualizada en el carrito',
            'cantidad' => $carrito->cantidad
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
