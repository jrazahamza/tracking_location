<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/update-profile', [HomeController::class, 'updateProfile'])->name('profile.update');
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change.password');
    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('update.password');

    Route::get('/tracking', [TrackingController::class, 'showTrackingForm'])->name('tracking.form');
    Route::post('/tracking/send', [TrackingController::class, 'sendTrackingRequest'])->name('tracking.send');
    Route::get('/track/{id}', [TrackingController::class, 'trackUser'])->name('tracking.view');
    Route::get('/approve-tracking-request/{token}', [TrackingController::class, 'approveTrackingRequest'])->name('approve.tracking.request');
    Route::post('/tracking/save-location', [TrackingController::class, 'saveLocation'])->name('tracking.save-location');
    Route::get('/tracking-history', [TrackingController::class, 'trackingHistory'])->name('tracking.history');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::middleware(['guest'])->group(function () {
    Route::get('register', [AuthController::class, 'register_form'])->name('register');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'login_form'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

// hello
// hello
// test
