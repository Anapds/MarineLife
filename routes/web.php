<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\OceanosController;
use App\Http\Controllers\HabitatsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index']);
Route::get('/animais', [AnimalController::class, 'index']);
Route::get('/especies', [EspecieController::class, 'index']); 
Route::get('/oceanos', [OceanosController::class, 'index']);
Route::get('/habitats', [HabitatsController::class,'index']);