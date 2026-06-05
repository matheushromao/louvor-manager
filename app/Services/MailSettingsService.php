<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

/**
 * Centraliza a leitura, gravação e aplicação em tempo de execução das
 * configurações de SMTP definidas pelo administrador. Os valores ficam
 * persistidos na tabela "settings" (par chave/valor) e a senha é guardada
 * sempre criptografada.
 */
class MailSettingsService
{
    /** Chaves utilizadas na tabela settings. */
    private const KEYS = [
        'mail_provider',
        'mail_host',
        'mail_port',
        'mail_encryption',
        'mail_username',
        'mail_password',
        'mail_from_address',
        'mail_from_name',
    ];

    /**
     * Presets dos provedores suportados. O administrador pode escolher um
     * provedor para preencher host/porta/criptografia automaticamente ou
     * usar "custom" para informar manualmente.
     *
     * @var array<string, array<string, mixed>>
     */
    public const PROVIDERS = [
        'gmail' => [
            'label' => 'Gmail',
            'host' => 'smtp.gmail.com',
            'port' => 587,
            'encryption' => 'tls',
            'hint' => 'Use uma "Senha de app" gerada na conta Google (a senha normal não funciona com verificação em duas etapas).',
        ],
        'outlook' => [
            'label' => 'Outlook / Office 365',
            'host' => 'smtp.office365.com',
            'port' => 587,
            'encryption' => 'tls',
            'hint' => 'Use o e-mail completo como usuário. Contas com MFA exigem uma senha de aplicativo.',
        ],
        'hostinger' => [
            'label' => 'Hostinger',
            'host' => 'smtp.hostinger.com',
            'port' => 465,
            'encryption' => 'ssl',
            'hint' => 'Use o e-mail criado no painel da Hostinger e a respectiva senha.',
        ],
        'locaweb' => [
            'label' => 'Locaweb',
            'host' => 'email-ssl.com.br',
            'port' => 465,
            'encryption' => 'ssl',
            'hint' => 'Use o e-mail completo (com o domínio) como usuário e a senha cadastrada na Locaweb.',
        ],
        'custom' => [
            'label' => 'Personalizado',
            'host' => '',
            'port' => 587,
            'encryption' => 'tls',
            'hint' => 'Informe host, porta e criptografia conforme o seu provedor de e-mail.',
        ],
    ];

    /**
     * Retorna todas as configurações atuais já com a senha descriptografada.
     * Campos ausentes voltam como string vazia para facilitar o uso no form.
     *
     * @return array<string, string>
     */
    public function all(): array
    {
        $stored = Setting::whereIn('key', self::KEYS)->pluck('value', 'key');

        $settings = [];
        foreach (self::KEYS as $key) {
            $settings[$key] = $stored[$key] ?? '';
        }

        $settings['mail_password'] = $this->decrypt($settings['mail_password']);

        return $settings;
    }

    /**
     * Persiste as configurações enviadas pelo administrador. A senha é
     * criptografada; quando vier vazia, mantém a senha já existente para
     * permitir salvar o formulário sem reescrever a credencial.
     *
     * @param  array<string, mixed>  $data
     */
    public function save(array $data): void
    {
        foreach (self::KEYS as $key) {
            if ($key === 'mail_password') {
                continue;
            }

            Setting::updateOrCreate(['key' => $key], ['value' => (string) ($data[$key] ?? '')]);
        }

        $password = $data['mail_password'] ?? '';
        if ($password !== '' && $password !== null) {
            Setting::updateOrCreate(
                ['key' => 'mail_password'],
                ['value' => Crypt::encryptString($password)]
            );
        }
    }

    /**
     * Aplica as configurações persistidas ao config de e-mail em tempo de
     * execução, fazendo o sistema enviar e-mails pelo SMTP configurado.
     * Não faz nada se host ou usuário ainda não estiverem definidos.
     */
    public function apply(): void
    {
        $settings = $this->all();

        if (blank($settings['mail_host']) || blank($settings['mail_username'])) {
            return;
        }

        $encryption = $settings['mail_encryption'] ?: 'tls';
        $scheme = $encryption === 'ssl' ? 'smtps' : 'smtp';

        config([
            'mail.default' => 'smtp',
            'mail.mailers.smtp.transport' => 'smtp',
            'mail.mailers.smtp.scheme' => $scheme,
            'mail.mailers.smtp.host' => $settings['mail_host'],
            'mail.mailers.smtp.port' => (int) ($settings['mail_port'] ?: 587),
            'mail.mailers.smtp.encryption' => $encryption === 'none' ? null : $encryption,
            'mail.mailers.smtp.username' => $settings['mail_username'],
            'mail.mailers.smtp.password' => $settings['mail_password'],
        ]);

        if (filled($settings['mail_from_address'])) {
            config(['mail.from.address' => $settings['mail_from_address']]);
        }

        if (filled($settings['mail_from_name'])) {
            config(['mail.from.name' => $settings['mail_from_name']]);
        }
    }

    /**
     * Indica se já existe uma configuração SMTP mínima utilizável.
     */
    public function isConfigured(): bool
    {
        $settings = $this->all();

        return filled($settings['mail_host']) && filled($settings['mail_username']);
    }

    private function decrypt(string $value): string
    {
        if ($value === '') {
            return '';
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException) {
            return '';
        }
    }
}
