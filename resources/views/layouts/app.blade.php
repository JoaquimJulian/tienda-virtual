<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tempo y Tono')</title> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css">
    
    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="flex flex-col min-h-screen">

    <header class="sticky top-0 z-50 bg-white">
        @include ('layouts.header')
    </header>

    <!-- Mensaje de error temporal -->
    @if (session('error'))
    <div id="error-message" class="fixed top-20 left-0 right-0 mx-auto w-full max-w-md bg-red-100 border-l-4 border-red-500 text-red-700 p-4 z-50">
        <div class="flex items-center">
            <div class="py-1">
                <svg class="w-6 h-6 mr-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div>
                <p class="font-medium">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    
    <script>
        // Ocultar mensaje después de 3 segundos
        setTimeout(function() {
            const errorMessage = document.getElementById('error-message');
            if (errorMessage) {
                errorMessage.style.transition = 'opacity 0.5s ease';
                errorMessage.style.opacity = '0';
                setTimeout(function() {
                    errorMessage.remove();
                }, 500);
            }
        }, 3000);
    </script>
    @endif

    <!-- Contenedor principal del contenido -->
    <main class="flex-grow bg-beigclaro">
        @yield('content')
    </main>
    
    <!-- Footer al final de la página -->
    <footer class="bg-white">
        @include ('layouts.footer')
    </footer>

    <!-- POPUPS -->
    <x-popup-login />
    <x-popup-registro />
    <x-popup-anadirTarjeta />
    <x-popup-dragAndDrop />
    <x-popup-alertaStock />
    <x-popup-telRegistrado />
    <x-popup-telEmailRegistrado />
    <x-popup-emailRegistrado />


    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
            var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
            s1.async=true;
            s1.src='https://embed.tawk.to/67e52f4a4a9eca190b85dffa/1inbk1f97';
            s1.charset='UTF-8';
            s1.setAttribute('crossorigin','*');
            s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

</body>
</html>