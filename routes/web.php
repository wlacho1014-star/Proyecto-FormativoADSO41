<?php

/**
 * Rutas del sitio web público de FERREAGRO TYT.
 *
 * Evidencia GA7-220501096-AA4-EV03 - Componente front-end.
 * Autor: José Wladimir Carrillo López - Ficha 3336129 (ADSO 41).
 *
 * Cada ruta tiene un nombre (->name()) para generar los enlaces de las
 * vistas con la función route() en lugar de escribir las direcciones a mano.
 */

use App\Http\Controllers\InicioController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;

// La dirección raíz lleva a la página de inicio.
Route::redirect('/', '/inicio');

// Inicio: las categorías las prepara el controlador.
Route::get('/inicio', [InicioController::class, 'index'])->name('inicio');

// Quiénes somos: página informativa sin datos dinámicos.
Route::view('/nosotros', 'nosotros')->name('nosotros');

// Catálogo de productos (método GET).
// Si llega el parámetro "buscar", se filtra por nombre o categoría.
Route::get('/productos', function (Request $request): View {
    // Productos de referencia del catálogo.
    $productos = [
        ['nombre' => 'Martillo de acero 16 oz', 'categoria' => 'Herramientas', 'precio' => 28000, 'descripcion' => 'Mango antideslizante para uso rudo.', 'imagen' => 'martillo.jpg'],
        ['nombre' => 'Taladro percutor 1/2"', 'categoria' => 'Herramientas eléctricas', 'precio' => 185000, 'descripcion' => 'Potente y con velocidad variable.', 'imagen' => 'taladro.jpg'],
        ['nombre' => 'Cemento gris 50 kg', 'categoria' => 'Construcción', 'precio' => 32000, 'descripcion' => 'Uso general en obra y mampostería.', 'imagen' => 'cemento.jpg'],
        ['nombre' => 'Machete 22"', 'categoria' => 'Agropecuario', 'precio' => 24000, 'descripcion' => 'Hoja de acero para labores del campo.', 'imagen' => 'machete.jpg'],
        ['nombre' => 'Fumigadora de espalda 20 L', 'categoria' => 'Agropecuario', 'precio' => 145000, 'descripcion' => 'Para aplicar fungicidas y herbicidas.', 'imagen' => 'fumigadora.jpg'],
        ['nombre' => 'Abono orgánico 50 kg', 'categoria' => 'Insumos agrícolas', 'precio' => 55000, 'descripcion' => 'Mejora y nutre el suelo del cultivo.', 'imagen' => 'abono.jpg'],
    ];

    // Texto escrito en el buscador (null si no se envió nada).
    $buscar = $request->query('buscar');

    if ($buscar) {
        // Se conservan los productos cuyo nombre o categoría contienen el texto.
        $productos = array_filter($productos, function (array $producto) use ($buscar): bool {
            return str_contains(
                mb_strtolower($producto['nombre'].' '.$producto['categoria']),
                mb_strtolower($buscar)
            );
        });
    }

    return view('productos', ['productos' => $productos, 'buscar' => $buscar]);
})->name('productos');

// Contacto: la ruta GET muestra el formulario.
Route::view('/contacto', 'contacto')->name('contacto');

// Contacto: la ruta POST recibe y valida el formulario (método POST).
Route::post('/contacto', function (Request $request): RedirectResponse {
    $datos = $request->validate(
        // Reglas de validación de cada campo.
        [
            'nombre' => 'required|min:3|max:60',
            'correo' => 'required|email|max:100',
            'mensaje' => 'required|min:10|max:1000',
        ],
        // Mensajes de error en español (los mismos que usa sitio.js).
        [
            'required' => 'Escribe tu :attribute.',
            'email' => 'Escribe un correo electrónico válido.',
            'nombre.min' => 'El nombre debe tener al menos :min caracteres.',
            'mensaje.min' => 'El mensaje debe tener al menos :min caracteres.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
            'correo.max' => 'El correo no puede tener más de :max caracteres.',
            'mensaje.max' => 'El mensaje no puede tener más de :max caracteres.',
        ],
        // Nombres de los campos tal como se muestran al usuario.
        [
            'correo' => 'correo electrónico',
        ]
    );

    // Si los datos son válidos, se vuelve al formulario con un aviso de éxito.
    return redirect()
        ->route('contacto')
        ->with('exito', 'Gracias, '.$datos['nombre'].'. Recibimos tu mensaje y te responderemos pronto.');
})->name('contacto.enviar');
