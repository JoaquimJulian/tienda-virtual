
@extends('layouts.app') <!-- Extiende el layout principal -->

@section('title', 'Página de Inicio')

@section('content')
    <!-- SECCIÓN: INICIO -->
    <section class="bg-beig py-10">
        <h1 class="text-4xl font-bold">Discover Your Perfect Sound</h1>
        <p class="text-lg text-gray-600">Explore our curated collection of premium instruments and audio equipment.</p>
        <button class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Shop Now</button>
        <!-- SECCIÓN: CATEGORÍAS -->
        <h2 class="text-3xl font-bold mb-6">Browse Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ([
                    ['name' => 'Guitars', 'desc' => 'Acoustic & Electric', 'img' => '../../images/icono_guitarra.png'],
                    ['name' => 'Drums', 'desc' => 'Acoustic & Electronic', 'img' => '../../images/icono_bateria.png'],
                    ['name' => 'Recording', 'desc' => 'Studio Equipment', 'img' => '../../images/icono_microfono.png'],
                    ['name' => 'Accessories', 'desc' => 'Gear & Parts', 'img' => '../../images/icono_notamusical.png']
                ] as $category)
                <div class="rounded-lg bg-white p-4 shadow-md">
                    <a href="#" class="block">
                        <img src="{{ $category['img'] }}" alt="{{ $category['name'] }}" class="w-12 h-12">
                        <h3 class="text-xl font-semibold mt-2">{{ $category['name'] }}</h3>
                        <p class="text-gray-500">{{ $category['desc'] }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- SECCIÓN: PRODUCTOS DESTACADOS -->
    <section class="py-10">
        <p class="text-2xl font-bold mb-6 ml-8">Featured Products</p>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-16">
            @foreach ([
                ['name' => 'Premium Electric Guitar', 'desc' => 'Professional Series', 'price' => '$1,299.99', 'img' => '../../images/productos/guitarra_1.jpg'],
                ['name' => 'Studio Microphone', 'desc' => 'Professional Series', 'price' => '$599.99', 'img' => '../../images/productos/microfono_1.jpg'],
                ['name' => 'Electric Drum Kit', 'desc' => 'Professional Series', 'price' => '$899.99', 'img' => '../../images/productos/bateria_1.jpg']
            ] as $product)
                <div class="border p-4 rounded-lg shadow-md">
                    <a href="#" class="block">
                        <img src="{{ $product['img'] }}" alt="{{ $product['name'] }}" class="w-96 h-96 mx-auto">
                        <h3 class="text-xl font-semibold mt-2">{{ $product['name'] }}</h3>
                        <p class="text-gray-500">{{ $product['desc'] }}</p>
                        <h4 class="text-2xl font-bold mt-2">{{ $product['price'] }}</h4>
                        <button class="mt-4 bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add to Cart</button>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    <!-- SECCIÓN: SUSCRIPCIÓN -->
    <section class="bg-beig text-center py-10">
        <h2 class="text-3xl font-bold pt-40">Stay in Tune</h2>
        <p class="text-lg text-gray-600">Subscribe to our newsletter for exclusive deals, new arrivals, and musical inspiration.</p>
        <form action="#" method="POST" class="mt-4">
            <input type="email" id="email" placeholder="Enter your email" class="border rounded-md px-4 py-2 focus:ring-2 focus:ring-blue-500">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Subscribe</button>
        </form>
    </section>
@endsection
