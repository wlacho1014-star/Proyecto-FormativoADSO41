{{-- Página "Quiénes somos": descripción de la empresa, misión, visión y valores. --}}
@extends('layouts.app')

@section('titulo', 'Quiénes somos')

@section('contenido')
    <div class="contenedor pagina">
        <h1 class="pagina__titulo">Quiénes somos</h1>
        <p class="pagina__intro">{{ $nombreProyecto }} es una empresa que ofrece productos de ferretería y suministros agropecuarios para clientes de la construcción, el hogar y el campo.</p>

        {{-- Misión y visión en dos tarjetas. --}}
        <div class="tarjetas">
            <section class="tarjeta">
                <h2 class="tarjeta__titulo">Misión</h2>
                <p class="tarjeta__texto">Suministrar productos de calidad con atención oportuna y precios justos.</p>
            </section>
            <section class="tarjeta">
                <h2 class="tarjeta__titulo">Visión</h2>
                <p class="tarjeta__texto">Ser una empresa reconocida en la región por su variedad, servicio y confianza.</p>
            </section>
        </div>

        <h2 class="seccion__titulo">Valores</h2>
        <ul class="valores">
            <li class="valores__item">Compromiso con el cliente</li>
            <li class="valores__item">Honestidad</li>
            <li class="valores__item">Calidad</li>
        </ul>
    </div>
@endsection
