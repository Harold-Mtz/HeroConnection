<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\ImageController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('powers', PowerController::class);

Route::prefix('image')->group(function () {
    Route::post('/{id}',[ImageController::class,'store']);
});
