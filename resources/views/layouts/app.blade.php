<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tempo y Tono')</title> 
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="sm:flex">
    <div class="sm:fixed">
        @include ('layouts.navbar')
    </div>  

    <div class="flex flex-col w-full sm:ml-[100px]">
        @include ('layouts.header')
        <div class="h-full">
            @yield('content')
        </div>
    </div>

</body>
</html>