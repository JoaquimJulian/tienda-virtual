<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tempo y Tono')</title> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300..700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col min-h-screen">
    <header>
        @include ('layouts.header')
    </header>

    <div class="flex-grow">
        @yield('content')
    </main>
    
    <footer>
        @include ('layouts.footer')
    </footer>

    <!-- POPUPS -->
    <x-popup-login />
    <x-popup-registro />
</body>
</html>