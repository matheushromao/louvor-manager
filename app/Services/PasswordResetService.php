<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

/**
 * Concentra as regras do fluxo de recuperação de senha (envio do link e
 * redefinição), mantendo os controllers responsáveis apenas por requisição
 * e resposta. Retorna as constantes de status do broker do Laravel para que
 * o controller decida a resposta/HTTP apropriada.
 */
class PasswordResetService
{
    /**
     * Envia o e-mail com o link de redefinição.
     *
     * @return string Uma das constantes Password::RESET_LINK_SENT / RESET_THROTTLED / INVALID_USER
     */
    public function sendResetLink(string $email): string
    {
        return Password::sendResetLink(['email' => $email]);
    }

    /**
     * Redefine a senha a partir do token recebido por e-mail. A senha é
     * atribuída em texto puro e criptografada pelo cast "hashed" do model.
     *
     * @param  array<string, string>  $credentials  token, email, password, password_confirmation
     * @return string Uma das constantes Password::PASSWORD_RESET / INVALID_TOKEN / INVALID_USER
     */
    public function reset(array $credentials): string
    {
        return Password::reset($credentials, function (User $user, string $password) {
            $user->forceFill([
                'password' => $password,
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));
        });
    }
}
