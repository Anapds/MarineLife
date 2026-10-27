<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use RuntimeException;

class GeminiService
{
    public function perguntar(string $pergunta): string
    {
        $key = config('services.gemini.key');
        $model = config('services.gemini.model');

        if (empty($key) || empty($model)) {
            throw new RuntimeException(
                'A configuração do Gemini está incompleta.'
            );
        }

        $response = Http::withHeaders([
            'x-goog-api-key' => $key,
        ])
            ->acceptJson()
            ->connectTimeout(10)
            ->timeout(30)
            ->post(
                "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent",
                [
                    'contents' => [[
                        'role' => 'user',
                        'parts' => [[
                            'text' => $pergunta,
                        ]],
                    ]],
                    'generationConfig' => [
                        'temperature' => 0.3,
                        'maxOutputTokens' => 1000,
                    ],
                ]
            );

        if (!$response->successful()) {
            logger()->error('Erro na API Gemini', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            throw new RuntimeException(
                'Não foi possível obter uma resposta do Gemini.'
            );
        }

        $texto = $response->json(
            'candidates.0.content.parts.0.text'
        );

        if (!is_string($texto) || trim($texto) === '') {
            throw new RuntimeException(
                'O Gemini não devolveu uma resposta de texto.'
            );
        }

        return trim($texto);
    }
}
