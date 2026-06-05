@extends('layouts.app')

@section('content')
@php
    // Presets expostos ao Alpine para preencher host/porta/criptografia ao trocar de provedor.
    $providerPresets = collect($providers)->map(fn ($p) => [
        'host' => $p['host'],
        'port' => $p['port'],
        'encryption' => $p['encryption'],
        'hint' => $p['hint'],
    ]);
    $currentProvider = old('mail_provider', $settings['mail_provider'] ?: 'gmail');
@endphp

<div
    x-data="{
        presets: {{ Js::from($providerPresets) }},
        provider: '{{ $currentProvider }}',
        host: '{{ old('mail_host', $settings['mail_host']) }}',
        port: '{{ old('mail_port', $settings['mail_port'] ?: 587) }}',
        encryption: '{{ old('mail_encryption', $settings['mail_encryption'] ?: 'tls') }}',
        username: @js(old('mail_username', $settings['mail_username'])),
        fromAddress: @js(old('mail_from_address', $settings['mail_from_address'])),
        fromName: @js(old('mail_from_name', $settings['mail_from_name'])),
        applyPreset(force = false) {
            const preset = this.presets[this.provider];
            if (!preset) return;
            // Em 'custom' não sobrescreve o que o usuário digitou.
            if (this.provider === 'custom' && !force) return;
            this.host = preset.host;
            this.port = preset.port;
            this.encryption = preset.encryption;
        },
        get hint() {
            return this.presets[this.provider]?.hint ?? '';
        }
    }"
    class="mx-auto max-w-3xl rounded-[2rem] bg-white p-8 shadow-[0_20px_80px_rgba(15,23,42,0.12)] card-panel">

    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-slate-900">Configuração de SMTP</h1>
        <p class="mt-2 text-sm text-slate-600">Defina o provedor de e-mail usado pelo sistema para enviar mensagens (recuperação de senha, avisos etc.).</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-3xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 rounded-3xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('settings.smtp.update') }}" method="POST" class="space-y-6">
        @csrf

        <div>
            <x-label for="mail_provider" value="Provedor" />
            <select
                id="mail_provider"
                name="mail_provider"
                x-model="provider"
                @change="applyPreset(true)"
                class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                @foreach($providers as $key => $provider)
                    <option value="{{ $key }}">{{ $provider['label'] }}</option>
                @endforeach
            </select>
            <p class="mt-2 text-xs text-slate-500" x-text="hint"></p>
            <x-input-error :messages="$errors->get('mail_provider')" class="mt-2" />
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <x-label for="mail_host" value="Servidor SMTP (host)" />
                <x-input id="mail_host" name="mail_host" type="text" x-model="host" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('mail_host')" class="mt-2" />
            </div>

            <div>
                <x-label for="mail_port" value="Porta" />
                <x-input id="mail_port" name="mail_port" type="number" min="1" max="65535" x-model="port" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('mail_port')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-label for="mail_encryption" value="Criptografia" />
            <select
                id="mail_encryption"
                name="mail_encryption"
                x-model="encryption"
                class="mt-1 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="tls">TLS / STARTTLS (porta 587)</option>
                <option value="ssl">SSL (porta 465)</option>
                <option value="none">Nenhuma</option>
            </select>
            <x-input-error :messages="$errors->get('mail_encryption')" class="mt-2" />
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <x-label for="mail_username" value="Usuário" />
                <x-input id="mail_username" name="mail_username" type="text" autocomplete="off" x-model="username" class="mt-1 block w-full" />
                <p class="mt-1 text-xs text-slate-400">Normalmente o e-mail completo.</p>
                <x-input-error :messages="$errors->get('mail_username')" class="mt-2" />
            </div>

            <div>
                <x-label for="mail_password" value="Senha" />
                <x-input id="mail_password" name="mail_password" type="password" autocomplete="new-password" placeholder="{{ $settings['mail_password'] ? '•••••••• (deixe em branco para manter)' : '' }}" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('mail_password')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-6 border-t border-slate-100 pt-6 sm:grid-cols-2">
            <div>
                <x-label for="mail_from_address" value="E-mail remetente" />
                <x-input id="mail_from_address" name="mail_from_address" type="email" x-model="fromAddress" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('mail_from_address')" class="mt-2" />
            </div>

            <div>
                <x-label for="mail_from_name" value="Nome do remetente" />
                <x-input id="mail_from_name" name="mail_from_name" type="text" x-model="fromName" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('mail_from_name')" class="mt-2" />
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3 pt-2">
            <button type="submit" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold shadow-lg shadow-slate-900/10">Salvar configurações</button>
            <a href="{{ route('settings.edit') }}" class="btn-outline inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold">Voltar</a>
        </div>
    </form>

    {{-- Envio de e-mail de teste: usa o mesmo formulário (campos sincronizados via Alpine) --}}
    <div class="mt-8 space-y-4 border-t border-slate-100 pt-6">
        <div>
            <h2 class="text-lg font-semibold text-slate-900">Enviar e-mail de teste</h2>
            <p class="mt-1 text-sm text-slate-500">Salva os dados acima e envia uma mensagem de teste para confirmar que tudo funciona.</p>
        </div>

        <form action="{{ route('settings.smtp.test') }}" method="POST" class="flex flex-col gap-3 sm:flex-row sm:items-end">
            @csrf
            {{-- Reaproveita os valores atuais do formulário principal --}}
            <input type="hidden" name="mail_provider" :value="provider">
            <input type="hidden" name="mail_host" :value="host">
            <input type="hidden" name="mail_port" :value="port">
            <input type="hidden" name="mail_encryption" :value="encryption">
            <input type="hidden" name="mail_username" :value="username">
            <input type="hidden" name="mail_password" value="">
            <input type="hidden" name="mail_from_address" :value="fromAddress">
            <input type="hidden" name="mail_from_name" :value="fromName">

            <div class="flex-1">
                <x-label for="test_email" value="Enviar teste para" />
                <x-input id="test_email" name="test_email" type="email" value="{{ old('test_email', auth()->user()->email) }}" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('test_email')" class="mt-2" />
            </div>

            <button type="submit" class="btn-outline inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold">Enviar teste</button>
        </form>
        <p class="text-xs text-slate-400">Atenção: o e-mail de teste usa o <strong>usuário, senha e remetente já salvos</strong>. Salve as configurações antes de testar credenciais novas.</p>
    </div>
</div>
@endsection
