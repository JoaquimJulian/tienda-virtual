@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'CRUD Admin')

@section('content')


<div class="">

    <div id="productos"></div>
    <div class="">
        <h2>Nuevo producto</h2>
        <form action="{{ route('producto.store') }}" method="post">
            @csrf
            <label for="codigo">Código:</label>
            <input type="text" id="codigo" name="codigo" class="form-control">
            
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required class="form-control">
            
            <label for="descripcion">Descripción:</label>
            <input type="text" id="descripcion" name="descripcion" required class="form-control">
            
            <label for="categoria">Categoría:</label>
            <input type="text" id="categoria" name="categoria" class="form-control">
            
            <label for="precio_unidad">Precio:</label>
            <input type="text" id="precio_unicad" name="precio_unidad" class="form-control">
            
            <label for="stock">Stock:</label>
            <input type="text" id="stock" name="stock" class="form-control">
            
            <label for="destacado">Destacado:</label>
            <input type="checkbox" id="destacado" name="destacado">
            
            <input type="submit" value="Crear producto" class="btn btn-success mt-2">
        </form>
    </div>

    <div class="me-4">
        <h2>Nueva categoría</h2>
        <form id="categoriaForm">
            @csrf
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required class="form-control">
            <input type="submit" value="Crear categoría" class="btn btn-success mt-2">
        </form>
    </div>

    <div id="categorias"></div>
</div>
@endsection

@vite(['resources/js/services/crudAdmin.js'])