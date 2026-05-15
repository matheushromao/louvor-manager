<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Musica extends Model
{
    protected $fillable = ['titulo', 'artista', 'tom', 'categoria_id'];

    // Definindo a relação com a categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
