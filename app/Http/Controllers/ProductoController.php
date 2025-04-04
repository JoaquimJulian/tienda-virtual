<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);

        $productos = Producto::with('categoria')->paginate($perPage);
        return response()->json($productos);
    }

    public function indexSinPaginar() {
        $productos = Producto::all();
        return view('public.productos', compact('productos'));  
    }

    public function comprobarStock(Request $request)
    {
        $productosCarrito = $request->input('productos'); // Obtener el array de productos desde el request
        $productosSinStock = [];

        foreach ($productosCarrito as $producto) {
            $productoDB = Producto::where('codigo', $producto['codigo'])->first();

            if (!$productoDB || $productoDB->stock < $producto['cantidad']) {
                $productosSinStock[] = [
                    'codigo' => $producto['codigo'],
                    'nombre' => $productoDB ? $productoDB->nombre : 'Producto no encontrado',
                    'stock_disponible' => $productoDB ? $productoDB->stock : 0,
                    'cantidad_solicitada' => $producto['cantidad']
                ];
            }
        }

        if (count($productosSinStock) > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Algunos productos no tienen suficiente stock.',
                'productos_sin_stock' => $productosSinStock
            ], 400);
        }

        return response()->json([
            'success' => true,
            'message' => 'Todos los productos tienen stock suficiente.'
        ], 200);
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
            'fotografia_principal' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $rutaImagenPrincipal = "";
    
        if ($request->hasFile('fotografia_principal')) {
            $imagenPrincipal = $request->file('fotografia_principal');
            $rutaImagenPrincipal = $imagenPrincipal->store('imgProductos', 'public'); 
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

        if ($request->has('fotografias_secundarias')) {
            Log:info('entra');
            foreach ($request->file('fotografias_secundarias') as $foto) {
                $rutaFoto = $foto->store('imgProductos', 'public');

                DB::table('fotografias')->insert([
                    'producto_codigo' => $request->codigo,
                    'nombre' => basename($rutaFoto),
                ]);
            }
        }

        return redirect()->route('categoria.create');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $codigo)
    {
        $producto = Producto::where('codigo', $codigo)->first();

        // Obtener las fotografías asociadas al producto
        $fotografias = $producto ? $producto->fotografias : [];

        $productosRelacionados = Producto::where('categoria_id', $producto->categoria_id)
                                    ->where('codigo', '!=', $producto->codigo)
                                    ->get();

        return view('public.producto', compact('producto', 'fotografias', 'productosRelacionados'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();  
        Log::info('Producto recibido en la vista:', ['producto' => $producto]);

        return view('admin.editProducto', compact('producto', 'categorias'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $codigo)
    {

        Log::info('Datos recibidos en update:', [
            'inputs' => $request->all(),
            'files' => $request->file(),
            'content_length' => $request->header('Content-Length'),
        ]);
        $request->validate([
            'codigo' => 'required|string|max:255|unique:productos,codigo,' . $codigo . ',codigo',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'categoria_id' => 'required|exists:categorias,id',
            'precio_unidad' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'destacado' => 'sometimes|boolean',
            'fotografia_principal' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $rutaImagenPrincipal = "";
    
        if ($request->hasFile('fotografia_principal')) {
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

        return response()->json([
            'success' => true,
            'message' => 'Producto actualizado exitosamente',
        ], 200);
    }

    public function eliminiarImagenesSecundarias(Request $request) {
        DB::table('fotografias')
            ->where('producto_codigo', $request->producto_codigo)
            ->delete();
        return response()->json(['success' => true]);
    }

    public function subirImagenSecundaria(Request $request) {
        if ($request->hasFile('fotografia_secundaria')) {
            $path = $request->file('fotografia_secundaria')->store('imgProductos', 'public');
            Log::info($path);

            DB::table('fotografias')->insert([
                'producto_codigo' => $request->producto_codigo,  
                'nombre' => $path, 
            ]);

            return response()->json(['path' => $path, 'success' => true]);
        }
        return response()->json(['error' => 'No se subió la imagen'], 400);
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
