<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Log;


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
            'destacado' => 'sometimes|in:on,off',
            'fotografia_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $rutaImagenPrincipal = "";
    
        if ($request->hasFile('fotografia_principal')) {
            $imagenPrincipal = $request->file('fotografia_principal');
            $rutaImagenPrincipal = $imagenPrincipal->store('imgProductos', 'public'); 
        }

        if ($request->hasFile('fotografias_secundarias')) {
            
        }

        $producto = Producto::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'precio_unidad' => $request->precio_unidad,
            'stock' => $request->stock,
            'destacado' => $request->has('destacado') ? 1 : 0,
            'imagen_principal' => $rutaImagenPrincipal,
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
        Log::info($request->all());
        $request->validate([
            'codigo' => 'required|string|max:255|unique:productos,codigo,' . $codigo . ',codigo',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_unidad' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'destacado' => 'sometimes|boolean',
            'fotografia_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $rutaImagenPrincipal = "";
    
        if ($request->hasFile('fotografia_principal')) {
            Log::info('Actulizando imagen principal');

            $imagenPrincipal = $request->file('fotografia_principal');
            $rutaImagenPrincipal = $imagenPrincipal->store('imgProductos', 'public'); 
        }

        $producto = Producto::findOrFail($codigo);
        $producto->update([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'categoria_id' => $request->categoria_id,
            'precio_unidad' => $request->precio_unidad,
            'stock' => $request->stock,
            'destacado' => $request->has('destacado') ? 1 : 0,
            'imagen_principal' => $rutaImagenPrincipal ?: $producto->imagen_principal, // Si no se carga imagen, mantiene la actual
        ]);

        return redirect()->route('categoria.create')->with('success', 'Producto actualizado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $codigo)
    {
        $producto = Producto::find($codigo);

        if ($producto) {
            $producto->delete();

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
