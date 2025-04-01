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
use App\Http\Controllers\StripeController;
use App\Http\Middleware\ComprobarUsuario;
use App\Http\Controllers\ImagenController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Personalizado;
use App\Http\Controllers\PersonalizadoController;
use App\Http\Controllers\GraficoController;
use App\Http\Controllers\CuponController;

Route::get('/carrito/checkProducto', [CarritoController::class, 'checkProducto']);
Route::get('/carrito/productos', [CarritoController::class, 'getProductosCarrito']);
Route::get('/carrito/existe', [CarritoController::class, 'existe']);
Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar']);
Route::put('/carrito/{comprador_id}/{producto_codigo}', [CarritoController::class, 'update']);
Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
Route::get('/categorias/json', [CategoriaController::class, 'indexJson'])->name('categorias.json');
Route::get('/producto/stock', [ProductoController::class, 'comprobarStock'])->name('producto.stock');
Route::get('/compra/createComprador', [CompraController::class, 'createComprador'])->name('compra.createComprador');
Route::post('/compra/guardarTarjeta', [CompraController::class, 'guardarTarjeta'])->name('compra.guardarTarjeta');
Route::get('/personalizado/mostrarVista', [PersonalizadoController::class, 'mostrarVista'])->name('personalizado.mostrarVista');
Route::get('/payment', [PaymentController::class, 'showPaymentForm']);
Route::post('/stripe/payment', [PaymentController::class, 'processPayment'])->name('stripe.payment');

Route::post('/generar-cupon', [CuponController::class, 'generarCupon']);


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

Route::get('/admin/mostrarGraficos', [GraficoController::class, 'mostrarGraficos'])->name('admin.graficos');

Route::get('/nosotros', function () {
    return view('nosotros.nosotros');
})->name('sobrenosotros');

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

Route::post('/guardar-imagen', [PersonalizadoController::class, 'guardarImagen']);

Route::get('/random-images', [PersonalizadoController::class, 'getRandomImages']);

