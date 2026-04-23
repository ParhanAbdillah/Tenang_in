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
    public function sendMessage(Request $request)
    {
        try {
            $apiKey = Setting::where('key', 'ai_api_key')->first()?->value;
            $systemPrompt = Setting::where('key', 'ai_system_prompt')->first()?->value;

            if (!$apiKey) {
                return response()->json(['reply' => 'API Key belum diatur di Admin Tenang.in.']);
            }

            if (!$systemPrompt) {
                return response()->json(['reply' => 'AI System Prompt belum diatur di Admin Tenang.in.']);
            }

            $psychologists = Psychologist::where('status', 'active')
                ->get(['name', 'specialization', 'bio'])
                ->map(function ($p) {
                    return "- Nama: {$p->name}, Spesialis: {$p->specialization}, Bio: {$p->bio}";
                })->implode("\n");

            $userMessage = trim($request->message ?? '');
            if (!$userMessage) {
                return response()->json(['reply' => 'Silakan masukkan pesan sebelum mengirim.']);
            }

            $instruction = $systemPrompt . "\n\nDATA PSIKOLOG TERSEDIA:\n" . $psychologists . "\n\nPERTANYAAN USER:\n" . $userMessage;

            if (str_starts_with($apiKey, 'sk-')) {
                $response = Http::withToken($apiKey)
                    ->acceptJson()
                    ->timeout(30)
                    ->post('https://api.openai.com/v1/chat/completions', [
                        'model' => 'gpt-3.5-turbo',
                        'messages' => [
                            ['role' => 'system', 'content' => $systemPrompt],
                            ['role' => 'user', 'content' => "DATA PSIKOLOG TERSEDIA:\n{$psychologists}\n\nPERTANYAAN USER:\n{$userMessage}"],
                        ],
                        'temperature' => 0.7,
                        'top_p' => 0.95,
                        'max_tokens' => 1000,
                        'n' => 1,
                    ]);
            } else {
                $response = Http::acceptJson()
                    ->timeout(30)
                    ->post("https://generativelanguage.googleapis.com/v1/models/gemini-1.5-pro:generateText?key={$apiKey}", [
                        'prompt' => [
                            'text' => $instruction,
                        ],
                        'temperature' => 0.7,
                        'topP' => 0.95,
                        'topK' => 40,
                        'maxOutputTokens' => 1000,
                        'candidateCount' => 1,
                    ]);
            }

            if (!$response->successful()) {
                $result = $response->json();
                $errorMessage = data_get($result, 'error.message') ?? ($response->body() ?: 'Unknown response from AI');
                return response()->json(['reply' => 'Waduh, ada kendala teknis: ' . $errorMessage]);
            }

            $result = $response->json();
            $aiResponse = data_get($result, 'choices.0.message.content')
                ?? data_get($result, 'choices.0.text')
                ?? data_get($result, 'candidates.0.output.0.content.0.text')
                ?? data_get($result, 'candidates.0.content.0.text')
                ?? data_get($result, 'candidates.0.message.content')
                ?? data_get($result, 'output.0.content.0.text')
                ?? data_get($result, 'text')
                ?? data_get($result, 'generatedText');

            if ($aiResponse) {
                return response()->json(['reply' => strip_tags($aiResponse)]);
            }

            Log::debug('AI response tidak terduga', ['result' => $result]);
            return response()->json(['reply' => 'AI berhasil dihubungi tapi tidak memberikan jawaban. Coba kalimat lain ya!']);
        } catch (\Exception $e) {
            return response()->json(['reply' => 'Terjadi kesalahan pada server: ' . $e->getMessage()]);
        }
    }
}
