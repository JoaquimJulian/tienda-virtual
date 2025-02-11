@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center h-full">
    <div class="w-full max-w-md bg-white rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-semibold text-center text-gray-700 mb-4">Iniciar Sesión</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4" id="loginForm">
            @csrf

            <div>
                <label for="user" class="block text-sm font-medium text-gray-700">Usuario</label>
                <input type="text" id="user" name="user" required autofocus
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <button type="submit" id="btnLogin"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Ingresar
            </button>
        </form>
    </div>
</div>
@endsection