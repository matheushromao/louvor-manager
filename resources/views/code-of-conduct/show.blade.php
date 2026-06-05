<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        use App\Models\Setting;
        use Illuminate\Support\Facades\Schema;

        $settings = Schema::hasTable('settings') ? Setting::pluck('value', 'key')->toArray() : [];
        $primary = $settings['primary_color'] ?? '#0f172a';
        $accent = $settings['accent_color'] ?? '#0ea5e9';
        $siteName = $settings['site_name'] ?? config('app.name', 'Louvor Manager');
        $logoUrl = Setting::fileUrl($settings['logo_path'] ?? null);
    @endphp

    <title>Boas Condutas de Uso — {{ $siteName }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { --site-primary: {{ $primary }}; --site-accent: {{ $accent }}; }
        .btn-primary { background: var(--site-primary) !important; color: #fff !important; }
    </style>
</head>
<body class="font-sans text-slate-900 antialiased">
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-900/60 px-4 py-8 backdrop-blur-sm">
        <div
            x-data="{ accepted: false }"
            class="flex max-h-full w-full max-w-2xl flex-col overflow-hidden rounded-3xl bg-white shadow-[0_30px_120px_rgba(15,23,42,0.35)]">

            {{-- Cabeçalho --}}
            <div class="flex items-center gap-3 border-b border-slate-100 px-6 py-5 sm:px-8">
                @if($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="h-11 w-11 rounded-2xl bg-white object-contain p-1 ring-1 ring-slate-200">
                @else
                    <span class="grid h-11 w-11 place-items-center rounded-2xl text-lg font-bold text-white" style="background: linear-gradient(135deg, var(--site-primary), var(--site-accent));">
                        {{ mb_strtoupper(mb_substr($siteName, 0, 1)) }}
                    </span>
                @endif
                <div>
                    <h1 class="text-xl font-semibold text-slate-900">Boas Condutas de Uso</h1>
                    <p class="text-sm text-slate-500">Leia e aceite os termos para continuar.</p>
                </div>
            </div>

            {{-- Texto do termo (rolável) --}}
            <div class="overflow-y-auto px-6 py-6 sm:px-8">
                <div class="whitespace-pre-line text-sm leading-relaxed text-slate-700">{{ $text }}</div>
            </div>

            {{-- Rodapé com aceite --}}
            <div class="border-t border-slate-100 bg-slate-50 px-6 py-5 sm:px-8">
                <form method="POST" action="{{ route('code-of-conduct.accept') }}" class="space-y-4">
                    @csrf

                    <label class="flex cursor-pointer items-start gap-3 text-sm text-slate-700">
                        <input
                            type="checkbox"
                            name="accept"
                            value="1"
                            x-model="accepted"
                            class="mt-0.5 h-5 w-5 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/40">
                        <span>Li e concordo com as boas condutas de uso.</span>
                    </label>

                    <x-input-error :messages="$errors->get('accept')" class="mt-1" />

                    <div class="flex flex-wrap items-center justify-end gap-3">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="text-sm font-medium text-slate-500 hover:text-slate-700">
                            Sair
                        </a>
                        <button
                            type="submit"
                            x-bind:disabled="!accepted"
                            class="btn-primary inline-flex items-center justify-center rounded-full px-6 py-3 text-sm font-semibold shadow-lg shadow-slate-900/10 transition disabled:cursor-not-allowed disabled:opacity-50">
                            Concordar e continuar
                        </button>
                    </div>
                </form>

                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</body>
</html>
