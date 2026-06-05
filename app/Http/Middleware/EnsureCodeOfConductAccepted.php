<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Bloqueia o uso do sistema enquanto o usuário autenticado não aceitar as
 * Boas Condutas de Uso, redirecionando-o para a tela do termo. A imposição
 * é feita no servidor para não depender apenas do front-end.
 */
class EnsureCodeOfConductAccepted
{
    /**
     * Rotas liberadas mesmo sem o aceite, para evitar laço de redirecionamento
     * (a própria tela do termo, o envio do aceite e o logout).
     *
     * @var array<int, string>
     */
    private const ALLOWED_ROUTES = [
        'code-of-conduct.show',
        'code-of-conduct.accept',
        'logout',
    ];

    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && ! $user->hasAcceptedCodeOfConduct() && ! $request->routeIs(self::ALLOWED_ROUTES)) {
            return redirect()->route('code-of-conduct.show');
        }

        return $next($request);
    }
}
