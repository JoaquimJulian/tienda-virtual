@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'Página de Inicio') <!-- Aquí defines un título específico para esta página -->

@section('content')
    <p class="text-center"><a href="{{ route('categoria.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-lg">Crear productos o categorías</a></p>
@endsection