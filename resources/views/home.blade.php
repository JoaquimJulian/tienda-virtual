@extends('layouts.app') <!-- Extiende el layout principal -->

@section('title', 'Página de Inicio')

@section('content')
    <!-- SECCIÓN: INICIO -->
    <section class="py-10">
        <h1 class="ml-8 text-4xl text-marron font-bold mt-8 w-1/2">DESCUBRE TU SONIDO PERFECTO</h1>
        <p class="ml-8 mt-4 text-xl text-naranja w-1/2">Explore nuestra colección seleccionada de instrumentos y equipos de audio de primera calidad.</p>
        <button class="mt-6 ml-8 bg-marron hover:bg-beigoscuro text-white  hover:text-white py-2 px-8 rounded-full">Comprar ahora</button>

        <!-- SECCIÓN: CATEGORÍAS -->
        <h2 class="ml-8 mt-8 text-3xl font-bold mb-6">CATEGORIAS</h2>
        <div class="grid grid-cols-2 md:grid-cols-6 gap-6 mt-4 mb-12 ml-8 mr-8">
            @foreach ($categorias as $categoria)
                <div class="rounded-lg bg-white p-4 shadow-md">
                    <a href="{{ route('categorias.productoscategoria', ['id' => $categoria->id]) }}" class="block">
                        <img src="{{ asset('images/' . $categoria->imagen) }}" alt="{{ $categoria->nombre }}" class="w-12 h-12">
                        <h3 class="text-xl font-semibold mt-2">{{ $categoria->nombre }}</h3>
                        <p class="text-gray-500">{{ $categoria->descripcion }}</p>
                    </a>
                </div>
            @endforeach
        </div>
        <p class="text-2xl ml-8">Compra tu propio bombo personalizado clicando 
            <a href="#" 
            onclick="checkLoginAndRedirect()" 
            class="text-naranja underline">aquí</a>
        </p>  
    </section>
    
    <!-- SECCIÓN: PRODUCTOS DESTACADOS -->
    <section class="py-10 mt-8 bg-white">
        <p class="text-4xl font-bold mb-6 ml-8">PRODUCTOS DESTACADOS</p>
        
        <!-- Contenedor Swiper -->
        <div class="swiper mySwiper px-8">
            <div class="swiper-wrapper mb-16">
                @foreach ($destacados as $destacado)
                    <div class="swiper-slide bg-white shadow-lg rounded-2xl p-6">
                        <div class="flex flex-col">
                            <a href="{{ route('producto.show', ['codigo' => $destacado->codigo]) }}">
                                <img src="{{ Storage::url($destacado->imagen_principal) }}" 
                                    alt="{{ $destacado->nombre }}" 
                                    class="object-cover rounded-2xl w-auto h-64 m-auto">
                            </a>
                            <h3 class="text-marron text-2xl font-semibold mt-4 ml-6 w-full">{{ $destacado->nombre }}</h3>
                            <p class="text-gray-600 mt-2 text-sm px-4 ml-2">{{ $destacado->descripcion }}</p>
                            <div class="mt-4 flex items-center justify-between w-full px-6">
                                <h4 class="text-marron text-2xl font-bold">{{ $destacado->precio_unidad }}€</h4>
                                <button class="bg-beig hover:bg-beigoscuro text-marron hover:text-white py-2 px-4 rounded-full">
                                    Añadir al carrito
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Flechas de navegación -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
            <!-- Paginación -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- SECCIÓN: SUSCRIPCIÓN -->
    <section class="text-center py-10 mt-8">
        <div class="bg-beig m-20 w-3/4 rounded-2xl m-auto p-8">
            <h2 class="text-4xl font-bold mb-6">Mantente en Sintonia</h2>
            <p class="text-lg text-gray-600 mb-6 mx-2">
            Suscríbete a nuestro boletín para recibir ofertas exclusivas, novedades e inspiración musical.
            </p>
            <form action="#" method="POST" class="flex justify-center items-center w-full">
                <div class="flex w-4/5 bg-white rounded-full overflow-hidden shadow-lg">
                    <input type="email" id="email" placeholder="Introduce tu e-mail..."
                        class="border-none px-4 py-2 w-full outline-none">
                    <button type="submit"
                        class="bg-marron hover:bg-naranja text-white font-bold px-6 py-2 rounded-r-full">
                        Suscribirme
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- SWIPER JS-->
    <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 1, 
            spaceBetween: 20,  
            loop: true,        
            autoplay: {
                delay: 5000, 
                disableOnInteraction: false, 
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: { slidesPerView: 2 }, 
                1024: { slidesPerView: 3 }
            }
        });
    });
    function checkLoginAndRedirect() {
        @if(session('user_type'))
            window.location.href = "{{ route('personalizar') }}";
        @else
            abrirPopup('loginPopup');
        @endif
    }
    </script>

@endsection
