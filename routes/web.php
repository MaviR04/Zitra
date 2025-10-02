<?php

use App\Http\Controllers\MealController;
use App\Http\Controllers\SubscriptionController;
use App\Mail\SubscriptionFinished;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;

Route::view('/', 'homepage')->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('meals', [MealController::class, 'index'])->name('meals');

Route::get('subscription', [SubscriptionController::class, 'index'])->middleware(['auth'])->name('subscription');
Route::view('checkout', 'checkout_confirm')->name('checkout_confirm');
Route::view('admin','adminpanel')->name('admin')->middleware(['auth',IsAdmin::class]);
Route::get('/test-email', function () {
    Mail::to("test@mail.com")->queue(new SubscriptionFinished());
    return 'Email sent!';
});

require __DIR__.'/auth.php';
