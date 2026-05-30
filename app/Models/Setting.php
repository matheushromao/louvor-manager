<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    /**
     * Retorna a URL pública de um arquivo armazenado (logo, fundo, etc.),
     * ou null caso o caminho esteja vazio ou o arquivo não exista mais.
     * Garante o fallback seguro quando a imagem não está disponível.
     */
    public static function fileUrl(?string $path): ?string
    {
        if (blank($path)) {
            return null;
        }

        if (! Storage::disk('public')->exists($path)) {
            return null;
        }

        // URL relativa à raiz (ex: /storage/...) para funcionar em qualquer host/porta.
        $url = Storage::disk('public')->url($path);

        return parse_url($url, PHP_URL_PATH) ?: $url;
    }
}
