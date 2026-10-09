<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;


class AnimalController extends Controller
{
   public function index()
{
    $response = Http::get(
        'https://api.inaturalist.org/v1/taxa/autocomplete?q=Chelonia%20mydas'
    );

    return $response->json();
}
}