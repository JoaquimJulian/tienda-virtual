@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'Página de Inicio') <!-- Aquí defines un título específico para esta página -->

@section('content')
    <p class="text-center"><a href="{{ route('categoria.create') }}">Crear productos o categorías</a></p>
@endsection