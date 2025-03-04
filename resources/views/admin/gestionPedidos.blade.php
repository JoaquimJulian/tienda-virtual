@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'CRUD Admin')

@section('content')

<div class="hidden text-green-500 text-yellow-400 transition-all duration-300 ease-in-out transform hover:scale-105"></div>
<div class="flex pl-20 pr-20 pt-6 pb-6 bg-beig h-screen justify-center">
    <div class="w-2/4 flex flex-col items-center">
        <p class="font-semibold text-marron mb-3 text-xl">Pedidos</p>
        <div class="w-full flex items-center relative">
            <div class="flex w-3/6 h-12 bg-white rounded-full pl-6 pr-8 justify-between mx-auto">
                <input id="busquedaPedidos" class="border-none focus:outline-none focus:ring-0 h-full w-full" placeholder="Buscar pedido...">
                <button class="text-gray-400 hover:text-[#8B2E00]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
            <div>
                <select name="estado" id="filtroEstado" class="border-none rounded">
                    <option value="" disabled selected hidden class="text-green-400">Estado</option>
                    <option value="no-estado">Todos</option>
                    <option value="enviado">Enviado</option>
                    <option value="pendiente">Pendiente</option>
                </select>
                <select name="cliente" id="filtroCliente" class="border-none rounded">
                    <option value="" disabled selected hidden>Cliente</option>
                    <option value="no-cliente">Todos</option>
                    @foreach($compradores as $comprador)
                        <option value="{{ $comprador->id }}">
                            {{ $comprador->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="pedidosLista" class="mt-2 w-full flex justify-center">
            <table id="tablaPedidosLista" class="w-full mx-auto h-auto border-separate border-spacing-y-2">
                <thead>
                    <tr class="h-auto">
                        <th class="text-marron font-semibold text-left px-4 py-8 w-1/3 text-center">Fecha de compra</th>
                        <th class="text-marron font-semibold text-left px-4 py-8 w-1/3 text-center">Cliente</th>
                        <th class="text-marron font-semibold text-left px-4 py-8 w-1/3 text-center">Estado</th>
                    </tr>
                </thead>
                <tbody id="tablaPedidos" class="h-auto ">
                    <!-- Los pedidos se insertarán aquí -->
                </tbody>
            </table>
        </div>
        
    </div>
</div>
@endsection

@vite(['resources/js/services/admin/gestionPedidos.js'])