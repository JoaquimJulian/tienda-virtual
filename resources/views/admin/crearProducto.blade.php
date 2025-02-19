@extends('layouts.app') <!-- Aquí extiendes tu layout principal -->

@section('title', 'CRUD Admin')

@section('content')
<p>crear productos</p>
@endsection

@vite(['resources/js/services/crudAdmin.js'])