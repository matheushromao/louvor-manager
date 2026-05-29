<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEscalaRequest extends FormRequest
{
    /**
     * A autorização é feita pelo middleware de rota (role:admin,vocal).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Regras de validação da escala.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'data' => ['required', 'date'],
            'observacao' => ['nullable', 'string', 'max:1000'],
            'usuarios' => ['required', 'array', 'min:1'],
            // Garante que apenas usuários com a role "vocal" possam ser escalados.
            'usuarios.*' => [Rule::exists('users', 'id')->where('role', User::ROLE_VOCAL)],
        ];
    }

    /**
     * Mensagens de erro amigáveis.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'data.required' => 'Informe a data do culto.',
            'data.date' => 'Informe uma data válida.',
            'observacao.max' => 'A observação não pode ultrapassar 1000 caracteres.',
            'usuarios.required' => 'Selecione ao menos um vocal para a escala.',
            'usuarios.min' => 'Selecione ao menos um vocal para a escala.',
            'usuarios.*.exists' => 'Apenas usuários com a função "vocal" podem ser escalados.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'data' => 'data do culto',
            'observacao' => 'observação',
            'usuarios' => 'vocais',
        ];
    }
}
