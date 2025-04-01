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
                                        @elseif( $compra->estado == 'entregado' )
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
                            <div class="flex justify-end mt-4 border-t border-gray-200 pt-3">
                                <div class="w-1/5 text-right font-bold text-amber-900 pr-4">${{ $compra->precio_total }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection