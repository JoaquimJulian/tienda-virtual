<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Trabajador;
use App\Models\Comprador;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'password' => 'required|string',
        ]);

        // Buscar en trabajadores
        $usuario = Trabajador::where('nombre', $request->nombre)->first();

        if (!$usuario) {
            // Si no encuentra en trabajadores, buscar en compradores
            $usuario = Comprador::where('nombre', $request->nombre)->first();
        }

        $password = trim($request->password, '"');  // Eliminar comillas alrededor de la contraseña
        $hashedPassword = trim($usuario->password, '"');

        if ($usuario && Hash::check($password, $hashedPassword)) {
            log::info('hola');
            // Determina el guard correcto dependiendo del tipo de usuario
            if ($usuario instanceof \App\Models\Trabajador) {
                Auth::guard('trabajador')->login($usuario);  // Usamos el guard de trabajador
            } elseif ($usuario instanceof \App\Models\Comprador) {
                Auth::guard('comprador')->login($usuario);  // Usamos el guard de comprador
            }

            $request->session()->regenerate(); // Regenera la sesión
            return redirect()->route('app'); // Redirige a home
        }

        return back()->withErrors(['nombre' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
