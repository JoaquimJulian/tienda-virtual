<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Producto; 
use Illuminate\Support\Facades\Log;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las categorías
        $categorias = Categoria::all();

        // Obtener los productos destacados
        $destacados = Producto::where('destacado', 1)->get();

        // Pasar ambas variables a la vista 'home'
        return view('home', compact('categorias', 'destacados'));
    }


    public function indexJson() {
       
        return response()->json(Categoria::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (session('user_type') == 'trabajador') {
            return view("admin.crudAdmin");
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = time() . '_' . $imagen->getClientOriginalName(); // Evita nombres repetidos
            $rutaDestino = public_path('images/instrumentos');

            $imagen->move($rutaDestino, $nombreImagen); // Mueve la imagen a public/images/instrumentos
        } else {
            return response()->json(['error' => 'Error al subir la imagen'], 400);
        }

        $categoria = Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'imagen' => $nombreImagen 
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

    public function productoscategoria($id)
    {
        // Obtener la categoría por id
        $categoria = Categoria::find($id);

        // Obtener los productos relacionados con la categoría
        $productos = Producto::where('categoria_id', $id)->get();


        // Pasar la categoría y los productos a la vista
        return view('categorias.productoscategoria', compact('categoria', 'productos'));
    }

    public function showHeader()
    {
        $categorias = Categoria::all();  // Obtener todas las categorías
        return view('layouts.header', compact('categorias'));  // Pasar la variable a la vista
    }


}
