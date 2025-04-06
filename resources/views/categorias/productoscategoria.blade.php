@extends('layouts.app') <!-- Extiende el layout principal -->

@section('title', 'Página de Inicio')

@section('content')
    <section class="bg-beigclaro py-10">
    <h1 class="ml-8 text-4xl text-marron font-bold mt-8">{{ $categoria->nombre }}</h1>
    <p class="ml-8 mt-4 text-xl text-naranja w-1/2">{{ $categoria->descripcion }}</p>
    
    <!-- Mostrar productos -->
    @if ($productos->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-6 gap-6 mt-4 mb-12 ml-8 mr-8">
        @foreach ($productos as $producto)
            <div class="rounded-lg bg-white p-4 shadow-md">
                <a href="{{ route('producto.show', ['codigo' => $producto->codigo]) }}" class="block">
                    <div class="relative w-full h-48 overflow-hidden"> <!-- Contenedor con dimensiones fijas -->
                        <img src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->nombre }}" class="object-contain w-full h-full"> <!-- La imagen se adapta al tamaño del div padre -->
                    </div>
                    <h3 class="text-xl font-semibold mt-2">{{ $producto->nombre }}</h3>
                    <p class="text-gray-500">{{ $producto->descripcion }}</p>
                </a>
            </div>
        @endforeach
    </div>

    @else
        <p class="ml-8 mt-4 text-xl">No hay productos en esta categoría.</p>
    @endif
</section>
@endsection
