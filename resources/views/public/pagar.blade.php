@extends('layouts.app')

@section('title', 'Carrito')

@section('content')
    <div class="p-4 min-h-screen bg-beige sm:flex sm:flex-col items-center">
        <div class="max-w-3xl w-full mx-auto">
            <!-- Tarjeta de crédito/débito -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="px-4 py-3 border-b flex justify-between items-center">
                    <h2 class="font-medium text-gray-800">Tarjeta de crédito/débito</h2>
                    <button class="text-2xl">−</button>
                </div>
                <div class="p-4">
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <input type="radio" id="visa" name="payment" checked class="w-4 h-4 accent-blue-600">
                            <label for="visa" class="flex-1 text-gray-700">Visa terminada en 4598</label>
                            <img src="{{ asset('images/visa.png') }}" alt="Visa" class="h-6">
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="radio" id="new_card" name="payment" class="w-4 h-4 accent-blue-600">
                            <label for="new_card" class="text-gray-700">Añadir nueva tarjeta</label>
                        </div>
                        <div class="pt-2 pb-1 border-t mt-3">
                            <div class="flex items-center text-sm text-gray-600">
                                <span class="mr-2">•••• 2345 5678 7890</span>
                                <img src="{{ asset('images/mastercard.png') }}" alt="Mastercard" class="h-5 mx-2">
                                <span class="mx-2">01/2027</span>
                                <span class="mx-2">•••</span>
                            </div>
                            <div class="text-sm text-gray-600 mt-1">
                                <span>José Antonio Pérez Domínguez</span>
                            </div>
                            <div class="mt-3">
                                <label class="flex items-center gap-2">
                                    <input type="checkbox" class="w-4 h-4 accent-blue-600" checked>
                                    <span class="text-sm text-gray-700">Guardar tarjeta para futuras compras</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- E-Wallet -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="px-4 py-3 border-b flex justify-between items-center">
                    <h2 class="font-medium text-gray-800">E-Wallet</h2>
                    <button class="text-2xl">−</button>
                </div>
                <div class="p-4">
                    <div class="grid grid-cols-4 gap-4 mb-4">
                        <div class="bg-gray-100 rounded-lg p-3 flex flex-col items-center justify-center">
                            <img src="{{ asset('images/paypal.png') }}" alt="PayPal" class="h-8 mb-2">
                            <span class="text-xs text-gray-600">PayPal</span>
                        </div>
                        <div class="bg-gray-100 rounded-lg p-3 flex flex-col items-center justify-center">
                            <img src="{{ asset('images/applepay.png') }}" alt="Apple Pay" class="h-8 mb-2">
                            <span class="text-xs text-gray-600">Apple Pay</span>
                        </div>
                        <div class="bg-gray-100 rounded-lg p-3 flex flex-col items-center justify-center">
                            <img src="{{ asset('images/googlepay.png') }}" alt="Google Pay" class="h-8 mb-2">
                            <span class="text-xs text-gray-600">Google Pay</span>
                        </div>
                        <div class="bg-gray-100 rounded-lg p-3 flex flex-col items-center justify-center">
                            <img src="{{ asset('images/paysafecard.png') }}" alt="Paysafecard" class="h-8 mb-2">
                            <span class="text-xs text-gray-600">Paysafecard</span>
                        </div>
                    </div>
                    <div class="space-y-2">
                        <input type="email" placeholder="Correo electrónico vinculado al e-wallet" class="w-full p-2 border rounded-md text-sm">
                        <input type="password" placeholder="Contraseña" class="w-full p-2 border rounded-md text-sm">
                    </div>
                </div>
            </div>

            <!-- Resumen de pago -->
            <div class="bg-white rounded-lg shadow-sm mb-6">
                <div class="px-6 py-4">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="font-medium text-gray-800">Cantidad a pagar</h2>
                        @php
                            $productos = json_decode('[{"codigo":"BA001-YA","nombre":"Yamaha Stage Custom","descripcion":"Bater\u00eda modelo Yamaha Stage Custom de alta calidad.","categoria_id":3,"precio_unidad":1800,"stock":5,"destacado":1,"imagen_principal":"imagen.png","created_at":"2025-03-20T11:56:01.000000Z","updated_at":"2025-03-20T11:56:01.000000Z","precio_total":8712,"cantidad":4},{"codigo":"BA005-GR","nombre":"Gretsch Catalina","descripcion":"Bater\u00eda modelo Gretsch Catalina de alta calidad.","categoria_id":3,"precio_unidad":2000.9,"stock":5,"destacado":1,"imagen_principal":"imagen.png","created_at":"2025-03-20T11:56:01.000000Z","updated_at":"2025-03-20T11:56:01.000000Z","precio_total":4842.178,"cantidad":2}]', true);
                            $total = 0;
                            foreach ($productos as $producto) {
                                $total += $producto['precio_total'];
                            }
                        @endphp
                        <span class="text-xl font-semibold">{{ number_format($total, 2) }}$</span>
                    </div>
                    <div class="mb-4">
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
                    <button class="w-full py-3 bg-red-900 text-white rounded-md font-medium hover:bg-red-950 transition-colors">
                        Pagar ahora
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@vite(['resources/js/public/compra.js'])