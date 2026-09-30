<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OceanosController extends Controller
{
    public function index() {
        return view('oceanos.index');
    }
}
