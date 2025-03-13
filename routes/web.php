<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FotografiaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompradorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ProductoCompraController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\ComprobarUsuario;

Route::resources([
    'categoria' => CategoriaController::class,
    'fotografia' => FotografiaController::class,
    'compra' => CompraController::class,
    'comprador' => CompradorController::class,
    'producto' => ProductoController::class,
    'trabajador' => TrabajadorController::class,
    'productoCompra' => ProductoCompraController::class
]);

Route::middleware([ComprobarUsuario::class])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('app');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/producto/subirImagenSecundaria', [ProductoController::class, 'subirImagenSecundaria'])->name('producto.subirImagenSecundaria');

Route::post('/producto/eliminiarImagenesSecundarias', [ProductoController::class, 'eliminiarImagenesSecundarias'])->name('producto.eliminiarImagenesSecundarias');


Route::get('/nosotros', function () {
    return view('nosotros.nosotros');
})->name('sobrenosotros');

Route::get('/categorias/productoscategoria', function () {
    return view('categorias.productoscategoria');
})->name('productoscategoria');
Route::get('/categorias/producto', function () {
    return view('categorias.producto');
})->name('producto');

Route::prefix('auth')->group(function () {
    // Mostrar el formulario de login (GET)
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    
    // Procesar el login (POST)
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    
    // Cerrar sesión (POST)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', [CategoriaController::class, 'index'])->name('app');
