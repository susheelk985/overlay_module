<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriptionSettingsController;
use App\Http\Controllers\SubscriptionController;

Route::get('/', function () {
    return view('subscription');
});


Route::get('/admin/subscription-settings', [SubscriptionSettingsController::class, 'index'])->name('subscription.settings');
Route::post('/admin/subscription-settings', [SubscriptionSettingsController::class, 'store'])->name('subscription.settings.store');
Route::post('/subscribe', [SubscriptionController::class, 'store'])->name('subscribe');
