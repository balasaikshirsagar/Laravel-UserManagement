<?php

use App\Http\Controllers\ProfileController as UserProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Default Laravel Breeze routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Breeze Profile Routes
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // User Management Routes
    Route::resource('users', UserController::class);
    Route::post('users/{user}/change-password', [UserController::class, 'changePassword'])->name('users.change-password');
    Route::get('users-export-excel', [UserController::class, 'exportExcel'])->name('users.export-excel');
    Route::get('users-export-pdf', [UserController::class, 'exportPdf'])->name('users.export-pdf');
    
    // Custom Profile Management
    Route::get('/my-profile', [UserProfileController::class, 'index'])->name('my-profile.index');
    Route::put('/my-profile', [UserProfileController::class, 'update'])->name('my-profile.update');
    Route::post('/my-profile/change-password', [UserProfileController::class, 'changePassword'])->name('my-profile.change-password');
});

require __DIR__.'/auth.php';