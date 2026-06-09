<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthApiController;

Route::post('/register', [AuthApiController::class, 'register']);
Route::post('/login', [AuthApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    
    // POST /api/user/logout
    Route::post('/user/logout', [AuthApiController::class, 'logout']);
    
    // GET /api/user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
});