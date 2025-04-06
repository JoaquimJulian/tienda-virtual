@extends('layouts.app')

@section('title', 'CRUD Admin')

@section('content')
<div class="flex flex-col items-center px-6 py-6 bg-beig min-h-screen">
    <div class="w-full max-w-2xl">
        <form action="{{ route('producto.store') }}" method="POST" class="flex flex-col space-y-4" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md-grid-cols-2 gap-6">
                <div class="flex flex-col space-y-4">
                    <div class="flex flex-col">
                        <label for="codigo" class="text-marron font-semibold mb-1">Código</label>
                        <input type="text" id="codigo" name="codigo" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" pattern="[A-Za-z]{2}\d{3}-[A-Za-z]{2}"  title="Formato: AA000-AA" placeholder="AA000-AA" required>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="nombre" class="text-marron font-semibold mb-1">Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="descripcion" class="text-marron font-semibold mb-1">Descripción</label>
                        <input type="text" id="descripcion" name="descripcion" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="categoria" class="text-marron font-semibold mb-1">Categoría</label>
                        <select name="categoria_id" id="categoria" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                            <option value="" disabled selected hidden>Seleccione una categoría</option>
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="flex flex-col relative">
                        <label for="precio" class="text-marron font-semibold mb-1">Precio</label>
                        <span class="absolute right-4 top-10 text-marron">€</span>
                        <input type="text" id="precio" name="precio_unidad" class="pl-6 bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                    </div>

                    <div class="flex flex-col">
                        <label for="stock" class="text-marron font-semibold mb-1">Stock</label>
                        <input type="text" id="stock" name="stock" class="bg-beig border-b-2 border-marron focus:outline-none focus:border-marron focus:ring-0 p-2" required>
                    </div>
                </div>

                <div class="flex flex-col space-y-4">
                    <div class="flex gap-4 items-center">
                        <label for="destacado" class="text-marron font-semibold">Destacado</label>
                        <input type="checkbox" name="destacado" id="destacado" class="h-6 w-6 border-marron border-2 rounded">
                    </div>

                    <div class="flex flex-col">
                        <label for="fotografia_principal" class="text-marron font-semibold mb-1">Fotografía principal</label>
                        <input type="file" name="fotografia_principal" id="fotografia_principal" class="hidden" required/>
                        <label for="fotografia_principal" class="bg-marron text-white px-4 py-2 rounded cursor-pointer hover:bg-marron-dark text-center">Elegir archivo</label>
                    </div>

                    <div class="flex flex-col">
                        <label for="fotografias_secundarias" class="text-marron font-semibold mb-1">Fotografías secundarias</label>
                        <input type="file" name="fotografias_secundarias[]" id="fotografias_secundarias" multiple class="hidden" />
                        <label for="fotografias_secundarias" class="bg-marron text-white px-4 py-2 rounded cursor-pointer hover:bg-marron-dark text-center">Elegir archivos</label>
                    </div>
                </div>
            </div>
            
            <input type="submit" value="Enviar" class="bg-marron text-white py-2 px-4 rounded hover:bg-marron-dark cursor-pointer w-full text-center">
        </form>
    </div>
</div>
@endsection

@vite(['resources/js/services/admin/crearProducto.js'])