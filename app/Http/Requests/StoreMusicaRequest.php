<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMusicaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titulo' => 'required|min:3|max:100',
            'artista' => 'required|min:3|max:100',
            'tom' => 'required|min:1|max:10',
            'youtube_link' => 'nullable|url',
            'categoria_id' => 'required|exists:categorias,id'
        ];
    }
}
