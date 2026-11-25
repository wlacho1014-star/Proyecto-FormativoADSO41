@extends('layouts.app')

@section('titulo', 'Productos')

@section('contenido')
    <h2>Nuestros productos</h2>

    <section>
        @foreach ($productos as $producto)
            <article>
                <img src="{{ asset('img/productos/' . $producto['imagen']) }}"
                alt="{{ $producto['nombre'] }}"
                width="200"
                onerror="this.src='https://placehold.co/200x200?text=Sin+imagen'">
                <h3>{{ $producto['nombre'] }}</h3>
                <p>{{ $producto['descripcion'] }}</p>
                <p><strong>${{ number_format($producto['precio'], 0, ',', '.') }}</strong></p>
            </article>
        @endforeach
    </section>
@endsection