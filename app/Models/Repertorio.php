<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repertorio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'data'
    ];

    // Definindo a relação com as músicas
    public function musicas()
    {
        return $this->belongsTo(Musica::class);
    }
}
