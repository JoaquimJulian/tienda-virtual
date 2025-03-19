<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Comprador;

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
        if (session('user_type' == 'trabajador')) {
            $compradores = Comprador::all();
            return view("admin.gestionPedidos", compact('compradores'));
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
}
