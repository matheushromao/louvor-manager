<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// HasFactory é usado para criar fábricas de teste para o modelo
class Categoria extends Model
{
    use HasFactory;

    // Permite a atribuição em massa do campo 'nome'
    protected $fillable = [
        'nome',
    ];
}
