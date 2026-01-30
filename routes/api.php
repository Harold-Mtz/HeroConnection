<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanetController;
use App\Http\Controllers\ImageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('planets')->group(function () {

    Route::get('/', [PlanetController::class, 'index']);
    Route::post('/', [PlanetController::class, 'store']);
    Route::get('/{planet}', [PlanetController::class, 'show']);
    Route::post('/{planet}/image', [ImageController::class, 'storeForPlanet']);
});

