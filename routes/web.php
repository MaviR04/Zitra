<?php

use App\Http\Controllers\MealController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('meals', [MealController::class, 'index'])->name('meals');

Route::get('subscription', [SubscriptionController::class, 'index'])->middleware(['auth'])->name('subscription');


require __DIR__.'/auth.php';
