<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MusicaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RepertorioController;

Route::get('/', function () {
    return view('welcome');
});

// Rotas protegidas por autenticação para usuários comuns
Route::middleware('auth')->group(function () {
    Route::get('categorias', [CategoriaController::class, 'index']) -> name('categorias.index');
    Route::get('musicas', [MusicaController::class, 'index']) -> name('musicas.index');
});

// Rotas protegidas por autenticação e autorização para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categorias', CategoriaController::class)-> except(['index']);
    Route::resource('musicas', MusicaController::class) -> except(['index']);
    Route::resource('repertorios', RepertorioController::class);
});

// Rota para o dashboard, protegida por autenticação
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
