@extends('layouts.app')

@section('title', 'Carrito')
<script src="https://js.stripe.com/v3/"></script>
@section('content')

@php
    $total = 0;
    foreach ($productos as $producto) {
        $total += $producto['precio_total'];
    }
    $total = round($total, 2);
@endphp
    <div class="p-4 min-h-screen bg-beige flex flex-col items-center">
        <!-- Tarjeta de crédito/débito -->
        <div class="bg-white rounded-lg shadow-sm mb-6 sm:w-1/2 h:1/4">
            <div class="px-4 py-3 border-b flex justify-between items-center">
                <h2 class="font-medium text-gray-800">Tarjeta de crédito/débito</h2>
                <button class="text-2xl">−</button>
            </div>
            <div class="p-4 bg-gray-50">
                <div class="space-y-3 flex flex-col p-3 pb-0 justify-center">
                    <form id="payment-form">
                        @csrf
                        <div>
                            <label for="card-element">Detalles de la tarjeta</label>
                            <div id="card-element" class="mt-2">
                                <!-- Elemento de Stripe donde se monta el campo de la tarjeta -->
                            </div>
                        </div>
                        <input type="hidden" name="total" value="{{ $total }}">
                        <input type="hidden" name="productos" value="{{ $productos }}">
                        <button type="submit" class="py-2 w-1/4 bg-marron text-white rounded-md font-medium hover:bg-red-950 transition-colors text-lg mt-4">Pagar</button>
                    </form>
                </div>
            </div>
        </div>  
    </div>
@endsection

<script>
    var stripe = Stripe('{{ config('services.stripe.key') }}');  // Asegúrate de usar la clave correcta aquí
    var rutaApp = "{{ route('app') }}";
    var rutaFuncionPagar = '{{ route("stripe.payment") }}';
</script>

@vite(['resources/js/public/compra.js'])