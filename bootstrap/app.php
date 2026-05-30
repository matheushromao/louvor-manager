<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => App\Http\Middleware\AdminMiddleware::class,
            'role' => App\Http\Middleware\RoleMiddleware::class,
        ]);

        // Usuários já autenticados que acessam rotas de visitante (login/registro)
        // são levados à sua página inicial conforme a role.
        $middleware->redirectUsersTo(function (Request $request) {
            return route($request->user()->homeRoute());
        });
    })

    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
