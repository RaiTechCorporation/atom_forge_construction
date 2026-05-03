<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\InvestorController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\ProjectController;

Route::middleware(['auth:sanctum'])->as('api.')->group(function () {
    // Admin routes
    Route::prefix('admin')->as('admin.')->group(function () {
        Route::get('/dashboard-stats', [AdminController::class, 'dashboardStats']);
        Route::get('/roles', [AdminController::class, 'getRoles']);
        Route::get('/users', [AdminController::class, 'getUsers']);
        Route::post('/users', [AdminController::class, 'storeUser']);
        Route::put('/users/{user}', [AdminController::class, 'updateUser']);
        Route::delete('/users/{user}', [AdminController::class, 'deleteUser']);
        Route::patch('/users/{user}/role', [AdminController::class, 'updateUserRole']);
        Route::apiResource('projects', ProjectController::class);
        Route::apiResource('plans', PlanController::class);
    });

    // Investor routes
    Route::middleware(['role:investor'])->prefix('investor')->as('investor.')->group(function () {
        Route::get('/dashboard', [InvestorController::class, 'dashboard']);
    });

    // Client routes
    Route::middleware(['role:client'])->prefix('client')->as('client.')->group(function () {
        Route::get('/dashboard', [ClientController::class, 'dashboard']);
    });
});
