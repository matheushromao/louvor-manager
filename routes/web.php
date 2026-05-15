<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Models\Categoria;

Route::get('/', function () {
    return view('welcome');
});

// Criando automaticamente as rotas para o CRUD de categorias
Route::resource('categorias', CategoriaController::class);

Route::get('/teste-categoria', function () {

    Categoria::create([
        'nome' => 'Música rápida'
    ]);
    return 'Categoria criada com sucesso!';
});

Route::post('/teste-store-categoria', [CategoriaController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
