<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Escala extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'observacao',
    ];

    protected $casts = [
        'data' => 'date',
    ];

    /**
     * Usuários (vocais) escalados para cantar no culto.
     */
    public function usuarios(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
