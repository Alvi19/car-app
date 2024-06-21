<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('cars', CarController::class);
    Route::post('/toggle-availability/{car}', [CarController::class, 'toggleAvailability'])->name('cars.toggle-availability');
    Route::resource('rentals', RentalController::class);
    // Route::resource('returns', ReturnController::class);
    Route::get('/returns/create', [ReturnController::class, 'create'])->name('returns.create');
    Route::post('/returns/store', [ReturnController::class, 'store'])->name('returns.store');
    Route::get('/returns', [ReturnController::class, 'index'])->name('returns.index');
});

require __DIR__ . '/auth.php';
