<?php

namespace App\Providers;

use App\Services\MailSettingsService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Throwable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->applyMailSettings();
    }

    /**
     * Aplica as configurações de SMTP salvas pelo administrador. Protegido
     * contra falhas (banco indisponível ou migrações ainda não rodadas) para
     * não quebrar comandos como migrate em uma instalação nova.
     */
    private function applyMailSettings(): void
    {
        try {
            if (! Schema::hasTable('settings')) {
                return;
            }

            app(MailSettingsService::class)->apply();
        } catch (Throwable) {
            // Configuração de e-mail indisponível: mantém o mailer padrão.
        }
    }
}
