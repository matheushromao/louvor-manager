<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Musica;
use App\Models\Categoria;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMusicas = Musica::count();

        $totalCategorias = Categoria::count();

        $totalUsuarios = User::count();

        return view(
            'dashboard',
            compact(
                'totalMusicas',
                'totalCategorias',
                'totalUsuarios'
            )
        );
    }
}