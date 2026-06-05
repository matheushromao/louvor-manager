<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-slate-900">Recuperar senha</h1>
        <p class="mt-2 text-sm text-slate-500">
            Informe o e-mail cadastrado e enviaremos um link para você criar uma nova senha.
        </p>
    </div>

    {{-- Confirmação de envio do link --}}
    @if (session('status'))
        <div class="mb-4 flex items-start gap-3 rounded-2xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <div>
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email')" required autofocus placeholder="voce@exemplo.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center">
            Enviar link de recuperação
        </x-primary-button>

        <p class="text-center text-sm text-slate-500">
            Lembrou a senha?
            <a href="{{ route('login') }}" class="font-medium text-slate-900 underline-offset-2 hover:underline">Voltar para o login</a>
        </p>
    </form>
</x-guest-layout>
