@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'CRUD Admin')

@section('content')


<div class="flex pl-20 pr-20 pt-6 pb-6 bg-beig h-screen">
    <div class="w-2/4 flex flex-col items-center">
        <p class="font-semibold text-marron mb-3 text-xl">Productos</p>
        <div class="w-full flex items-center relative">
            <div class="flex w-3/6 h-12 bg-white rounded-full pl-6 pr-8 justify-between mx-auto">
                <input id="busquedaProductos" class="border-none focus:outline-none focus:ring-0 h-full w-full" placeholder="Buscar producto...">
                <button class="text-gray-400 hover:text-[#8B2E00]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
            <a class="bg-marron text-white py-2 px-4 rounded-full absolute right-0" href="{{ route('producto.create') }}">Nuevo producto</a>
        </div>

        <div id="productosLista" class="mt-2 w-full flex justify-center">
            <table id="tablaProductosLista" class="w-3/4 mx-auto h-auto border-separate border-spacing-y-2">
                <thead>
                    <tr class="h-auto">
                        <th class="text-marron font-semibold px-4 py-8 h-auto w-32"></th> <!-- Columna para imagen -->
                        <th class="text-marron font-semibold text-left px-4 py-8 h-auto">Nombre</th>
                        <th class="text-marron font-semibold text-left px-4 py-8 h-auto">Categoría</th>
                        <th class="text-marron font-semibold text-left px-4 py-8 h-auto">Precio</th>
                        <th class="text-marron font-semibold px-4 py-8 h-auto w-32"></th> <!-- Columna para iconos -->
                    </tr>
                </thead>
                <tbody id="tablaProductos" class="h-auto">
                    <!-- Los productos se insertarán aquí -->
                </tbody>
            </table>
        </div>
        
    </div>

    <div class="w-2/4 flex flex-col items-center">
        <p class="font-semibold text-marron mb-3 text-xl">Categorias</p>
        <div class="w-full flex items-center justify-center">
            <button class="bg-marron text-white py-2 px-4 rounded-full" id="btnDropdownCategoria">Nueva categoria</button>
            <div id="dropdownCrearCategoria" class="fixed right-8 mt-2 w-64 bg-white rounded-lg shadow-lg hidden p-6 flex gap-4">
                <input type="text" id="inputNuevaCategoria" placeholder="Nombre" class="w-full p-1 border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0">
                <button class="rounded-full py-1 px-2 bg-marron text-white" id="btnCrearCategoria">Crear</button>
            </div>
        </div>
        
        <div id="categoriasLista" class="mt-8 w-auto">
        
        </div>

    </div>
</div>
@endsection

@vite(['resources/js/services/admin/crudAdmin.js'])