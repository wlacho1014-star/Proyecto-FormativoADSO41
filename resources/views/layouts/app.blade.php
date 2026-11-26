{{--
    Plantilla principal del sitio web de FERREAGRO TYT.
    Evidencia GA7-220501096-AA4-EV03 - Componente front-end.
    Autor: José Wladimir Carrillo López - Ficha 3336129 (ADSO 41).

    Todas las páginas heredan de esta plantilla con @extends('layouts.app') y
    rellenan las zonas @section('titulo') y @section('contenido').
    La variable $nombreProyecto se comparte desde AppServiceProvider.
--}}
@php
    // Opciones del menú: nombre de la ruta y texto que se muestra.
    $menu = [
        ['ruta' => 'inicio', 'texto' => 'Inicio'],
        ['ruta' => 'nosotros', 'texto' => 'Quiénes somos'],
        ['ruta' => 'productos', 'texto' => 'Productos'],
        ['ruta' => 'contacto', 'texto' => 'Contacto'],
    ];
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo') | {{ $nombreProyecto }}</title>
    <meta name="description" content="Ferretería y suministros agropecuarios: herramientas, materiales de construcción e insumos para el campo.">

    {{-- Tipografías: Bitter para los títulos y Source Sans 3 para el texto. --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bitter:wght@600;700&family=Source+Sans+3:wght@400;600;700&display=swap" rel="stylesheet">

    <link rel="icon" href="{{ asset('img/logo.png') }}">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}">

    {{-- Marca la página como "con JavaScript" para activar el menú desplegable. --}}
    <script>document.documentElement.classList.add('js');</script>
    <script src="{{ asset('js/sitio.js') }}" defer></script>
</head>
<body>
    <a class="salto" href="#contenido">Ir al contenido</a>

    {{-- Encabezado: logo, nombre de la empresa y menú de navegación. --}}
    <header class="encabezado">
        <div class="contenedor encabezado__interior">
            <a class="marca" href="{{ route('inicio') }}">
                <img class="marca__logo" src="{{ asset('img/logo.png') }}" alt="Logo de {{ $nombreProyecto }}" width="48" height="48">
                <span class="marca__texto">
                    <span class="marca__nombre">{{ $nombreProyecto }}</span>
                    <span class="marca__lema">Ferretería y suministros agropecuarios</span>
                </span>
            </a>

            <button class="menu__boton" type="button" aria-expanded="false" aria-controls="menu-principal">Menú</button>

            <nav class="menu" id="menu-principal" aria-label="Navegación principal">
                @foreach ($menu as $enlace)
                    <a class="menu__enlace" href="{{ route($enlace['ruta']) }}" @if (request()->routeIs($enlace['ruta'])) aria-current="page" @endif>{{ $enlace['texto'] }}</a>
                @endforeach
            </nav>
        </div>
    </header>
    <div class="franja" aria-hidden="true"></div>

    {{-- Contenido propio de cada página. --}}
    <main id="contenido">
        @yield('contenido')
    </main>

    {{-- Pie de página. --}}
    <footer class="pie">
        <div class="contenedor pie__interior">
            <div>
                <p class="pie__nombre">{{ $nombreProyecto }}</p>
                <p class="pie__texto">Proyecto formativo de desarrollo web · Ficha 3336129 (ADSO 41)</p>
            </div>
            <nav class="pie__enlaces" aria-label="Enlaces del pie de página">
                @foreach ($menu as $enlace)
                    <a href="{{ route($enlace['ruta']) }}">{{ $enlace['texto'] }}</a>
                @endforeach
            </nav>
        </div>
    </footer>
</body>
</html>
