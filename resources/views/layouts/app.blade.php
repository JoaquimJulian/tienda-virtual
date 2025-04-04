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
