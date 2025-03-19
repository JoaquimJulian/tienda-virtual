@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
    <div class="container mx-auto p-4 min-h-screen bg-beig">
        <h1 class="text-center text-xl font-medium text-amber-900 mb-4">Cesta</h1>
        
        <div id="productos" class="flex flex-col gap-3 mb-4">
            <!-- Products will be loaded here dynamically -->
        </div>
        
        <div id="resumen" class="bg-white p-4 rounded-md mt-2">
            <!-- Summary will be generated here -->
        </div>
        
        <div class="mt-4 flex justify-center">
            <button id="btnContinuar" class="bg-amber-900 text-white py-2 px-6 rounded-md text-center w-full">CONTINUAR</button>
        </div>
    </div>
@endsection

<script>
    var userType = "{{ session('user_type') }}";
    var userId = "{{ session('comprador_id') }}";
</script>

@vite(['resources/js/public/carrito.js'])