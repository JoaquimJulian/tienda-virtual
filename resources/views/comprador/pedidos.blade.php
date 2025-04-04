@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
<div class="flex flex-col items-center px-6 py-8 bg-amber-50 min-h-screen">
    <div class="w-full max-w-3xl">
        <h1 class="text-3xl font-bold mb-6 text-amber-800">Mis Pedidos</h1>

        @if ($compras->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <p class="text-gray-600">No tienes pedidos registrados.</p>
            </div>
        @else
            <div class="space-y-6">
                @foreach ($compras as $compra)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="bg-amber-100 p-4 border-b border-amber-200">
                            <div class="flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-amber-900">Pedido #{{ $compra->id }}</h3>
                                <div class="flex gap-6">
                                    <div class="flex">
                                        <p class="text-sm text-gray-600 mr-2">Estado del pedido:</p>
                                        @if( $compra->estado == 'pendiente' )
                                            <p class="text-sm text-yellow-500">Pendiente</p>
                                        @elseif( $compra->estado == 'enviado' )
                                            <p class="text-sm text-green-500">Entregado</p>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-600">{{ $compra->fecha_compra }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead>
                                        <tr class="border-b border-gray-200">
                                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-600 w-2/5">Producto</th>
                                            <th class="py-2 px-4 text-center text-sm font-medium text-gray-600 w-1/5">Cantidad</th>
                                            <th class="py-2 px-4 text-center text-sm font-medium text-gray-600 w-1/5">Precio</th>
                                            <th class="py-2 px-4 text-right text-sm font-medium text-gray-600 w-1/5">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($compra->productos as $producto)
                                            <tr class="border-b border-gray-100 hover:bg-gray-50">
                                                <td class="py-3 px-4 text-left">{{ $producto->nombre }}</td>
                                                <td class="py-3 px-4 text-center">{{ $producto->pivot->cantidad }}</td>
                                                <td class="py-3 px-4 text-center">${{ $producto->precio_unidad }}</td>
                                                <td class="py-3 px-4 text-right font-medium">${{ $producto->pivot->cantidad * $producto->precio_unidad }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Total separado de la tabla pero con el mismo ancho -->
                            <div class="flex justify-between mt-4 border-t border-gray-200 pt-3">
                                <button data-id="{{ $compra->id }}" class="descargarFacturaBtn text-white bg-marron hover:bg-[#5A1D0E] px-4 py-2 rounded-md text-sm font-medium flex items-center transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3V10" />
                                    </svg>
                                    Descargar Factura
                                </button>
                                <div class="text-right font-bold text-amber-900 pr-4">${{ $compra->precio_total }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

@vite(['resources/js/comprador/pedidos.js'])