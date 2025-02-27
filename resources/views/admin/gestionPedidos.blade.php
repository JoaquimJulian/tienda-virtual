@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'CRUD Admin')

@section('content')


<div class="flex pl-20 pr-20 pt-6 pb-6 bg-beig h-screen">
    <div class="w-2/4 flex flex-col items-center">
        <p class="font-semibold text-marron mb-3 text-xl">Pedidos</p>
        <div class="w-full flex items-center relative">
            <div class="flex w-3/6 h-12 bg-white rounded-full pl-6 pr-8 justify-between mx-auto">
                <input class="border-none focus:outline-none focus:ring-0 h-full w-full" placeholder="Buscar pedido...">
                <button class="text-gray-400 hover:text-[#8B2E00]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div id="pedidosLista" class="mt-2 w-full flex justify-center">
            <table id="tablaPedidosLista" class="w-3/4 mx-auto border-collapse h-auto">
                <thead>
                    <tr class="h-auto">
                        <th class="text-marron font-semibold text-left px-4 py-8 h-auto">Fecha</th>
                        <th class="text-marron font-semibold text-left px-4 py-8 h-auto">Cliente</th>
                        <th class="text-marron font-semibold text-left px-4 py-8 h-auto">Precio</th>
                        <th class="text-marron font-semibold px-4 py-8 h-auto w-32"></th> <!-- Columna para iconos -->
                    </tr>
                </thead>
                <tbody id="tablaPedidos" class="h-auto">
                    <!-- Los productos se insertarán aquí -->
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@endsection

