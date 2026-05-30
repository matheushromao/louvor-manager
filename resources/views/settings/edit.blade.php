@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl rounded-[2rem] bg-white p-8 shadow-[0_20px_80px_rgba(15,23,42,0.12)] card-panel">
    <div class="mb-8">
        <h1 class="text-3xl font-semibold text-slate-900">Configurações do site</h1>
        <p class="mt-2 text-sm text-slate-600">Edite o nome do site, o rodapé e as cores principais da identidade visual.</p>
    </div>

    @if(session('success'))
        <div class="mb-6 rounded-3xl border border-green-200 bg-green-50 p-4 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('settings.update') }}" method="POST" class="space-y-6" enctype="multipart/form-data">
        @csrf

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <x-label for="site_name" value="Nome do Sistema" />
                <x-input id="site_name" name="site_name" type="text" value="{{ old('site_name', $settings['site_name'] ?? '') }}" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
            </div>

            <div>
                <x-label for="church_name" value="Nome da Igreja" />
                <x-input id="church_name" name="church_name" type="text" value="{{ old('church_name', $settings['church_name'] ?? '') }}" class="mt-1 block w-full" />
                <x-input-error :messages="$errors->get('church_name')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-label for="footer_text" value="Texto do Rodapé" />
            <x-input id="footer_text" name="footer_text" type="text" value="{{ old('footer_text', $settings['footer_text'] ?? '') }}" class="mt-1 block w-full" />
            <x-input-error :messages="$errors->get('footer_text')" class="mt-2" />
        </div>

        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <x-label for="primary_color" value="Cor primária" />
                <x-input id="primary_color" name="primary_color" type="color" value="{{ old('primary_color', $settings['primary_color'] ?? '#0f172a') }}" class="mt-1 h-12 w-full rounded-xl border border-slate-300 bg-white" />
                <x-input-error :messages="$errors->get('primary_color')" class="mt-2" />
            </div>
            <div>
                <x-label for="accent_color" value="Cor de destaque" />
                <x-input id="accent_color" name="accent_color" type="color" value="{{ old('accent_color', $settings['accent_color'] ?? '#0ea5e9') }}" class="mt-1 h-12 w-full rounded-xl border border-slate-300 bg-white" />
                <x-input-error :messages="$errors->get('accent_color')" class="mt-2" />
            </div>
            <div>
                <x-label for="background_color" value="Cor de fundo" />
                <x-input id="background_color" name="background_color" type="color" value="{{ old('background_color', $settings['background_color'] ?? '#f8fafc') }}" class="mt-1 h-12 w-full rounded-xl border border-slate-300 bg-white" />
                <x-input-error :messages="$errors->get('background_color')" class="mt-2" />
            </div>
            <div>
                <x-label for="text_color" value="Cor do texto" />
                <x-input id="text_color" name="text_color" type="color" value="{{ old('text_color', $settings['text_color'] ?? '#0f172a') }}" class="mt-1 h-12 w-full rounded-xl border border-slate-300 bg-white" />
                <x-input-error :messages="$errors->get('text_color')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-label for="card_color" value="Cor dos cards" />
            <x-input id="card_color" name="card_color" type="color" value="{{ old('card_color', $settings['card_color'] ?? '#ffffff') }}" class="mt-1 h-12 w-full rounded-xl border border-slate-300 bg-white" />
            <x-input-error :messages="$errors->get('card_color')" class="mt-2" />
        </div>

        <div class="space-y-6 border-t border-slate-100 pt-6">
            <div>
                <h2 class="text-lg font-semibold text-slate-900">Imagens do site</h2>
                <p class="mt-1 text-sm text-slate-500">Personalize o logo e a imagem de fundo exibidos nas páginas do sistema.</p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2">
                <div>
                    <x-label value="Logo" />
                    @if($logoUrl)
                        <div class="mt-2 flex items-center gap-4">
                            <img src="{{ $logoUrl }}" alt="Logo atual" class="h-16 w-16 rounded-2xl bg-white object-contain p-1 ring-1 ring-slate-200">
                            <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                                <input type="checkbox" name="remove_logo" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500/30">
                                Remover logo
                            </label>
                        </div>
                    @endif
                    <input
                        type="file"
                        name="logo"
                        accept="image/png,image/jpeg,image/webp"
                        class="mt-3 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:opacity-90">
                    <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    <p class="mt-1 text-xs text-slate-400">PNG, JPG ou WEBP até 2 MB.</p>
                </div>

                <div>
                    <x-label value="Imagem de fundo" />
                    @if($backgroundUrl)
                        <div class="mt-2 space-y-2">
                            <img src="{{ $backgroundUrl }}" alt="Imagem de fundo atual" class="h-24 w-full rounded-2xl object-cover ring-1 ring-slate-200">
                            <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                                <input type="checkbox" name="remove_background_image" value="1" class="rounded border-slate-300 text-red-600 focus:ring-red-500/30">
                                Remover imagem de fundo
                            </label>
                        </div>
                    @endif
                    <input
                        type="file"
                        name="background_image"
                        accept="image/png,image/jpeg,image/webp"
                        class="mt-3 block w-full text-sm text-slate-600 file:mr-4 file:rounded-full file:border-0 file:bg-slate-900 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-white hover:file:opacity-90">
                    <x-input-error :messages="$errors->get('background_image')" class="mt-2" />
                    <p class="mt-1 text-xs text-slate-400">PNG, JPG ou WEBP até 4 MB.</p>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap items-center gap-3 pt-2">
            <button type="submit" class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold shadow-lg shadow-slate-900/10">Salvar alterações</button>
            <a href="{{ route('dashboard') }}" class="btn-outline inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold">Voltar</a>
        </div>
    </form>
</div>
@endsection
