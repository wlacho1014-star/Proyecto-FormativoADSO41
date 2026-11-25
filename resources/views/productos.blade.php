@extends('layouts.app')

@section('titulo', 'Productos')

@section('contenido')
    <h2>Catálogo de productos</h2>

    <form method="GET" action="/productos">
        <label for="buscar">Buscar producto o categoría:</label>
        <input type="text" id="buscar" name="buscar" value="{{ $buscar }}">
        <button type="submit">Buscar</button>
        <a href="/productos">Limpiar</a>
    </form>

    <section>
        @forelse ($productos as $producto)
            <article>
                <img src="{{ asset('img/productos/' . $producto['imagen']) }}"
                     alt="{{ $producto['nombre'] }}"
                     width="200"
                     onerror="this.src='https://placehold.co/200x200?text=Sin+imagen'">
                <h3>{{ $producto['nombre'] }}</h3>
                <p><em>{{ $producto['categoria'] }}</em></p>
                <p>{{ $producto['descripcion'] }}</p>
                <p><strong>${{ number_format($producto['precio'], 0, ',', '.') }}</strong></p>
            </article>
        @empty
            <p>No se encontraron productos para "{{ $buscar }}".</p>
        @endforelse
    </section>
@endsection