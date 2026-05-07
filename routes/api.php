<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PhotoApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes (no authentication required)
Route::get('/photos', [PhotoApiController::class, 'index']);
Route::get('/photos/search', [PhotoApiController::class, 'search']);
Route::get('/photos/{id}', [PhotoApiController::class, 'show']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    
    // Get authenticated user
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'data' => $request->user(),
        ]);
    });

    // Photo management (Creator only for create/update/delete)
    Route::post('/photos', [PhotoApiController::class, 'store']);
    Route::put('/photos/{id}', [PhotoApiController::class, 'update']);
    Route::patch('/photos/{id}', [PhotoApiController::class, 'update']);
    Route::delete('/photos/{id}', [PhotoApiController::class, 'destroy']);

    // Comments and Ratings (all authenticated users)
    Route::post('/photos/{id}/comments', [PhotoApiController::class, 'addComment']);
    Route::post('/photos/{id}/rate', [PhotoApiController::class, 'ratePhoto']);
});