<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FotografiaController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\CompradorController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\ProductoCompraController;

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