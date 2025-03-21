@extends('layouts.app')

@section('title', 'CRUD Admin')

@section('content')
<div class="flex pl-20 pr-20 pt-6 pb-6 bg-beig h-screen justify-center gap-24">
    <div class="flex">
        <form action="{{ route('producto.store') }}" method="POST" class="flex flex-col space-y-4" enctype="multipart/form-data">
            @csrf
            <div class="flex space-x-12">
                <div class="flex flex-col space-y-4 w-96">
                    <div class="flex flex-col">
                        <label for="codigo" class="text-marron font-semibold mb-1">Código</label>
                        <input type="text" id="codigo" name="codigo" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" required>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="nombre" class="text-marron font-semibold mb-1">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" required>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="descripcion" class="text-marron font-semibold mb-1">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" required>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="categoria" class="text-marron font-semibold mb-1">Categoría</label>
                        <select name="categoria_id" id="categoria" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" required>
                            <option value="" disabled selected hidden>Seleccione una categoría</option>
                        </select>
                    </div>
                    
                    <div class="flex flex-col relative">
                        <label for="precio" class="text-marron font-semibold mb-1">Precio</label>
                        <span class="absolute right-2 top-9 text-marron">€</span>
                        <input type="text" id="precio" name="precio_unidad" class="pl-6 bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" required>
                    </div>

                    <div class="flex flex-col">
                        <label for="stock" class="text-marron font-semibold mb-1">Stock</label>
                        <input type="text" id="stock" name="stock" class="bg-beig border-t-0 border-l-0 border-r-0 border-b border-marron border-b-2 focus:outline-none focus:border-marron focus:ring-0" required>
                    </div>
                    
                    <div class="flex gap-4">
                        <label for="destacado" class="text-marron font-semibold mb-1">Destacado</label>
                        <input type="checkbox" name="destacado" id="destacado" class="h-6 w-6 bg-beig border-marron border-2 rounded">
                    </div>
                </div>

                <div class="flex flex-col space-y-4">
                    <div class="flex flex-col">
                        <label for="fotografia_principal" class="text-marron font-semibold mb-1">Fotografia principal</label>
                        <div class="flex items-center">
                            <input type="file" name="fotografia_principal" id="fotografia_principal" class="hidden" />
                            <label for="fotografia_principal" class="bg-marron text-white px-4 py-2 rounded cursor-pointer hover:bg-marron-dark">
                                Elegir archivo
                            </label>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label for="fotografias_secundarias" class="text-marron font-semibold mb-1">Fotografias secundarias</label>
                        <div class="flex items-center">
                            <input type="file" name="fotografias_secundarias[]" id="fotografias_secundarias" multiple class="hidden" />
                            <label for="fotografias_secundarias" class="bg-marron text-white px-4 py-2 rounded cursor-pointer hover:bg-marron-dark">
                                Elegir archivos
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            
            <input type="submit" value="Enviar" class="bg-marron text-white py-2 rounded hover:bg-marron-dark cursor-pointer mt-4">
        </form>
    </div>
</div>
@endsection

@vite(['resources/js/services/admin/crearProducto.js'])