@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
    <h2>Bienvenido a {{ $nombreProyecto }}</h2>
    <p>Somos una empresa dedicada a la venta de productos de ferretería y suministros agropecuarios. Encuentra herramientas, materiales de construcción e insumos para el campo en un solo lugar.</p>

    <h3>Nuestras categorías</h3>
    <ul>
        @foreach ($categorias as $categoria)
            <li><a href="/productos?buscar={{ urlencode($categoria) }}">{{ $categoria }}</a></li>
        @endforeach
    </ul>

    <p><a href="/productos">Ver todo el catálogo</a></p>
@endsection