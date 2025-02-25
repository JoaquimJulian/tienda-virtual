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
        if (Auth::check()) {
            $user = Auth::user();
            log::info($request);

            if ($user instanceof \App\Models\Trabajador) {
                session(['user_type' => 'trabajador']);
            } elseif ($user instanceof \App\Models\Comprador) {
                session(['user_type' => 'comprador']);
            }
        }

        return $next($request);
    }
}
