<?php

namespace App\Http\Controllers;

class InicioController extends Controller
{
    public function index()
    {
        $categorias = ['Herramientas', 'Construcción', 'Agropecuario', 'Insumos agrícolas'];

        return view('inicio', ['categorias' => $categorias]);
    }
}