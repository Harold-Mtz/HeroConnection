<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
*Route::get('/user', function (Request $request) {
 *   return $request->user();
*})->middleware('auth:sanctum');
*/

Route::post('/powers',[PowerController::class, 'store'])->middleware('auth:sanctum');
Route::get('/powers/{id}',[PowerController::class, 'getByHero']);

Route::post('login', [AuthController::class, 'login']);

