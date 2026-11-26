{{--
    Página de inicio: presentación de la empresa y categorías de productos.
    Recibe $categorias desde InicioController (cada una con nombre y descripción).
--}}
@extends('layouts.app')

@section('titulo', 'Inicio')

@section('contenido')
    {{-- Portada con mensaje principal, accesos directos y logo. --}}
    <section class="contenedor heroe">
        <div class="heroe__contenido">
            <h1 class="heroe__titulo">Todo para la obra y el campo</h1>
            <p class="heroe__texto">Somos una empresa dedicada a la venta de productos de ferretería y suministros agropecuarios. Encuentra herramientas, materiales de construcción e insumos para el campo en un solo lugar.</p>
            <div class="heroe__acciones">
                <a class="boton boton--primario" href="{{ route('productos') }}">Ver catálogo</a>
                <a class="boton boton--secundario" href="{{ route('contacto') }}">Contáctanos</a>
            </div>
        </div>
        <img class="heroe__logo" src="{{ asset('img/logo.png') }}" alt="Logo de {{ $nombreProyecto }}" width="212" height="212">
    </section>

    {{-- Categorías: cada enlace abre el catálogo filtrado por esa categoría (GET). --}}
    <section class="contenedor seccion" aria-labelledby="titulo-categorias">
        <h2 class="seccion__titulo" id="titulo-categorias">Nuestras categorías</h2>
        <ul class="categorias">
            @foreach ($categorias as $categoria)
                <li>
                    <a class="categoria" href="{{ route('productos', ['buscar' => $categoria['nombre']]) }}">
                        <span class="categoria__nombre">{{ $categoria['nombre'] }}</span>
                        <span class="categoria__detalle">{{ $categoria['descripcion'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </section>
@endsection
