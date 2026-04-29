<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class WebConfigController extends Controller
{
    public function index()
    {
        return view('admin.web_config.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'home_hero_title' => 'nullable|string',
            'home_hero_description' => 'nullable|string',
            'home_cta_text' => 'nullable|string',
            'home_cta_link' => 'nullable|string',
            'hero_title' => 'required|string',
            'hero_description' => 'nullable|string',
            'individual_hero_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'team_1_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'team_2_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'team_3_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
            'team_4_image' => 'nullable|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $this->saveConfig('home_hero_title', $request->home_hero_title);
        $this->saveConfig('home_hero_description', $request->home_hero_description);
        $this->saveConfig('home_cta_text', $request->home_cta_text);
        $this->saveConfig('home_cta_link', $request->home_cta_link);
        $this->saveConfig('hero_title', $request->hero_title);
        $this->saveConfig('hero_description', $request->hero_description);

        if ($request->hasFile('individual_hero_image')) {
            $this->saveImageConfig('individual_hero_image', $request->file('individual_hero_image'));
        }

        foreach (range(1, 4) as $index) {
            $key = "team_{$index}_image";
            if ($request->hasFile($key)) {
                $this->saveImageConfig($key, $request->file($key));
            }
            $this->saveConfig("team_{$index}_name", $request->input("team_{$index}_name"));
            $this->saveConfig("team_{$index}_title", $request->input("team_{$index}_title"));
            $this->saveConfig("team_{$index}_description", $request->input("team_{$index}_description"));
        }

        $this->saveConfig('price_basic', $request->price_basic);
        $this->saveConfig('price_essential', $request->price_essential);
        $this->saveConfig('price_premium', $request->price_premium);
        $this->saveConfig('price_pre_marriage', $request->price_pre_marriage);
        $this->saveConfig('price_marriage', $request->price_marriage);

        return back()->with('success', 'Konfigurasi berhasil diperbarui!');
    }

    private function saveConfig(string $key, $value)
    {
        if (is_null($value)) {
            return;
        }

        WebConfig::updateOrCreate(
            ['key' => $key],
            ['value' => (string) $value]
        );
    }

    private function saveImageConfig(string $key, $file)
    {
        $config = WebConfig::where('key', $key)->first();
        if ($config && $config->value && Storage::disk('public')->exists($config->value)) {
            Storage::disk('public')->delete($config->value);
        }

        $path = $file->store('uploads/landing', 'public');
        WebConfig::updateOrCreate(
            ['key' => $key],
            ['value' => $path]
        );
    }
}
