<?php

use App\Models\User;
use App\Models\Report;
use App\Models\Prospect;
use App\Models\Solution;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\SolutionController;

Route::get('/', function () {
    $reports = Report::count();
    $solutions = Solution::count();
    $prospects = Prospect::count();
    $users = User::where('is_admin', false)->count();
    return view('dashboard', compact('users', 'reports', 'solutions', 'prospects'));
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    $reports = Report::count();
    $solutions = Solution::count();
    $prospects = Prospect::count();
    $users = User::where('is_admin', false)->count();
    return view('dashboard', compact('users', 'reports', 'solutions', 'prospects'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('solutions', SolutionController::class);
    Route::resource('prospects', ProspectController::class);
    Route::resource('reports', ReportController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
