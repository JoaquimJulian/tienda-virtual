@extends('layouts.app')

@section('title', 'Sobre nosotros')

@section('content')
<div class="bg-beigclaro min-h-auto">
    <p class="text-center text-3xl font-bold py-6">AAA</p>
    
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 mt-4 pb-12 ml-8 mr-8">
        @foreach ([
            ['name' => 'Premium Electric Guitar', 'desc' => 'Professional Series', 'price' => '$1,299.99', 'img' => '../../images/productos/guitarra_1.jpg'],
            ['name' => 'Studio Microphone', 'desc' => 'Professional Series', 'price' => '$599.99', 'img' => '../../images/productos/microfono_1.jpg'],
            ['name' => 'Electric Drum Kit', 'desc' => 'Professional Series', 'price' => '$899.99', 'img' => '../../images/productos/bateria_1.jpg'],
            ['name' => 'Electric Drum Kit', 'desc' => 'Professional Series', 'price' => '$899.99', 'img' => '../../images/productos/bateria_1.jpg']
        ] as $product)
        <div class="rounded-2xl bg-white p-4 shadow-md h-full flex flex-col">
            <a href="{{ route('producto') }}" class="block">
                <div class="w-full aspect-[4/4] overflow-hidden rounded-lg">
                    <img src="{{ $product['img'] }}" alt="{{ $product['name'] }}" class="w-full h-full object-cover">
                </div>
            </a>
            
            <!-- Contenedor flexible para la info -->
            <div class="flex-grow flex flex-col justify-between">
                <div>
                    <p class="text-marron text-2xl font-semibold mt-2">{{ $product['name'] }}</p>
                    <p class="text-naranja">{{ $product['desc'] }}</p>
                </div>

                <div class="flex items-center justify-between mt-4">
                    <h4 class="text-marron text-2xl font-bold">{{ $product['price'] }}</h4>
                    <a href="#">
                        <img src="../../images/icono_carro.png" alt="Añadir al carrito" class="size-6">
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
