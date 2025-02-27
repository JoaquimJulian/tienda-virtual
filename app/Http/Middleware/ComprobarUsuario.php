<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class ComprobarUsuario
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado como 'trabajador'
        if (Auth::guard('trabajador')->check()) {
            session(['user_type' => 'trabajador']);
        }

        // Verifica si el usuario está autenticado como 'comprador'
        elseif (Auth::guard('comprador')->check()) {
            session(['user_type' => 'comprador']);
        }

        // Si el usuario no está autenticado en ninguno de los guards
        else {
            Log::info('No autenticado');
        }

        return $next($request);
    }
}

