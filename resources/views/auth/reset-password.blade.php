<x-guest-layout>
    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-slate-900">Criar nova senha</h1>
        <p class="mt-2 text-sm text-slate-500">
            Defina uma nova senha para a sua conta. Use ao menos 8 caracteres.
        </p>
    </div>

    {{-- Erro de token expirado/inválido: orienta a solicitar um novo link --}}
    @if ($errors->has('email'))
        <div class="mb-4 space-y-2 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
            <p class="flex items-start gap-2">
                <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                </svg>
                <span>{{ $errors->first('email') }}</span>
            </p>
            <a href="{{ route('password.request') }}" class="inline-block font-semibold text-red-800 underline underline-offset-2">
                Solicitar um novo link de recuperação
            </a>
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" value="E-mail" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                          :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" value="Nova senha" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password"
                          required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Confirmar nova senha" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                          name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <x-primary-button class="w-full justify-center">
            Redefinir senha
        </x-primary-button>

        <p class="text-center text-sm text-slate-500">
            <a href="{{ route('login') }}" class="font-medium text-slate-900 underline-offset-2 hover:underline">Voltar para o login</a>
        </p>
    </form>
</x-guest-layout>
