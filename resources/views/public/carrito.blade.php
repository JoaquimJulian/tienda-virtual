@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
    <div class="p-4 min-h-screen bg-beig sm:flex sm:flex-col items-center">
        <h1 class="text-center text-xl font-medium text-amber-900 mb-4">Cesta</h1>
        
        <div id="productos" class="flex flex-col gap-3 mb-4 sm:w-2/4">
            <!-- Products will be loaded here dynamically -->
        </div>
        
        <div id="resumen" class="bg-white p-4 rounded-md mt-2 sm:w-2/4">
            <!-- Summary will be generated here -->
        </div>
        
        <div class="mt-4 sm:w-2/4 flex">
            @if(session('user_type') === 'comprador')
                <button id="procederAlPago" class="bg-marron hover:bg-red-950 transition-colors text-white py-2 px-6 rounded-md text-center w-full">PROCEDER AL PAGO</button>
            @else
                <button onclick="abrirPopup('loginPopup')" class="bg-marron hover:bg-red-950 text-white py-2 px-6 rounded-md text-center w-full">INICIE SESION PARA PROCEDER AL PAGO</button>
            @endif
        </div>

    </div>
@endsection

<script>
    var userType = "{{ session('user_type') }}";
    var userId = "{{ session('comprador_id') }}";
</script>

@vite(['resources/js/public/carrito.js'])