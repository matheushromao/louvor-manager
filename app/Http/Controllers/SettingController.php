<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    // Exibe o formulário de edição das configurações
    public function edit()
    {
        $settings = Setting::pluck('value', 'key');
        return view('settings.edit', compact('settings'));
    }

    // Atualiza as configurações com os dados do formulário
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => ['nullable', 'string', 'max:255'],
            'church_name' => ['nullable', 'string', 'max:255'],
            'footer_text' => ['nullable', 'string', 'max:255'],
        ]);

        foreach (['site_name', 'church_name', 'footer_text'] as $key) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $request->input($key, '')]
            );
        }

        return redirect()->back()->with('success', 'Configurações atualizadas com sucesso!');
    }
}
