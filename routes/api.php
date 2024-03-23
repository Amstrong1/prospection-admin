<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\SuspectController;
use App\Http\Controllers\Api\ProspectController;
use App\Http\Controllers\Api\SolutionController;

Route::get('/user/{id}', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/profile/{id}', [UserController::class, 'userData']);

Route::post('/set-password', [UserController::class, 'setPassword']);
Route::post('/login', [UserController::class, 'login']);

Route::get('/home/{id}', function ($id) {
    $prospects = \App\Models\Prospect::where('user_id', $id)->count();
    $prospectsYes = \App\Models\Prospect::where('user_id', $id)->where('status', 'Oui')->count();
    $prospectsNo = \App\Models\Prospect::where('user_id', $id)->where('status', 'Non')->count();
    $prospectsInd = \App\Models\Prospect::where('user_id', $id)->where('status', 'Indecis')->count();
    $response = [
        'prospects' => $prospects,
        'prospectsYes' => $prospectsYes,
        'prospectsNo' => $prospectsNo,
        'prospectsInd' => $prospectsInd
    ];
    return $response;
});

Route::get('/prospect/{id}', [ProspectController::class, 'index']);
Route::post('/prospect', [ProspectController::class, 'store']);
Route::post('/prospect-from-suspect', [ProspectController::class, 'storeFromSuspect']);
Route::post('/prospect/{id}', [ProspectController::class, 'update']);
Route::delete('/prospect/{id}', [ProspectController::class, 'destroy']);

Route::get('/suspect/{id}', [SuspectController::class, 'index']);
Route::post('/suspect', [SuspectController::class, 'store']);
Route::post('/suspect/{id}', [SuspectController::class, 'update']);
Route::delete('/suspect/{id}', [SuspectController::class, 'destroy']);

Route::get('/report/{id}', [ReportController::class, 'index']);
Route::post('/report', [ReportController::class, 'store']);
Route::post('/report/{id}', [ReportController::class, 'update']);
Route::delete('/report/{id}', [ReportController::class, 'destroy']);

Route::get('/solution', [SolutionController::class, 'index']);
