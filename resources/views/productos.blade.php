{{--
    Catálogo de productos con buscador (método GET).
    Recibe $productos (lista ya filtrada) y $buscar (texto buscado o null)
    desde la ruta /productos.
--}}
@extends('layouts.app')

@section('titulo', 'Productos')

@section('contenido')
    <div class="contenedor pagina">
        <h1 class="pagina__titulo">Catálogo de productos</h1>
        <p class="pagina__intro">Busca por nombre del producto o por categoría.</p>

        {{-- Buscador: el formulario usa GET, por eso el texto viaja en la dirección. --}}
        <form class="buscador" method="GET" action="{{ route('productos') }}">
            <div class="buscador__campo">
                <label for="buscar">Buscar producto o categoría</label>
                <input type="text" id="buscar" name="buscar" value="{{ $buscar }}">
            </div>
            <button class="boton boton--primario" type="submit">Buscar</button>
            @if ($buscar)
                <a class="buscador__limpiar" href="{{ route('productos') }}">Limpiar búsqueda</a>
            @endif
        </form>

        @if ($buscar)
            <p class="resultados">{{ count($productos) }} resultado(s) para «{{ $buscar }}».</p>
        @endif

        {{-- Tarjetas de productos; si no hay resultados se muestra un mensaje. --}}
        @if (count($productos) > 0)
            <ul class="rejilla">
                @foreach ($productos as $producto)
                    <li>
                        <article class="producto">
                            <div class="producto__marco">
                                <img class="producto__imagen"
                                     src="{{ asset('img/productos/' . $producto['imagen']) }}"
                                     alt="{{ $producto['nombre'] }}"
                                     width="200"
                                     height="200"
                                     loading="lazy"
                                     onerror="this.src='https://placehold.co/200x200?text=Sin+imagen'">
                            </div>
                            <div class="producto__cuerpo">
                                <span class="producto__categoria">{{ $producto['categoria'] }}</span>
                                <h2 class="producto__nombre">{{ $producto['nombre'] }}</h2>
                                <p class="producto__descripcion">{{ $producto['descripcion'] }}</p>
                                <p class="producto__precio">${{ number_format($producto['precio'], 0, ',', '.') }}</p>
                            </div>
                        </article>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="vacio">
                <p>No encontramos productos para «{{ $buscar }}». Prueba con otra palabra o revisa todo el catálogo.</p>
                <a class="boton boton--primario" href="{{ route('productos') }}">Ver todo el catálogo</a>
            </div>
        @endif
    </div>
@endsection
