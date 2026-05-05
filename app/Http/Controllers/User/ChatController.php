<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Psychologist;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatController extends Controller
{
    public function index()
    {
        return view('patient.chat.index');
    }

    public function sendMessage(Request $request)
    {
        try {
            // 1. Ambil API Key dan System Prompt dari database
            $settings = Setting::whereIn('key', ['ai_api_key', 'ai_system_prompt'])->pluck('value', 'key');
            $apiKey = $settings['ai_api_key'] ?? null;
            $systemPrompt = $settings['ai_system_prompt'] ?? 'Anda adalah asisten kesehatan mental profesional.';

            if (!$apiKey) {
                return response()->json(['reply' => 'API Key belum diatur di Admin Tenang.in.']);
            }

            // 2. Ambil data psikolog aktif sebagai referensi AI
            $psychologists = Psychologist::with('specializations')->where('status', 'active')
                ->get()
                ->map(function ($p) {
                    $specs = $p->specializations->pluck('name')->implode(', ');
                    return "- Nama: {$p->name}, Spesialis: {$specs}, Bio: {$p->bio}";
                })->implode("\n");

            $userMessage = trim($request->message ?? '');
            if (!$userMessage) {
                return response()->json(['reply' => 'Silakan masukkan pesan sebelum mengirim.']);
            }

            // 3. Logika Pengiriman Request (Mendukung OpenAI & Groq)
            if (str_starts_with($apiKey, 'sk-')) {
                // JIKA PAKAI OPENAI
                $url = 'https://api.openai.com/v1/chat/completions';
                $model = 'gpt-3.5-turbo';
            } else {
                // JIKA PAKAI GROQ (gsk_...)
                $url = 'https://api.groq.com/openai/v1/chat/completions';
                $model = 'llama-3.3-70b-versatile'; // Model tercepat dan gratis di Groq
            }

            $response = Http::withToken($apiKey)
                ->acceptJson()
                ->timeout(30)
                ->post($url, [
                    'model' => $model,
                    'messages' => [
                        [
                            'role' => 'system', 
                            'content' => $systemPrompt . "\n\nDATA PSIKOLOG TERSEDIA:\n" . $psychologists
                        ],
                        [
                            'role' => 'user', 
                            'content' => $userMessage
                        ],
                    ],
                    'temperature' => 0.7,
                    'max_tokens' => 1000,
                ]);

            // 4. Cek Response
            if (!$response->successful()) {
                $result = $response->json();
                $errorMessage = data_get($result, 'error.message') ?? 'Terjadi kendala pada penyedia AI.';
                return response()->json(['reply' => 'Waduh, ada kendala teknis: ' . $errorMessage]);
            }

            $result = $response->json();
            $aiResponse = data_get($result, 'choices.0.message.content');

            if ($aiResponse) {
                return response()->json(['reply' => trim(strip_tags($aiResponse))]);
            }

            return response()->json(['reply' => 'AI berhasil dihubungi tapi tidak memberikan jawaban.']);

        } catch (\Exception $e) {
            Log::error('Chat Error: ' . $e->getMessage());
            return response()->json(['reply' => 'Terjadi kesalahan pada server: ' . $e->getMessage()]);
        }
    }
}