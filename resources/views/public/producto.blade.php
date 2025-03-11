@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'Sobre nosotros') <!-- Aquí defines un título específico para esta página -->

@section('content')
    <div class="w-full bg-beig p-16 flex justify-center">
        <h1>{{ $producto->nombre }}</h1>
    </div>        
@endsection