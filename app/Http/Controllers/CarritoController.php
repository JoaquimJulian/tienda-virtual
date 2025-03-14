<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use Illuminate\Support\Facades\Log;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("public.carrito");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
