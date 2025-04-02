@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'Todos los Productos') <!-- Aquí defines un título específico para esta página -->

@section('content')
    <div class="bg-beigclaro py-10">
        <h1 class="ml-8 text-4xl text-marron font-bold mt-8">Todos los Productos</h1>
        <p class="ml-8 mt-4 text-xl text-naranja">Explora nuestra selección completa de instrumentos musicales de alta calidad.</p>
        
        <!-- Mostrar productos -->
        @if ($productos->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-6 gap-6 mt-4 mb-12 ml-8 mr-8">
                @foreach ($productos as $producto)
                    <div class="rounded-lg bg-white p-4 shadow-md">
                        <a href="{{ route('producto.show', ['codigo' => $producto->codigo]) }}" class="block">
                            <img src="{{ Storage::url($producto->imagen_principal) }}" alt="{{ $producto->nombre }}" class="w-12 h-12">
                            <h3 class="text-xl font-semibold mt-2">{{ $producto->nombre }}</h3>
                            <p class="text-gray-500">{{ $producto->descripcion }}</p>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="ml-8 mt-4 text-xl">No hay productos disponibles.</p>
        @endif
    </div>
@endsection