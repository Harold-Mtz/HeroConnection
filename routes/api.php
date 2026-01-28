<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HeroController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/heroes', [HeroController::class, 'store']);
Route::get('/heroes/search/{hero}', [HeroController::class, 'searchByName']);
Route::post('/heroes/{heroId}/image', [ImageController::class, 'store']);
