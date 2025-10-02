<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SubscriptionController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/meals', [MealController::class, 'listMeals']);       // List all meals (MongoDB)
    Route::get('/meals/{id}', [MealController::class, 'show']);       // Get single meal
    Route::post('/meals', [MealController::class, 'store']);          // Create meal
    Route::put('/meals/{id}', [MealController::class, 'update']);     // Update meal
    Route::delete('/meals/{id}', [MealController::class, 'destroy']); // Delete meal
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/subscriptions/{id}', [SubscriptionController::class, 'show']); // single subscription
    Route::post('/subscriptions', [SubscriptionController::class, 'store']);   // create subscription
    Route::put('/subscriptions/{id}', [SubscriptionController::class, 'update']); // update subscription
    Route::delete('/subscriptions/{id}', [SubscriptionController::class, 'destroy']); // delete subscription

    // meals in subscription
    Route::get('/subscriptions/{id}/meals', [SubscriptionController::class, 'getMeals']);
});