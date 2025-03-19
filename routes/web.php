<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FotografiaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompradorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ProductoCompraController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Middleware\ComprobarUsuario;
use App\Http\Controllers\ImagenController;
use Illuminate\Support\Facades\Log;

Route::get('/carrito/checkProducto', [CarritoController::class, 'checkProducto']);
Route::get('/carrito/productos', [CarritoController::class, 'getProductosCarrito']);
Route::get('/carrito/existe', [CarritoController::class, 'existe']);
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar']);
Route::put('/carrito/{comprador_id}/{producto_codigo}', [CarritoController::class, 'update']);
Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::get('/categorias/json', [CategoriaController::class, 'indexJson'])->name('categorias.json');


Route::resources([
    'categoria' => CategoriaController::class,
    'fotografia' => FotografiaController::class,
    'compra' => CompraController::class,
    'comprador' => CompradorController::class,
    'producto' => ProductoController::class,
    'trabajador' => TrabajadorController::class,
    'productoCompra' => ProductoCompraController::class,
    'carrito' => CarritoController::class
]);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/producto/subirImagenSecundaria', [ProductoController::class, 'subirImagenSecundaria'])->name('producto.subirImagenSecundaria');

Route::post('/producto/eliminiarImagenesSecundarias', [ProductoController::class, 'eliminiarImagenesSecundarias'])->name('producto.eliminiarImagenesSecundarias');
Route::get('/producto/{codigo}', [ProductoController::class, 'show'])->name('producto.show');


Route::get('/nosotros', function () {
    return view('nosotros.nosotros');
})->name('sobrenosotros');

Route::get('/personalizar', function () {
    return view('personalizar.personalizar');
})->name('personalizar');

Route::get('/categorias/producto', function () {
    return view('categorias.producto');
})->name('producto');

Route::get('/categorias/{id}', [CategoriaController::class, 'productoscategoria'])->name('categorias.productoscategoria');

Route::prefix('auth')->group(function () {
    // Mostrar el formulario de login (GET)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    
    // Procesar el login (POST)
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    
    // Cerrar sesión (POST)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware([ComprobarUsuario::class])->get('/', [CategoriaController::class, 'index'])->name('app');

Route::post('/guardar-imagen', function (Request $request) {
    if ($request->has('image')) {
        $image = $request->input('image'); // Base64
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageData = base64_decode($image);

        $filename = 'personalizable_' . now()->format('YmdHis') . '.png';
        Storage::disk('public')->put("images/personalizable/$filename", $imageData);

        return response()->json(['filepath' => "/storage/images/personalizable/$filename"]);
    }
    return response()->json(['error' => 'No image received'], 400);
});

Route::get('/random-images', [ImagenController::class, 'getRandomImages']);