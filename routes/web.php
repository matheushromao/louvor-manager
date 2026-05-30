<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MusicaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RepertorioController;
use App\Http\Controllers\EscalaController;
use App\Http\Controllers\SettingController;
use App\Models\Categoria;
use App\Models\Musica;
use App\Models\Repertorio;

Route::get('/', function () {
    return view('welcome');
});

// Rotas de visualização: qualquer usuário autenticado pode acessar
Route::middleware('auth')->group(function () {
    Route::get('categorias', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::get('musicas', [MusicaController::class, 'index'])->name('musicas.index');
    Route::get('repertorios', [RepertorioController::class, 'index'])->name('repertorios.index');

    // Escala da Semana: visualização liberada para todos os autenticados
    Route::get('escalas', [EscalaController::class, 'index'])->name('escalas.index');
    Route::get('escalas/{escala}', [EscalaController::class, 'show'])
        ->whereNumber('escala')
        ->name('escalas.show');
});

// Gestão da Escala da Semana: somente admin e vocal
Route::middleware(['auth', 'role:admin,vocal'])->group(function () {
    Route::resource('escalas', EscalaController::class)->except(['index', 'show']);
});

// Rotas protegidas por autenticação e autorização para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('categorias', CategoriaController::class)->except(['index']);
    Route::resource('musicas', MusicaController::class)->except(['index']);
    Route::resource('repertorios', RepertorioController::class)->except(['index']);
    Route::resource('users', App\Http\Controllers\UserController::class)->except(['show']);
    Route::get('/configuracoes', [SettingController::class, 'edit'])->name('settings.edit');
    Route::post('/configuracoes', [SettingController::class, 'update'])->name('settings.update');
});

// Rota para o dashboard, protegida por autenticação
Route::get('/dashboard', function () {
    $totalCategorias = Categoria::count();
    $totalMusicas = Musica::count();
    $totalRepertorios = Repertorio::count();

    // Quantidade de músicas por categoria (carregada direto do banco e
    // atualizada automaticamente conforme novos cadastros).
    $musicasPorCategoria = Categoria::withCount('musicas')
        ->orderByDesc('musicas_count')
        ->orderBy('nome')
        ->get();

    $ultimosRepertorios = Repertorio::latest()->take(5)->get();

    return view('dashboard', compact(
        'totalCategorias',
        'totalMusicas',
        'totalRepertorios',
        'musicasPorCategoria',
        'ultimosRepertorios'
    ));
})->middleware(['auth', 'admin'])->name('dashboard');

require __DIR__ . '/auth.php';
