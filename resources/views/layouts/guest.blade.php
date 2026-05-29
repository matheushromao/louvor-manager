<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            use App\Models\Setting;
            use Illuminate\Support\Facades\Schema;

            $settings = [];
            if (Schema::hasTable('settings')) {
                $settings = Setting::pluck('value', 'key')->toArray();
            }

            $primary = $settings['primary_color'] ?? '#0f172a';
            $accent = $settings['accent_color'] ?? '#0ea5e9';
            $background = $settings['background_color'] ?? '#f8fafc';
            $siteName = $settings['site_name'] ?? config('app.name', 'Louvor Manager');
        @endphp

        <title>{{ $siteName }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --site-primary: {{ $primary }};
                --site-accent: {{ $accent }};
                --site-background: {{ $background }};
                --site-button-text: #ffffff;
            }
            .btn-primary {
                background: var(--site-primary) !important;
                color: var(--site-button-text) !important;
            }
        </style>
    </head>
    <body class="font-sans text-slate-900 antialiased">
        <div class="flex min-h-screen flex-col items-center justify-center bg-[radial-gradient(circle_at_top,_rgba(14,165,233,0.16),_transparent_40%),linear-gradient(to_bottom,_var(--site-background),_#ffffff)] px-4 py-10">

            <a href="/" class="mb-6 flex items-center gap-3">
                <span class="grid h-12 w-12 place-items-center rounded-2xl text-lg font-bold text-white shadow-lg" style="background: linear-gradient(135deg, var(--site-primary), var(--site-accent));">
                    {{ mb_strtoupper(mb_substr($siteName, 0, 1)) }}
                </span>
                <span class="text-xl font-bold text-slate-900">{{ $siteName }}</span>
            </a>

            <div class="w-full max-w-md overflow-hidden rounded-3xl bg-white/95 p-6 shadow-[0_20px_80px_rgba(15,23,42,0.12)] ring-1 ring-slate-900/5 sm:p-8">
                {{ $slot }}
            </div>

        </div>
    </body>
</html>
