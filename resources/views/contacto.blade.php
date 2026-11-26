{{--
    Página de contacto: datos de la empresa y formulario (método POST).
    El formulario lleva data-validar para que sitio.js lo valide en el navegador;
    el servidor valida de nuevo en la ruta POST /contacto.
--}}
@extends('layouts.app')

@section('titulo', 'Contacto')

@section('contenido')
    <div class="contenedor pagina">
        <h1 class="pagina__titulo">Contáctanos</h1>
        <p class="pagina__intro">Escríbenos y te responderemos pronto.</p>

        {{-- Aviso de éxito que llega desde la ruta POST. --}}
        @if (session('exito'))
            <p class="aviso aviso--exito" role="status">{{ session('exito') }}</p>
        @endif

        <div class="contacto">
            {{-- Datos de contacto de referencia. --}}
            <dl class="datos">
                <div>
                    <dt class="datos__termino">Correo</dt>
                    <dd class="datos__valor"><a href="mailto:contacto@ferreagrotyt.com">contacto@ferreagrotyt.com</a></dd>
                </div>
                <div>
                    <dt class="datos__termino">Teléfono</dt>
                    <dd class="datos__valor"><a href="tel:+576000000000">+57 600 000 0000</a></dd>
                </div>
                <div>
                    <dt class="datos__termino">Dirección</dt>
                    <dd class="datos__valor">Calle 00 # 00-00, Pereira, Risaralda</dd>
                </div>
                <div>
                    <dt class="datos__termino">Horario</dt>
                    <dd class="datos__valor">Lunes a viernes, 8:00 a.m. a 5:00 p.m.</dd>
                </div>
            </dl>

            {{-- Formulario: @csrf agrega el token de seguridad que exige Laravel. --}}
            <form class="formulario" method="POST" action="{{ route('contacto.enviar') }}" data-validar novalidate>
                @csrf
                <h2 class="formulario__titulo">Envíanos un mensaje</h2>

                <div class="campo @error('nombre') campo--invalido @enderror">
                    <label class="campo__etiqueta" for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" autocomplete="name" required aria-describedby="nombre-error">
                    <p class="campo__error" id="nombre-error" role="alert">@error('nombre'){{ $message }}@enderror</p>
                </div>

                <div class="campo @error('correo') campo--invalido @enderror">
                    <label class="campo__etiqueta" for="correo">Correo electrónico</label>
                    <input type="email" id="correo" name="correo" value="{{ old('correo') }}" autocomplete="email" required aria-describedby="correo-error">
                    <p class="campo__error" id="correo-error" role="alert">@error('correo'){{ $message }}@enderror</p>
                </div>

                <div class="campo @error('mensaje') campo--invalido @enderror">
                    <label class="campo__etiqueta" for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="5" required aria-describedby="mensaje-error">{{ old('mensaje') }}</textarea>
                    <p class="campo__error" id="mensaje-error" role="alert">@error('mensaje'){{ $message }}@enderror</p>
                </div>

                <button class="boton boton--primario" type="submit">Enviar mensaje</button>
            </form>
        </div>
    </div>
@endsection
