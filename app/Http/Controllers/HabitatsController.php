<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HabitatsController extends Controller
{
    public function index() {
        return view('habitats.index');
    }
}
