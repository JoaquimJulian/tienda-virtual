<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return response()->json($productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.crearProducto");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $request->validate([
            'codigo' => 'required|string|max:255|unique:productos,codigo',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_unidad' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'destacado' => 'sometimes|in:on,off'
        ]);

        $producto = Producto::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'precio_unidad' => $request->precio_unidad,
            'stock' => $request->stock,
            'destacado' => $request->has('destacado') ? 1 : 0,
        ]);

        return redirect()->route('categoria.create');
        
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
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();  
        
        return view('admin.editProducto', compact('producto', 'categorias'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $codigo)
    {
        $request->validate([
            'codigo' => 'required|string|max:255|unique:productos,codigo,' . $codigo . ',codigo',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_unidad' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'destacado' => 'sometimes|boolean',
        ]);

        $producto = Producto::findOrFail($codigo);
        $producto->update([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'precio_unidad' => $request->precio_unidad,
            'stock' => $request->stock,
            'destacado' => $request->has('destacado') ? 1 : 0,
        ]);

        return redirect()->route('categoria.create')->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
