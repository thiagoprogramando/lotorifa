<?php

use App\Http\Controllers\gatway\AssasController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('webhook', [AssasController::class, 'webhook'])->name('webhook');