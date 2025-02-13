<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tempo y Tono')</title> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="flex flex-col min-h-screen relative">
    <header>
        @include ('layouts.header')
    </header>

    <div class="flex-grow">
        @yield('content')
    </div>

    <footer>
        @include ('layouts.footer')
    </footer>
</body>
</html>