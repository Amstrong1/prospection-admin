<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuspectController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\SolutionController;

Route::get('/', HomeController::class)->middleware(['auth', 'verified']);

Route::get('/dashboard', HomeController::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('solutions', SolutionController::class);
    Route::resource('prospects', ProspectController::class);
    Route::resource('suspects', SuspectController::class);
    Route::resource('reports', ReportController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
