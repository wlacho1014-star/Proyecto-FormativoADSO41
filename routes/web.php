<?php

use App\Http\Controllers\InicioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/inicio');

Route::get('/inicio', [InicioController::class, 'index']);

Route::get('/nosotros', function () {
    return view('nosotros');
});

// GET: catálogo con buscador
Route::get('/productos', function (Request $request) {
    $productos = [
        ['nombre' => 'Martillo de acero 16 oz', 'categoria' => 'Herramientas', 'precio' => 28000, 'descripcion' => 'Mango antideslizante para uso rudo.', 'imagen' => 'martillo.jpg'],
        ['nombre' => 'Taladro percutor 1/2"', 'categoria' => 'Herramientas eléctricas', 'precio' => 185000, 'descripcion' => 'Potente y con velocidad variable.', 'imagen' => 'taladro.jpg'],
        ['nombre' => 'Cemento gris 50 kg', 'categoria' => 'Construcción', 'precio' => 32000, 'descripcion' => 'Uso general en obra y mampostería.', 'imagen' => 'cemento.jpg'],
        ['nombre' => 'Machete 22"', 'categoria' => 'Agropecuario', 'precio' => 24000, 'descripcion' => 'Hoja de acero para labores del campo.', 'imagen' => 'machete.jpg'],
        ['nombre' => 'Fumigadora de espalda 20 L', 'categoria' => 'Agropecuario', 'precio' => 145000, 'descripcion' => 'Para aplicar fungicidas y herbicidas.', 'imagen' => 'fumigadora.jpg'],
        ['nombre' => 'Abono orgánico 50 kg', 'categoria' => 'Insumos agrícolas', 'precio' => 55000, 'descripcion' => 'Mejora y nutre el suelo del cultivo.', 'imagen' => 'abono.jpg'],
    ];

    $buscar = $request->query('buscar');

    if ($buscar) {
        $productos = array_filter($productos, function ($p) use ($buscar) {
            return str_contains(
                mb_strtolower($p['nombre'] . ' ' . $p['categoria']),
                mb_strtolower($buscar)
            );
        });
    }

    return view('productos', ['productos' => $productos, 'buscar' => $buscar]);
});

// GET y POST: contacto
Route::get('/contacto', function () {
    return view('contacto');
});

Route::post('/contacto', function (Request $request) {
    $datos = $request->validate([
        'nombre'  => 'required|min:3',
        'correo'  => 'required|email',
        'mensaje' => 'required|min:10',
    ]);

    return back()->with('exito', 'Gracias, ' . $datos['nombre'] . '. Recibimos tu mensaje y te responderemos pronto.');
});