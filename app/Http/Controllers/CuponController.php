<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cupon;

class CuponController extends Controller
{

public function generarCupon(Request $request)
{
    \Log::info("📌 Llegamos a generarCupon");

    if (!session('comprador_id')) {
        \Log::error("❌ Usuario no autenticado");
        return response()->json(['success' => false, 'message' => 'Debes iniciar sesión para jugar.']);
    }

    \Log::info("📩 Datos recibidos: ", $request->all());

    $request->validate([
        'tipo_cupon' => 'required|in:articulo_gratis,descuento'
    ]);

    \Log::info("✅ Validación pasada");

    $user_id = session('comprador_id');
    \Log::info("👤 Usuario autenticado con ID: $user_id");

    // 🔹 Ahora creamos el cupón en la base de datos
    $resultado = Cupon::crearCupon($user_id, $request->tipo_cupon);
    
    \Log::info("🎟️ Resultado de creación de cupón:", $resultado);

    return response()->json($resultado);
}



}
