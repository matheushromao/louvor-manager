<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AcceptCodeOfConductRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Qualquer usuário autenticado pode aceitar o próprio termo.
        return $this->user() !== null;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'accept' => ['accepted'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'accept.accepted' => 'Você precisa marcar a caixa para concordar com as boas condutas de uso.',
        ];
    }
}
