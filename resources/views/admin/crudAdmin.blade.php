@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'CRUD Admin')

@section('content')

<div>
    <div>
        <p class="text-2xl font-bold text-center mt-4 mb-4 text-marron">Productos</p>
        <div class="w-full flex justify-center items-center mb-6 space-x-4">
    <div class="relative w-[50%]">
        <input id="busquedaProductos" 
               placeholder="Buscar producto..." 
               class="w-full px-4 py-2 rounded-full bg-gray-100 text-gray-700 focus:outline-none focus:ring-0 border-none">
        <button class="absolute right-3 top-2 text-marron hover:text-[#8B2E00]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </button>
    </div>
        <a href="{{ route('producto.create') }}" 
        class="bg-marron text-white px-4 py-2 rounded-full font-bold hover:bg-[#8B2E00] transition">
        Nuevo producto
        </a>
    </div>


        <div id="productosLista" class="w-[100%] flex justify-center overflow-x-auto">
            <div class="overflow-y-auto">
                <table id="tablaProductosLista" class="w-full">
                    <tbody id="tablaProductos" class="block overflow-y-auto w-full">
                        <!-- Los productos se insertarán aquí -->
                    </tbody>
                </table>
            </div>
        </div>

        <div id="paginacion" class="mt-4 flex justify-center">
            <!-- Los botones de paginación se agregarán aquí -->
        </div>
    </div>

    <div>
        <p class="text-2xl font-bold text-center mt-4 mb-4 text-marron">Categorias</p>
        <div>
            <div class="flex justify-center mb-4">
                <button id="btnDropdownCategoria" class="bg-marron text-white rounded-full p-2 text-center font-bold w-[200px]">
                    Nueva categoria
                </button>
            </div>
            <div id="dropdownCrearCategoria" class="hidden absolute bg-white shadow-lg rounded-lg p-4 mt-2 w-[200px]">
                <input type="text" id="inputNuevaCategoria" placeholder="Nombre" class="w-full border-b-2 border-marron focus:outline-none focus:ring-0 p-2 mb-2">
                <input type="text" id="inputNuevaCategoriaDescripcion" placeholder="Descripcion" class="w-full border-b-2 border-marron focus:outline-none focus:ring-0 p-2 mb-2 mt-2">
                
                <input type="file" id="inputNuevaCategoriaImagen" class="hidden">

                <label for="inputNuevaCategoriaImagen" class="cursor-pointer flex items-center justify-center w-full border-2 border-marron rounded-lg p-2 mb-2 mt-2 hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-marron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 5v14M5 12h14"></path>
                    </svg>
                    <span class="ml-2 text-marron font-medium">Logo</span>
                </label>

                <button id="btnCrearCategoria" class="bg-marron text-white rounded-full p-2 w-full hover:bg-marron-dark">
                    Crear
                </button>
            </div>
        </div>
        
        <div id="categoriasLista" class="flex flex-wrap justify-center mb-40">
        </div>
    </div>
</div>
@endsection

@vite(['resources/js/services/admin/crudAdmin.js'])
