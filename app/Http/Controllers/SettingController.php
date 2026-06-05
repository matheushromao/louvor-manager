<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingController extends Controller
{
    /** Chaves de texto/cor persistidas diretamente. */
    private const TEXT_KEYS = [
        'site_name',
        'church_name',
        'footer_text',
        'primary_color',
        'accent_color',
        'background_color',
        'text_color',
        'card_color',
        'code_of_conduct',
    ];

    // Exibe o formulário de edição das configurações
    public function edit(): View
    {
        $settings = Setting::pluck('value', 'key');

        return view('settings.edit', [
            'settings' => $settings,
            'logoUrl' => Setting::fileUrl($settings['logo_path'] ?? null),
            'backgroundUrl' => Setting::fileUrl($settings['background_image_path'] ?? null),
        ]);
    }

    // Atualiza as configurações com os dados do formulário
    public function update(Request $request): RedirectResponse
    {
        $hexColor = 'regex:/^#([A-Fa-f0-9]{6})$/';

        $validated = $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'church_name' => ['nullable', 'string', 'max:255'],
            'footer_text' => ['nullable', 'string', 'max:255'],
            'primary_color' => ['nullable', 'string', $hexColor],
            'accent_color' => ['nullable', 'string', $hexColor],
            'background_color' => ['nullable', 'string', $hexColor],
            'text_color' => ['nullable', 'string', $hexColor],
            'card_color' => ['nullable', 'string', $hexColor],
            'code_of_conduct' => ['nullable', 'string', 'max:10000'],
            'logo' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:2048'],
            'background_image' => ['nullable', 'image', 'mimes:png,jpg,jpeg,webp', 'max:4096'],
            'remove_logo' => ['nullable', 'boolean'],
            'remove_background_image' => ['nullable', 'boolean'],
        ], $this->messages());

        foreach (self::TEXT_KEYS as $key) {
            Setting::updateOrCreate(['key' => $key], ['value' => $request->input($key, '')]);
        }

        $this->persistImage($request, 'logo', 'remove_logo', 'logo_path');
        $this->persistImage($request, 'background_image', 'remove_background_image', 'background_image_path');

        return redirect()->route('settings.edit')->with('success', 'Configurações atualizadas com sucesso!');
    }

    /**
     * Trata upload/remoção de uma imagem de configuração no disco "public",
     * sempre apagando o arquivo anterior para não acumular lixo.
     */
    private function persistImage(Request $request, string $inputName, string $removeName, string $settingKey): void
    {
        $setting = Setting::firstOrNew(['key' => $settingKey]);
        $currentPath = $setting->value;

        if ($request->boolean($removeName)) {
            $this->deleteFile($currentPath);
            $setting->value = null;
            $setting->save();

            return;
        }

        if ($request->hasFile($inputName)) {
            $this->deleteFile($currentPath);
            $setting->value = $request->file($inputName)->store('settings', 'public');
            $setting->save();
        }
    }

    private function deleteFile(?string $path): void
    {
        if (filled($path) && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * @return array<string, string>
     */
    private function messages(): array
    {
        return [
            'logo.image' => 'O logo deve ser uma imagem válida.',
            'logo.mimes' => 'O logo deve estar nos formatos PNG, JPG ou WEBP.',
            'logo.max' => 'O logo não pode ultrapassar 2 MB.',
            'background_image.image' => 'A imagem de fundo deve ser uma imagem válida.',
            'background_image.mimes' => 'A imagem de fundo deve estar nos formatos PNG, JPG ou WEBP.',
            'background_image.max' => 'A imagem de fundo não pode ultrapassar 4 MB.',
            '*.regex' => 'Informe uma cor em formato hexadecimal válido (ex: #0ea5e9).',
        ];
    }
}
