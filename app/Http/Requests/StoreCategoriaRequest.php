<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
            'nome' => 'required|min:3|max:100',
        ];
    }

    public function messages(): array
{
    return [
        'nome.required' => 'O nome da categoria é obrigatório.',
        'nome.min' => 'O nome deve ter no mínimo 3 caracteres.',
        'nome.max' => 'O nome deve ter no máximo 100 caracteres.',
    ];
}
}
