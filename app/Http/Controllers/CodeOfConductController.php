<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptCodeOfConductRequest;
use App\Services\CodeOfConductService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CodeOfConductController extends Controller
{
    public function __construct(private readonly CodeOfConductService $codeOfConduct)
    {
    }

    /**
     * Exibe o termo de Boas Condutas que o usuário deve aceitar antes de
     * continuar. Usuários que já aceitaram são levados à sua página inicial.
     */
    public function show(): View|RedirectResponse
    {
        $user = request()->user();

        if ($user->hasAcceptedCodeOfConduct()) {
            return redirect()->route($user->homeRoute());
        }

        return view('code-of-conduct.show', [
            'text' => $this->codeOfConduct->text(),
        ]);
    }

    /**
     * Registra o aceite do usuário e o encaminha à sua página inicial.
     */
    public function accept(AcceptCodeOfConductRequest $request): RedirectResponse
    {
        $user = $request->user();

        $this->codeOfConduct->recordAcceptance($user);

        return redirect()
            ->route($user->homeRoute())
            ->with('success', 'Bem-vindo(a)! Boas condutas aceitas com sucesso.');
    }
}
