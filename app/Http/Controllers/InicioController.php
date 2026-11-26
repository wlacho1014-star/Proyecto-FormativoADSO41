<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Controlador de la página de inicio de FERREAGRO TYT.
 *
 * Evidencia GA7-220501096-AA4-EV03 - Componente front-end.
 * Autor: José Wladimir Carrillo López - Ficha 3336129 (ADSO 41).
 */
class InicioController extends Controller
{
    /**
     * Muestra la página de inicio con las categorías de productos.
     *
     * Cada categoría tiene un nombre (que también se usa como texto de
     * búsqueda en el catálogo) y una descripción corta.
     */
    public function index(): View
    {
        $categorias = [
            ['nombre' => 'Herramientas', 'descripcion' => 'Manuales y eléctricas para cada trabajo.'],
            ['nombre' => 'Construcción', 'descripcion' => 'Cemento y materiales para la obra.'],
            ['nombre' => 'Agropecuario', 'descripcion' => 'Equipos y herramientas para el campo.'],
            ['nombre' => 'Insumos agrícolas', 'descripcion' => 'Abonos y productos para el cultivo.'],
        ];

        return view('inicio', ['categorias' => $categorias]);
    }
}
