@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'Producto') <!-- Aquí defines un título específico para esta página -->

@section('content')
    <div class="w-full bg-beig p-16 flex flex-col justify-center gap-4">
        <h1 class="text-marron font-bold text-xl text-center">{{ $producto->nombre }}</h1>
        <div class="p-4 bg-white rounded-xl">
            <div>
                <img class="rounded-xl" src="{{ Storage::url($producto->imagen_principal) }}" alt="">
            </div>
            <div>
                <img src="" alt="">
                <img src="" alt="">
                <img src="" alt="">
                <img src="" alt="">
            </div>
        </div>
    </div>        
@endsection