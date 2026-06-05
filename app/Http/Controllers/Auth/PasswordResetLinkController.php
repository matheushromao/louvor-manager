<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\PasswordResetLinkRequest;
use App\Services\PasswordResetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function __construct(private readonly PasswordResetService $passwordReset)
    {
    }

    /**
     * Exibe a tela "esqueci minha senha".
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Solicita o envio do link de redefinição para o e-mail informado.
     */
    public function store(PasswordResetLinkRequest $request): RedirectResponse
    {
        $status = $this->passwordReset->sendResetLink($request->validated('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('status', __($status));
        }

        return back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }
}
