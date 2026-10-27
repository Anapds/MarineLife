<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AnimalController extends Controller
{
    private string $wormsUrl = 'https://www.marinespecies.org/rest';
    private string $iNaturalistUrl = 'https://api.inaturalist.org/v1';

    public function index(Request $request, GeminiService $gemini)
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $busca = trim($request->input('q', ''));
        $resposta = null;
        $imagemAnimal = null;
        $erroApi = false;

        if ($busca !== '') {
            try {
              
                $promptIdentificacao = <<<PROMPT
Analisa esta pesquisa de um utilizador: "{$busca}"

Identifica o animal pretendido.

Responde APENAS com JSON válido, sem Markdown:
{"identificado":true,"nome_comum":"peixe-palhaço","nome_cientifico":"Amphiprion ocellaris","ambiente":"marinho"}

Regras:
- "identificado" deve ser true apenas se conseguires identificar o animal com confiança.
- "nome_cientifico" deve ser o nome científico da espécie identificada, não de um animal semelhante.
- "ambiente" deve ser "marinho", "agua_doce", "terrestre", "outro" ou "incerto".
- Se a pesquisa não corresponder a um animal ou for ambígua, usa identificado=false e ambiente="incerto".
- Não inventes nomes científicos.
PROMPT;

                $textoIdentificacao = $gemini->perguntar($promptIdentificacao);

                $textoIdentificacao = preg_replace(
                    '/^```(?:json)?\s*|\s*```$/i',
                    '',
                    trim($textoIdentificacao)
                );

                $identificacao = json_decode($textoIdentificacao, true);

                if (
                    !is_array($identificacao)
                    || ($identificacao['identificado'] ?? false) !== true
                    || ($identificacao['ambiente'] ?? '') !== 'marinho'
                    || empty($identificacao['nome_cientifico'])
                ) {
                    $resposta = 'Não consegui confirmar que esta pesquisa corresponde a um animal marinho específico. Experimenta pesquisar por um golfinho, polvo, tubarão ou peixe-palhaço.';
                } else {
                    $nomeCientifico = trim(
                        (string) $identificacao['nome_cientifico']
                    );
                    $registos = Cache::remember(
                        'marinelife_worms_' . md5(mb_strtolower($nomeCientifico)),
                        now()->addHours(6),
                        function () use ($nomeCientifico) {
                            $response = Http::connectTimeout(5)
                                ->timeout(12)
                                ->get(
                                    $this->wormsUrl . '/AphiaRecordsByName/' . rawurlencode($nomeCientifico),
                                    [
                                        'marine_only' => 'true',
                                        'like' => 'false',
                                    ]
                                );

                            if (!$response->successful()) {
                                throw new \RuntimeException(
                                    'Não foi possível validar a espécie no WoRMS.'
                                );
                            }

                            return $response->json();
                        }
                    );

                    $nomeValidado = collect($registos)->contains(
                        function ($registo) use ($nomeCientifico) {
                            return is_array($registo)
                                && isset($registo['scientificname'])
                                && strcasecmp(
                                    $registo['scientificname'],
                                    $nomeCientifico
                                ) === 0;
                        }
                    );

                    if (!$nomeValidado) {
                        $resposta = 'Não consegui confirmar esta espécie na base de dados marinha. Tenta pesquisar pelo nome científico ou por outro nome comum.';
                    } else {
                    
                        $promptDescricao = <<<PROMPT
Escreve um texto informativo em português sobre este animal marinho confirmado:

Nome pesquisado pelo utilizador: "{$busca}"
Nome comum identificado: "{$identificacao['nome_comum']}"
Nome científico confirmado: "{$nomeCientifico}"

Regras:
- Fala apenas desta espécie específica.
- Não substituas a espécie por outra.
- Inclui habitat marinho, alimentação, características e curiosidades.
- Usa títulos, parágrafos e listas em Markdown.
- Não inventes factos. Se não souberes algo, indica essa limitação.
- Não incluas JSON nem código.
PROMPT;

                        $resposta = $gemini->perguntar($promptDescricao);

                    
                        try {
                            $fotoResponse = Http::connectTimeout(3)
                                ->timeout(8)
                                ->get(
                                    $this->iNaturalistUrl . '/taxa/autocomplete',
                                    [
                                        'q' => $nomeCientifico,
                                        'per_page' => 5,
                                    ]
                                );

                            if ($fotoResponse->successful()) {
                                $imagemAnimal = collect(
                                    $fotoResponse->json('results', [])
                                )
                                    ->first(function ($animal) use ($nomeCientifico) {
                                        return is_array($animal)
                                            && strcasecmp(
                                                $animal['name'] ?? '',
                                                $nomeCientifico
                                            ) === 0
                                            && !empty($animal['default_photo']['medium_url']);
                                    })['default_photo']['medium_url'] ?? null;
                            }
                        } catch (\Throwable $e) {
                            Log::warning(
                                'Não foi possível obter a fotografia da espécie.',
                                ['message' => $e->getMessage()]
                            );
                        }
                    }
                }
            } catch (\Throwable $e) {
                Log::error('Erro na pesquisa de animais marinhos.', [
                    'message' => $e->getMessage(),
                ]);

                $erroApi = true;
            }
        }

        return view('animais.index', [
            'busca' => $busca,
            'resposta' => $resposta,
            'imagemAnimal' => $imagemAnimal,
            'erroApi' => $erroApi,
        ]);
    }
}
