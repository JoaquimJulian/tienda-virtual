@extends('layouts.app')

@section('title', 'Editar Compra')

@section('content')
<div class="flex flex-col px-4 md:px-20 py-6 bg-beig min-h-screen">
    <div class="max-w-4xl mx-auto w-full">
        <h1 class="text-2xl md:text-3xl text-marron font-bold mb-6">Editar Pedido</h1>
        
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <form action="{{ route('compra.update', $compra->id) }}" method="POST" class="flex flex-col space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label for="cliente" class="text-marron font-semibold mb-1">Cliente</label>
                        <input type="text" id="cliente" name="cliente" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" 
                            value="{{ old('cliente', $comprador->nombre) }}"
                            readonly>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="precio_total" class="text-marron font-semibold mb-1">Precio Total</label>
                        <input type="text" id="precio_total" name="precio_total" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" 
                            value="{{ old('precio_total', $compra->precio_total) }}"
                            readonly>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="estado" class="text-marron font-semibold mb-1">Estado</label>
                        <select name="estado" id="estado" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" required>
                            <option value="pendiente" @selected(old('estado', $compra->estado) == 'pendiente')>Pendiente</option> 
                            <option value="enviado" @selected(old('estado', $compra->estado) == 'enviado')>Enviado</option>       
                        </select>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="fecha_compra" class="text-marron font-semibold mb-1">Fecha de compra</label>
                        <input type="date" id="fecha_compra" name="fecha_compra" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" 
                            value="{{ old('fecha_compra', $compra->fecha_compra) }}"
                            readonly>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="fecha_envio" class="text-marron font-semibold mb-1">Fecha de envío</label>
                        <input type="date" id="fecha_envio" name="fecha_envio" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" 
                            value="{{ old('fecha_envio', $compra->fecha_envio) }}">
                    </div>
                </div>
                
                <!-- Detalles de productos -->
                <div class="mt-6">
                    <h2 class="text-xl text-marron font-semibold mb-4">Productos en este pedido</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-marron text-white">
                                    <th class="p-3 text-left">Código</th>
                                    <th class="p-3 text-left">Producto</th>
                                    <th class="p-3 text-right">Precio Unitario</th>
                                    <th class="p-3 text-right">Cantidad</th>
                                    <th class="p-3 text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($compra->productos as $producto)
                                <tr class="border-b border-marron/20 hover:bg-beig/50">
                                    <td class="p-3">{{ $producto->codigo }}</td>
                                    <td class="p-3">{{ $producto->nombre }}</td>
                                    <td class="p-3 text-right">{{ number_format($producto->precio_unidad, 2) }} €</td>
                                    <td class="p-3 text-right">{{ $producto->pivot->cantidad }}</td>
                                    <td class="p-3 text-right">{{ number_format($producto->precio_unidad * $producto->pivot->cantidad, 2) }} €</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-beig/70 font-semibold">
                                    <td colspan="4" class="p-3 text-right">Total:</td>
                                    <td class="p-3 text-right">{{ number_format($compra->precio_total, 2) }} €</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                
                <div class="flex justify-between mt-6">
                    <a href="{{ route('compra.create') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition">Volver</a>
                    <button type="submit" class="bg-marron text-white py-2 px-6 rounded hover:bg-marron-dark transition cursor-pointer">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@vite(['resources/js/services/admin/editarCompra.js'])