<?php

namespace App\Http\Controllers;

use App\Services\MailSettingsService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class SmtpSettingController extends Controller
{
    public function __construct(private readonly MailSettingsService $mailSettings)
    {
    }

    /** Exibe o formulário de configuração de SMTP. */
    public function edit(): View
    {
        return view('settings.smtp', [
            'settings' => $this->mailSettings->all(),
            'providers' => MailSettingsService::PROVIDERS,
        ]);
    }

    /** Salva as configurações de SMTP informadas pelo administrador. */
    public function update(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);

        $this->mailSettings->save($validated);

        return redirect()
            ->route('settings.smtp.edit')
            ->with('success', 'Configurações de SMTP salvas com sucesso!');
    }

    /**
     * Salva os dados e dispara um e-mail de teste para validar a
     * configuração imediatamente, reportando o resultado ao administrador.
     */
    public function test(Request $request): RedirectResponse
    {
        $validated = $this->validateData($request);

        $request->validate(
            ['test_email' => ['required', 'email']],
            ['test_email.required' => 'Informe um e-mail para receber o teste.', 'test_email.email' => 'Informe um e-mail válido para o teste.']
        );

        $this->mailSettings->save($validated);
        $this->mailSettings->apply();

        $destino = $request->input('test_email');

        try {
            Mail::raw(
                "Este é um e-mail de teste enviado pelo Louvor Manager.\n\n"
                ."Se você recebeu esta mensagem, o SMTP está configurado corretamente.",
                function ($message) use ($destino) {
                    $message->to($destino)->subject('Teste de SMTP — Louvor Manager');
                }
            );
        } catch (Throwable $e) {
            return redirect()
                ->route('settings.smtp.edit')
                ->with('error', 'Falha ao enviar o e-mail de teste: '.$e->getMessage());
        }

        return redirect()
            ->route('settings.smtp.edit')
            ->with('success', "E-mail de teste enviado para {$destino}. Verifique a caixa de entrada (e o spam).");
    }

    /**
     * Valida e normaliza os dados do formulário de SMTP.
     *
     * @return array<string, mixed>
     */
    private function validateData(Request $request): array
    {
        return $request->validate([
            'mail_provider' => ['required', 'string', 'in:'.implode(',', array_keys(MailSettingsService::PROVIDERS))],
            'mail_host' => ['required', 'string', 'max:255'],
            'mail_port' => ['required', 'integer', 'min:1', 'max:65535'],
            'mail_encryption' => ['required', 'in:tls,ssl,none'],
            'mail_username' => ['required', 'string', 'max:255'],
            'mail_password' => ['nullable', 'string', 'max:255'],
            'mail_from_address' => ['required', 'email', 'max:255'],
            'mail_from_name' => ['required', 'string', 'max:255'],
        ], [
            'mail_provider.required' => 'Selecione um provedor.',
            'mail_host.required' => 'Informe o servidor SMTP (host).',
            'mail_port.required' => 'Informe a porta do servidor SMTP.',
            'mail_port.integer' => 'A porta deve ser um número.',
            'mail_encryption.in' => 'Selecione um tipo de criptografia válido.',
            'mail_username.required' => 'Informe o usuário (geralmente o e-mail completo).',
            'mail_from_address.required' => 'Informe o e-mail remetente.',
            'mail_from_address.email' => 'O e-mail remetente deve ser válido.',
            'mail_from_name.required' => 'Informe o nome do remetente.',
        ]);
    }
}
