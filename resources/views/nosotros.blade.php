@extends('layouts.app')

@section('titulo', 'Quiénes somos')

@section('contenido')
    <h2>Quiénes somos</h2>
    <p>{{ $nombreProyecto }} es una empresa que ofrece productos de ferretería y suministros agropecuarios para clientes de la construcción, el hogar y el campo.</p>

    <h3>Misión</h3>
    <p>Suministrar productos de calidad con atención oportuna y precios justos.</p>

    <h3>Visión</h3>
    <p>Ser una empresa reconocida en la región por su variedad, servicio y confianza.</p>

    <h3>Valores</h3>
    <ul>
        <li>Compromiso con el cliente</li>
        <li>Honestidad</li>
        <li>Calidad</li>
    </ul>
@endsection