<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las categorías desde la base de datos
        $categorias = Categoria::all();

        // Pasar las categorías a la vista 'home'
        return view('home', compact('categorias'));
    }

    public function indexJson() {
        return response()->json(Categoria::all());
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.crudAdmin");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $categoria = Categoria::create([
            'nombre' => $request->nombre
        ]);

        return response()->json([
            'success' => true,
            'categoria' => $categoria
        ]);
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
        $categoria = Categoria::find($id);

        if (!$categoria) {
            return response()->json(['error' => 'Categoría no encontrada'], 404);
        }

        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $categoria->nombre = $request->input('nombre');
        $categoria->save();

        return response()->json(['success' => true, 'categoria' => $categoria]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::find($id);

        if ($categoria) {
            $categoria->delete();

            return response()->json([
                'success' => true,
                'message' => 'Categoría eliminada con éxito.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Categoría no encontrada.'
        ], 404);
    }
}
