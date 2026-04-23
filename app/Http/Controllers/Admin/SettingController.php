<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function aiConfig()
{
    // Ambil data dari database agar inputan tidak kosong
    $settings = \App\Models\Setting::whereIn('key', ['ai_api_key', 'ai_system_prompt'])
                                  ->pluck('value', 'key');

    // Pastikan path ini sesuai: folder admin -> folder setting -> file index.blade.php
    return view('admin.setting.index', compact('settings'));
}
    public function updateAiConfig(Request $request)
    {
        $request->validate([
            'ai_api_key' => 'required',
            'ai_system_prompt' => 'required',
        ], [
            'ai_api_key.required' => 'API Key tidak boleh kosong!',
            'ai_system_prompt.required' => 'System Prompt harus diisi!'
        ]);

        // Simpan data menggunakan updateOrCreate agar tidak duplikat
        Setting::updateOrCreate(['key' => 'ai_api_key'], ['value' => $request->ai_api_key]);
        Setting::updateOrCreate(['key' => 'ai_system_prompt'], ['value' => $request->ai_system_prompt]);

        return back()->with('success', 'Pengaturan AI berhasil diperbarui.');
    }
}