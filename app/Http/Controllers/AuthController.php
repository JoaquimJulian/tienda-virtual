<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Trabajador;
use App\Models\Comprador;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'passwordLogin' => 'required|string',
        ]);

        // Buscar en trabajadores
        $usuario = Trabajador::where('nombre', $request->nombre)->first();

        if (!$usuario) {
            // Si no encuentra en trabajadores, buscar en compradores
            $usuario = Comprador::where('nombre', $request->nombre)->first();
        }

        if ($usuario && Hash::check($request->passwordLogin, $usuario->password)) {
            if ($usuario instanceof \App\Models\Trabajador) {
                Auth::guard('trabajador')->login($usuario);
                Log::info('Usuario autenticado como Trabajador', ['usuario' => $usuario]);
            } elseif ($usuario instanceof \App\Models\Comprador) {
                Auth::guard('comprador')->login($usuario);
                session(['comprador_id' => $usuario->id]);
                Log::info('Usuario autenticado como Comprador', ['usuario' => $usuario]);
            }
        
            $request->session()->regenerate();
        
            return redirect()->route('app');
        }
        else {
            Log::warning('Intento de login fallido', ['nombre' => $request->nombre]);
        }
        

        return back()->withErrors(['nombre' => 'Credenciales incorrectas']);
    }

    public function logout()
    {
        if (Auth::guard('trabajador')->check()) {
            Auth::guard('trabajador')->logout();
        } elseif (Auth::guard('comprador')->check()) {
            Auth::guard('comprador')->logout();
        }

        return redirect()->route('app');
    }

}
