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
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('home');
})->name('app');

Route::get('/nosotros', function () {
    return view('nosotros.nosotros');
})->name('sobrenosotros');


Route::prefix('auth')->group(function () {
    // Mostrar el formulario de login (GET)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    
    // Procesar el login (POST)
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    
    // Cerrar sesión (POST)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


