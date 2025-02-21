<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FotografiaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompradorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ProductoCompraController;
use App\Http\Controllers\Auth\LoginController;


Route::resources([
    'categoria' => CategoriaController::class,
    'fotografia' => FotografiaController::class,
    'compra' => CompraController::class,
    'comprador' => CompradorController::class,
    'producto' => ProductoController::class,
    'trabajador' => TrabajadorController::class,
    'productoCompra' => ProductoCompraController::class
]);


Route::get('/', function () {
    return view('home');
})->name('app');

Route::prefix('auth')->group(function () {
    // Mostrar el formulario de login (GET)
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    
    // Procesar el login (POST)
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    
    // Cerrar sesión (POST)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


