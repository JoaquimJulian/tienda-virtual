<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tempo y Tono')</title> 
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body class="sm:flex relative">
    <div>
        @include ('layouts.navbar')
    </div>  

    <div>
        @include ('layouts.header')
        @yield('content')
    </div>

</body>
</html>