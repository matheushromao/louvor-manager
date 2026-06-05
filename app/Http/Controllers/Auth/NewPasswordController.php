<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\NewPasswordRequest;
use App\Services\PasswordResetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    public function __construct(private readonly PasswordResetService $passwordReset)
    {
    }

    /**
     * Exibe a tela de definição da nova senha (acessada pelo link do e-mail).
     */
    public function create(Request $request): View
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    /**
     * Efetiva a redefinição da senha a partir do token.
     */
    public function store(NewPasswordRequest $request): RedirectResponse
    {
        $status = $this->passwordReset->reset(
            $request->only('email', 'password', 'password_confirmation', 'token')
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('status', __($status));
        }

        // Token expirado/inválido ou usuário inexistente: mensagem clara e
        // orientação para solicitar um novo link.
        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
