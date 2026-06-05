<?php

namespace App\Services;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Carbon;

/**
 * Regras de negócio das "Boas Condutas de Uso": leitura e atualização do
 * texto (editável pelo administrador) e registro do aceite de cada usuário.
 */
class CodeOfConductService
{
    /** Chave do texto na tabela settings. */
    private const TEXT_KEY = 'code_of_conduct';

    /** Texto padrão usado enquanto o administrador não personaliza o termo. */
    private const DEFAULT_TEXT = <<<'TEXT'
Bem-vindo(a) ao sistema de gestão de louvor!

Ao utilizar esta plataforma, você concorda em:

1. Utilizar o sistema exclusivamente para fins ministeriais e organizacionais.
2. Manter a confidencialidade dos dados de outros membros e colaboradores.
3. Respeitar os demais usuários, mantendo uma comunicação cordial e edificante.
4. Não compartilhar suas credenciais de acesso com terceiros.
5. Zelar pelas informações cadastradas, evitando alterações ou exclusões indevidas.

O descumprimento destas condutas pode resultar na suspensão do acesso.
TEXT;

    /**
     * Retorna o texto vigente das Boas Condutas (personalizado ou padrão).
     */
    public function text(): string
    {
        $stored = Setting::where('key', self::TEXT_KEY)->value('value');

        return filled($stored) ? $stored : self::DEFAULT_TEXT;
    }

    /**
     * Atualiza o texto das Boas Condutas (ação restrita ao administrador).
     */
    public function updateText(string $text): void
    {
        Setting::updateOrCreate(
            ['key' => self::TEXT_KEY],
            ['value' => $text]
        );
    }

    /**
     * Registra o aceite do usuário, se ainda não houver.
     */
    public function recordAcceptance(User $user): void
    {
        if ($user->hasAcceptedCodeOfConduct()) {
            return;
        }

        $user->forceFill(['code_of_conduct_accepted_at' => Carbon::now()])->save();
    }
}
