@extends('layouts.app')

@section('titulo', 'Contacto')

@section('contenido')
    <h2>Contáctanos</h2>

    <ul>
        <li>Correo: <a href="mailto:contacto@ferreagrotyt.com">contacto@ferreagrotyt.com</a></li>
        <li>Teléfono: <a href="tel:+576000000000">+57 600 000 0000</a></li>
        <li>Dirección: Calle 00 # 00-00, Pereira, Risaralda</li>
        <li>Horario: Lunes a viernes, 8:00 a.m. a 5:00 p.m.</li>
    </ul>

    @if (session('exito'))
        <p><strong>{{ session('exito') }}</strong></p>
    @endif

    <form method="POST" action="/contacto">
        @csrf

        <p>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}">
            @error('nombre') <span>{{ $message }}</span> @enderror
        </p>
        <p>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="{{ old('correo') }}">
            @error('correo') <span>{{ $message }}</span> @enderror
        </p>
        <p>
            <label for="mensaje">Mensaje:</label><br>
            <textarea id="mensaje" name="mensaje" rows="4">{{ old('mensaje') }}</textarea>
            @error('mensaje') <span>{{ $message }}</span> @enderror
        </p>
        <button type="submit">Enviar</button>
    </form>
@endsection