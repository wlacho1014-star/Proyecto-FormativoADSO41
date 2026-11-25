<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >
    <title>@yield('titulo') | FERREAGRO TYT</title>
</head>
<body>
   <header>
        <h1>{{ $nombreProyecto }}</h1>
         <nav aria-label="Navegación principal">
         <a href="/inicio">Inicio</a>
         <a href="/nosotros">Quiénes somos</a>
         <a href="/productos">Productos</a>
         <a href="/contacto">Contacto</a>
        </nav>
    </header>
    <main>
        @yield('contenido')
    </main>
    <footer>
        <p>Proyecto formativo de desarrollo web</p>
    </footer>
</body>
</html>