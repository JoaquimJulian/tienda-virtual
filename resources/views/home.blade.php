@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'Página de Inicio') <!-- Aquí defines un título específico para esta página -->

@section('content')
    <div class="bg-beig">
        <p class="text-center"><a href="{{ route('categoria.create') }}">Crud Admin</a></p>
    </div>
@endsection