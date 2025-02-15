@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'CRUD Admin')

@section('content')


<div class="flex pl-20 pr-20 pt-6 pb-6 bg-beig h-screen">
    <div class="w-2/4 flex flex-col items-center">
        <p class="font-semibold text-marron mb-3 text-xl">Productos</p>
        <div class="w-full flex items-center relative">
            <div class="flex w-3/6 h-12 bg-white rounded-full pl-6 pr-8 justify-between mx-auto">
                <input class="border-none focus:outline-none focus:ring-0 h-full w-full" placeholder="Buscar producto...">
                <button class="text-gray-400 hover:text-[#8B2E00]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
            <button class="bg-marron text-white py-2 px-4 rounded-full absolute right-8">Nuevo producto</button>
        </div>
        
    </div>

    <div class="w-2/4 flex flex-col items-center">
        <p class="font-semibold text-marron mb-3 text-xl">Categorias</p>
        <div class="w-full flex items-center relative">
            <div class="flex w-3/6 h-12 bg-white rounded-full pl-6 pr-8 justify-between mx-auto">
                <input class="border-none focus:outline-none focus:ring-0 h-full w-full" placeholder="Buscar categoria...">
                <button class="text-gray-400 hover:text-[#8B2E00]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                </button>
            </div>
            <button class="bg-marron text-white py-2 px-4 rounded-full absolute right-8">Nueva categoria</button>
        </div>
        
    </div>
</div>
@endsection

@vite(['resources/js/services/crudAdmin.js'])