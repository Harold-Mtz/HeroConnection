<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/heroes', [HeroController::class, 'store'])->middleware('auth:sanctum');
Route::get('/heroes/search/{hero}', [HeroController::class, 'searchByName']);

