<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\ProspectController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/set-password', [UserController::class, 'setPassword']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/prospect', [ProspectController::class, 'index']);
Route::get('/prospect/{id}', [ProspectController::class, 'show']);
Route::post('/prospect', [ProspectController::class, 'store']);
Route::post('/prospect/{id}', [ProspectController::class, 'update']);
Route::delete('/prospect/{id}', [ProspectController::class, 'destroy']);

Route::get('/report', [ReportController::class, 'index']);
Route::get('/report/{id}', [ReportController::class, 'show']);
Route::post('/report', [ReportController::class, 'store']);
Route::post('/report/{id}', [ReportController::class, 'update']);
Route::delete('/report/{id}', [ReportController::class, 'destroy']);
