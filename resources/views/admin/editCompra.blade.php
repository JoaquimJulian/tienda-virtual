@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'CRUD Admin')

@section('content')
<div class="flex pl-20 pr-20 pt-6 pb-6 bg-beig h-screen justify-center gap-24">
    <div class="flex">
        <form action="{{ route('compra.update', $compra->id) }}" method="POST" class="flex flex-col space-y-4">
            @csrf
            @method('PUT')
            <div class="flex flex-col">
                <label for="cliente" class="text-marron font-semibold mb-1">Cliente</label>
                <input type="text" id="cliente" name="cliente" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" 
                    value="{{ old('cliente', $comprador->nombre) }}"
                    readonly>
            </div>
            
            <div class="flex flex-col">
                <label for="precio_total" class="text-marron font-semibold mb-1">Precio</label>
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
                value="{{ old('compra', $compra->fecha_compra) }}"
                readonly>
            </div>
            
            <div class="flex flex-col">
                <label for="fecha_envio" class="text-marron font-semibold mb-1">Fecha de envio</label>
                <input type="date" id="fecha_envio" name="fecha_envio" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" 
                value="{{ old('compra', $compra->fecha_envio) }}"
                >
            </div>

            <input type="submit" value="Guardar Cambios" class="bg-marron text-white py-2 rounded hover:bg-marron-dark cursor-pointer mt-4">
        </form>
    </div>
</div>
@endsection

@vite(['resources/js/services/admin/editarCompra.js'])