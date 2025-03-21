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
</body>
</html>
