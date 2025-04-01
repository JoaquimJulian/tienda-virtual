@extends('layouts.app')

@section('title', 'Perfil')

@section('content')
<div class="flex flex-col items-center px-6 py-6 bg-beig min-h-screen">
    <div class="w-full max-w-2xl">
        @if (session('success'))    
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        <form action="{{ route('comprador.update', $comprador->id) }}" method="POST" class="flex flex-col space-y-4">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                <div class="flex flex-col space-y-4">
                    <div class="flex flex-col">
                        <label for="nombre" class="text-marron font-semibold mb-1">Nombre</label>
                        <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $comprador->nombre) }}" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="apellidos" class="text-marron font-semibold mb-1">Apellidos</label>
                        <input type="text" id="apellidos" name="apellidos" value="{{ old('apellidos', $comprador->apellidos) }}" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="direccion" class="text-marron font-semibold mb-1">Direccion</label>
                        <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $comprador->direccion) }}" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                    </div>

                    <div class="flex flex-col">
                        <label for="telefono" class="text-marron font-semibold mb-1">Telefono</label>
                        <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $comprador->telefono) }}" pattern="[0-9]{9}" 
                        maxlength="9" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                    </div>

                    <div class="flex flex-col">
                        <label for="email" class="text-marron font-semibold mb-1">Email</label>
                        <input type="text" id="email" name="email" value="{{ old('email', $comprador->email) }}" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="password" class="text-marron font-semibold mb-1">Contraseña</label>
                        <input type="password" id="password" name="password" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" placeholder="Ingresa una nueva contraseña (opcional)">
                    </div>

                    <div class="flex flex-col">
                        <label for="password_confirmation" class="text-marron font-semibold mb-1">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" placeholder="Confirma tu nueva contraseña">
                    </div>

                </div>

                
            </div>
            
            <input type="submit" value="Enviar" class="bg-marron text-white py-2 px-4 rounded hover:bg-marron-dark cursor-pointer w-full text-center">
        </form>
    </div>
</div>
@endsection