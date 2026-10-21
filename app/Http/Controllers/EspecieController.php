<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class EspecieController extends Controller
{
    private string $apiUrl = 'https://www.marinespecies.org/rest';

    public function index(Request $request)
    {
        $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
        ]);

        $busca = trim($request->input('q', ''));
        $especies = collect();
        $erroApi = false;

        if ($busca !== '') {
            // A versão v2 evita reutilizar o cache antigo.
            $cacheKey = 'marinelife_especies_v2_' . md5(
                mb_strtolower($busca)
            );

            try {
                $dados = Cache::remember(
                    $cacheKey,
                    now()->addMinutes(30),
                    function () use ($busca) {
                        $resultados = collect();

                        $consultas = [
                            'AphiaRecordsByName' => [
                                'marine_only' => 'true',
                                'like' => 'true',
                            ],
                            'AphiaRecordsByVernacular' => [
                                'like' => 'true',
                            ],
                        ];

                        foreach ($consultas as $endpoint => $parametros) {
                            $resposta = Http::timeout(15)->get(
                                $this->apiUrl . '/' . $endpoint . '/'
                                    . rawurlencode($busca),
                                $parametros
                            )->throw();

                            $dadosApi = $resposta->json();

                            if (is_array($dadosApi)) {
                                $resultados = $resultados->merge(
                                    $dadosApi
                                );
                            }
                        }

                        // Guarda arrays simples no cache, não a Collection.
                        return $resultados
                            ->filter(fn ($item) => is_array($item))
                            ->unique('AphiaID')
                            ->take(50)
                            ->values()
                            ->all();
                    }
                );

                // Converte os dados recuperados em Collection.
                $especies = collect($dados);
                
            } catch (\Throwable $e) {
                report($e);

                $erroApi = true;
                $especies = collect();
            }
        }

        return view('especies.index', [
            'especies' => $especies,
            'busca' => $busca,
            'erroApi' => $erroApi,
        ]);
    }
}
