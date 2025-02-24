<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TournamentController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('tournaments', TournamentController::class)->except(['index', 'show']);
});

// Routes that don't require authentication
Route::get('/', [TournamentController::class, 'index'])->name('home');
Route::get('/tournaments/{tournament}', [TournamentController::class, 'show'])->name('tournament.show');


// Workaround for breeze authentication
Route::redirect('/dashboard', '/')->name('dashboard');
