<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use Illuminate\Support\Facades\Route;

// Welcome page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (role-based)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Photo routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Anyone can view photos
    Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('photos.show');
    Route::get('/search', [PhotoController::class, 'search'])->name('photos.search');
    
    // Creator only - upload/edit/delete photos
    Route::middleware(['role:creator'])->group(function () {
        Route::get('/photos/create/new', [PhotoController::class, 'create'])->name('photos.create');
        Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
        Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
        Route::put('/photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');
        Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
    });
    
    // Comments (anyone authenticated)
    Route::post('/photos/{photo}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    // Ratings (anyone authenticated)
    Route::post('/photos/{photo}/rate', [RatingController::class, 'store'])->name('ratings.store');
});

// Profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';