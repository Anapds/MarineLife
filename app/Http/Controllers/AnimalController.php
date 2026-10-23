<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class AnimalController extends Controller
{
    private string $apiUrl = 'https://api.inaturalist.org/v1';

    private string $wormsUrl = 'https://www.marinespecies.org/rest';

    public function index(Request $request)
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $busca = trim($request->input('q', ''));

        $animais = collect();
        $erroApi = false;

        if ($busca !== '') {
            try {
                $dados = Cache::remember(
                    'marinelife_animais_v2_' . md5(mb_strtolower($busca)),
                    now()->addMinutes(30),
                    function () use ($busca) {
                        $resposta = Http::timeout(15)
                            ->get($this->apiUrl . '/taxa/autocomplete', [
                                'q' => $busca,
                                'rank' => 'species',
                                'per_page' => 24,
                            ])
                            ->throw();

                        $candidatos = collect(
                            $resposta->json('results', [])
                        );

                        $gruposAceitos = [
                            'Mollusca',
                            'Mammalia',
                            'Reptilia',
                            'Aves',
                            'Actinopterygii',
                            'Chondrichthyes',
                            'Annelida',
                            'Cnidaria',
                            'Echinodermata',
                            'Porifera',
                        ];

                        return $candidatos
                            ->filter(function ($animal) use ($gruposAceitos) {
                                return is_array($animal)
                                    && in_array(
                                        $animal['iconic_taxon_name'] ?? '',
                                        $gruposAceitos,
                                        true
                                    )
                                    && !empty($animal['name']);
                            })
                            ->map(function ($animal) {
                                return [
                                    'id' => $animal['id'] ?? null,
                                    'name' => $animal['name'] ?? null,
                                    'preferred_common_name' =>
                                        $animal['preferred_common_name'] ?? null,
                                    'rank' => $animal['rank'] ?? null,
                                    'default_photo' =>
                                        $animal['default_photo'] ?? null,
                                ];
                            })
                            ->values()
                            ->all();
                    }
                );

                $validos = collect($dados)->filter(function ($animal) {
                    if (empty($animal['name'])) {
                        return false;
                    }

                    $resposta = Http::timeout(10)->get(
                        $this->wormsUrl . '/AphiaRecordsByName/'
                            . rawurlencode($animal['name']),
                        [
                            'marine_only' => 'true',
                            'like' => 'false',
                        ]
                    );

                    if (!$resposta->successful()) {
                        return false;
                    }

                    $registros = $resposta->json();

                    return is_array($registros)
                        && collect($registros)->isNotEmpty();
                });

                $animais = $validos->values();

            } catch (\Throwable $e) {
                report($e);
                $erroApi = true;
            }
        }

        return view('animais.index', [
            'animais' => $animais,
            'busca' => $busca,
            'erroApi' => $erroApi,
        ]);
    }
}
