@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'Producto') <!-- Aquí defines un título específico para esta página -->

@section('content')
    <div>
        <div id="productos">
            
        </div>
    </div>
@endsection

@vite(['resources/js/public/carrito.js'])