@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
    <div class="p-4 min-h-screen bg-beige">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col md:flex-row md:gap-6">
                <!-- Columna izquierda: Tarjeta y e-wallet -->
                <div class="md:w-3/5 mb-6 md:mb-0">
                    <!-- Tarjeta de crédito/débito -->
                    <div class="bg-white rounded-lg shadow-sm mb-6">
                        <div class="px-4 py-3 border-b flex justify-between items-center">
                            <h2 class="font-medium text-gray-800">Tarjeta de crédito/débito</h2>
                            <button class="text-2xl">−</button>
                        </div>
                        <div class="p-4 bg-gray-50">
                            <div class="space-y-3">
                                <div id="tarjetasGuardadas">

                                </div>

                                <div class="flex items-center gap-2 bg-gray-100 p-3 rounded-md">
                                    <button onclick="abrirPopup('anadirTarjetaPopup')" class="text-gray-700">Añadir nueva tarjeta</button>
                                </div>

                                <div class="pt-3 pb-2 border-t mt-3" id="tarjetaActual">
                                    <p><strong>Nombre del Titular:</strong> {{ session('tarjeta')['nombre'] }}</p>
                                    <p><strong>Número de Tarjeta:</strong> **** **** **** {{ substr(session('tarjeta')['numero'], -4) }}</p>
                                    <p><strong>Fecha de Expiración:</strong> {{ session('tarjeta')['fechaExpiracion'] }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- E-Wallet -->
                    <div class="bg-white rounded-lg shadow-sm">
                        <div class="px-4 py-3 border-b flex justify-between items-center">
                            <h2 class="font-medium text-gray-800">E-Wallet</h2>
                            <button class="text-2xl">−</button>
                        </div>
                        <div class="p-4 bg-gray-50">
                            <div class="grid grid-cols-4 gap-4 mb-4">
                                <div class="bg-white rounded-lg p-3 flex flex-col items-center justify-center">
                                    <img src="{{ asset('images/paypal.png') }}" alt="PayPal" class="h-8 mb-2">
                                    <span class="text-xs text-gray-600">PayPal</span>
                                </div>
                                <div class="bg-white rounded-lg p-3 flex flex-col items-center justify-center">
                                    <img src="{{ asset('images/applepay.png') }}" alt="Apple Pay" class="h-8 mb-2">
                                    <span class="text-xs text-gray-600">Apple Pay</span>
                                </div>
                                <div class="bg-white rounded-lg p-3 flex flex-col items-center justify-center">
                                    <img src="{{ asset('images/googlepay.png') }}" alt="Google Pay" class="h-8 mb-2">
                                    <span class="text-xs text-gray-600">Google Pay</span>
                                </div>
                                <div class="bg-white rounded-lg p-3 flex flex-col items-center justify-center">
                                    <img src="{{ asset('images/paysafecard.png') }}" alt="Paysafecard" class="h-8 mb-2">
                                    <span class="text-xs text-gray-600">Paysafecard</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Columna derecha: Resumen y pago -->
                <div class="md:w-2/5">
                    <!-- Resumen de pago -->
                    <div class="bg-white rounded-lg shadow-sm sticky top-4">
                        <div class="px-6 py-6">
                            <div class="flex justify-between items-center mb-6">
                                <h2 class="text-xl font-medium text-gray-800">Cantidad a pagar</h2>
                                @php
                                    $productos = json_decode('[{"codigo":"BA001-YA","nombre":"Yamaha Stage Custom","descripcion":"Bater\u00eda modelo Yamaha Stage Custom de alta calidad.","categoria_id":3,"precio_unidad":1800,"stock":5,"destacado":1,"imagen_principal":"imagen.png","created_at":"2025-03-20T11:56:01.000000Z","updated_at":"2025-03-20T11:56:01.000000Z","precio_total":8712,"cantidad":4},{"codigo":"BA005-GR","nombre":"Gretsch Catalina","descripcion":"Bater\u00eda modelo Gretsch Catalina de alta calidad.","categoria_id":3,"precio_unidad":2000.9,"stock":5,"destacado":1,"imagen_principal":"imagen.png","created_at":"2025-03-20T11:56:01.000000Z","updated_at":"2025-03-20T11:56:01.000000Z","precio_total":4842.178,"cantidad":2}]', true);
                                    $total = 0;
                                    foreach ($productos as $producto) {
                                        $total += $producto['precio_total'];
                                    }
                                @endphp
                                <span class="text-xl font-semibold">{{ number_format($total, 2) }}$</span>
                            </div>
                            <div class="mb-6">
                                <label class="flex items-start gap-2">
                                    <input type="checkbox" class="w-4 h-4 mt-1 accent-blue-600">
                                    <span class="text-sm text-gray-700">
                                        Al marcar, ha leído y acepta nuestros 
                                        <a href="#" class="text-blue-600">términos de servicio</a>, 
                                        <a href="#" class="text-blue-600">Política de reembolso</a>, 
                                        <a href="#" class="text-blue-600">Devolución y Cancelación</a> y 
                                        <a href="#" class="text-blue-600">Política de privacidad</a>.
                                    </span>
                                </label>
                            </div>
                            <button class="w-full py-3 bg-marron text-white rounded-md font-medium hover:bg-red-950 transition-colors text-lg">
                                Pagar ahora
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@vite(['resources/js/public/compra.js'])