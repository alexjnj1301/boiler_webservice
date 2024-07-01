<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PixelController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/documents', [DocumentController::class, 'index']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::put('/pixels', [PixelController::class, 'update']);
Route::get('/pixels', [PixelController::class, 'index']);
