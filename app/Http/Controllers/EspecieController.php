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
            'page' => ['nullable', 'integer', 'min:1', 'max:1000'],
        ]);

        $busca = trim($request->input('q', ''));
        $pagina = max(1, (int) $request->input('page', 1));
        $porPagina = 12;

        $especies = collect();
        $erroApi = false;
        $temProximaPagina = false;

        if ($busca !== '') {
            $offset = (($pagina - 1) * $porPagina) + 1;

            try {
                $consultas = [
                    'AphiaRecordsByName' => [
                        'marine_only' => 'true',
                        'like' => 'true',
                    ],
                    'AphiaRecordsByVernacular' => [
                        'like' => 'true',
                    ],
                ];

                $resultados = collect();

                foreach ($consultas as $endpoint => $parametros) {
                    $resposta = Http::timeout(15)->get(
                        $this->apiUrl . '/' . $endpoint . '/'
                        . rawurlencode($busca),
                        array_merge($parametros, [
                            'offset' => $offset,
                        ])
                    )->throw();

                    $dadosApi = $resposta->json();

                    if (is_array($dadosApi)) {
                        $resultados = $resultados->merge($dadosApi);
                    }
                }

                $resultados = $resultados
                    ->filter(fn($item) => is_array($item))
                    ->unique('AphiaID')
                    ->values();

                $especies = $resultados->take($porPagina);
                $temProximaPagina = $resultados->count() > $porPagina;

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
            'pagina' => $pagina,
            'temProximaPagina' => $temProximaPagina,
        ]);
    }

}
