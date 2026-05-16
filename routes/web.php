<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MusicaController;

Route::get('/', function () {
    return view('welcome');
});

// Protetendo as rotas de categorias e músicas para usuários autenticados
Route::middleware('auth')->group(function () {
    Route::resource('categorias', CategoriaController::class);
    Route::resource('musicas', MusicaController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__ . '/auth.php';
