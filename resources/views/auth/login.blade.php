@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center h-full">
    <form method="POST" action="{{ route('login') }}" class="w-full max-w-sm space-y-4">
        @csrf

        <!-- Email field -->
        <div>
            <label for="nombre" class="block text-sm text-gray-800 mb-1">Nombre de usuario</label>
            <input 
                type="nombre" 
                id="nombre" 
                name="nombre" 
                required 
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
            >
        </div>

        <!-- Password field -->
        <div>
            <label for="password" class="block text-sm text-gray-800 mb-1">Contraseña</label>
            <input 
                type="password" 
                id="password" 
                name="password" 
                required
                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:border-gray-500"
            >
        </div>

        <!-- Login button -->
        <button 
            type="submit"
            class="w-full bg-custom-black text-white py-2 px-4 rounded hover:bg-gray-800 transition duration-200"
        >
            Iniciar Sesion
        </button>

        <!-- Registration link -->
        <div class="flex items-center justify-between mt-4">
            <span class="text-sm text-gray-600">No tienes cuenta? Registrate:</span>
            <a 
                href="" 
                class="bg-custom-black  text-white px-4 py-2 text-sm rounded hover:bg-gray-800 transition duration-200"
            >
                Registrarse
            </a>
        </div>
    </form>
</div>
@endsection