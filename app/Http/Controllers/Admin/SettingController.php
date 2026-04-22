<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function aiConfig()
    {
        // Mengambil instruksi AI yang tersimpan
        $prompt = Setting::where('key', 'ai_system_instruction')->first();
        return view('admin.ai-settings', compact('prompt'));
    }

    public function updateAiConfig(Request $request)
    {
        Setting::updateOrCreate(
            ['key' => 'ai_system_instruction'],
            ['value' => $request->instruction]
        );

        return back()->with('success', 'Instruksi AI berhasil diperbarui!');
    }
}
