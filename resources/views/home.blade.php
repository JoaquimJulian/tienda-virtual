
@extends('layouts.app') <!-- Extiende el layout principal -->

@section('title', 'Página de Inicio')

@section('content')
    <!-- SECCIÓN: INICIO -->
    <section class="bg-beigclaro py-10">
        <h1 class="ml-8 text-4xl text-marron font-bold mt-8 w-1/2">Discover Your Perfect Sound</h1>
        <p class="ml-8 mt-4 text-xl text-naranja w-1/2">Explore our curated collection of premium instruments and audio equipment.</p>
        <button class="mt-6 ml-8 bg-marron hover:bg-beigoscuro text-white  hover:text-white py-2 px-8 rounded-full">Shop Now</button>
        <!-- SECCIÓN: CATEGORÍAS -->
        <h2 class="ml-8 mt-8 text-3xl font-bold mb-6">Browse Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mt-4 mb-12 ml-8 mr-8">
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
    <section class="py-10 mt-8">
        <p class="text-4xl font-bold mb-6 ml-8">Featured Products</p>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16 w-full">
            @foreach ([
                ['name' => 'Premium Electric Guitar', 'desc' => 'Professional Series', 'price' => '$1,299.99', 'img' => '../../images/productos/guitarra_1.jpg'],
                ['name' => 'Studio Microphone', 'desc' => 'Professional Series', 'price' => '$599.99', 'img' => '../../images/productos/microfono_1.jpg'],
                ['name' => 'Electric Drum Kit', 'desc' => 'Professional Series', 'price' => '$899.99', 'img' => '../../images/productos/bateria_1.jpg']
            ] as $product)
                <div class="w m-auto">
                    <a href="#"><img src="{{ $product['img'] }}" alt="{{ $product['name'] }}" class="size-96 rounded-2xl"></a>
                    <h3 class="text-marron text-2xl font-semibold mt-2 w-full">{{ $product['name'] }}</h3>
                    <p class="text-naranja">{{ $product['desc'] }}</p>
                    <div>
                        <h4 class="mt-4 text-marron text-2xl font-bold mt-2 float-left">{{ $product['price'] }}</h4>
                        <button class="mt-2 bg-beig hover:bg-beigoscuro text-marron hover:text-white py-2 px-4 rounded-full float-right">Add to Cart</button>
                    </div>
               </div>
            @endforeach
        </div>
    </section>

    <!-- SECCIÓN: SUSCRIPCIÓN -->
    <section class="bg-beigclaro text-center py-10 mt-8">
        <div class="bg-beig m-20 w-3/4 rounded-2xl m-auto p-8">
            <h2 class="text-4xl font-bold mb-6">Stay in Tune</h2>
            <p class="text-lg text-gray-600 mb-6 mx-2">
                Subscribe to our newsletter for exclusive deals, new arrivals, and musical inspiration.
            </p>
            <form action="#" method="POST" class="flex justify-center items-center w-full">
                <div class="flex w-4/5 bg-white rounded-full overflow-hidden shadow-lg">
                    <input type="email" id="email" placeholder="Enter your email"
                        class="border-none px-4 py-2 w-full outline-none">
                    <button type="submit"
                        class="bg-marron hover:bg-naranja text-white font-bold px-6 py-2 rounded-r-full">
                        Subscribe
                    </button>
                </div>
            </form>
        </div>
    </section>

@endsection
