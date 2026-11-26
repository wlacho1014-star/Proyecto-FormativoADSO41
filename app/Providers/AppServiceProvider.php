<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

/**
 * Proveedor de servicios de la aplicación FERREAGRO TYT.
 *
 * Evidencia GA7-220501096-AA4-EV03 - Componente front-end.
 * Autor: José Wladimir Carrillo López - Ficha 3336129 (ADSO 41).
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Registra servicios de la aplicación (no se necesitan por ahora).
     */
    public function register(): void
    {
        //
    }

    /**
     * Arranca los servicios de la aplicación.
     *
     * View::share() deja la variable $nombreProyecto disponible en todas
     * las vistas, sin tener que enviarla desde cada ruta o controlador.
     */
    public function boot(): void
    {
        View::share('nombreProyecto', 'FERREAGRO TYT');
    }
}
