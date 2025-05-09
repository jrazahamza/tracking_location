<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WebController::class, 'home'])->name('home');
Route::get('/find-location', [WebController::class, 'findLocation'])->name('find.location');
Route::get('/faqs', [WebController::class, 'faqs'])->name('faqs');
Route::get('/contact-us', [WebController::class, 'contactUs'])->name('contact-us');
Route::post('/contact-submit', [WebController::class, 'contactFormSubmission'])->name('contact.submit');



Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/contacts', [HomeController::class, 'contacts'])->name('contacts');
    Route::get('/contact-delete/{id}', [HomeController::class, 'contact_delete'])->name('contact.delete');

    Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
    Route::post('/update-profile', [HomeController::class, 'updateProfile'])->name('profile.update');
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change.password');
    Route::post('/update-password', [HomeController::class, 'updatePassword'])->name('update.password');

    Route::get('/tracking-request-form', [TrackingController::class, 'trackingRequestsForm'])->name('tracking.request.form');
    Route::get('/tracking-requests', [TrackingController::class, 'trackingRequests'])->name('tracking.requests');
    Route::post('/tracking/send', [TrackingController::class, 'sendTrackingRequest'])->name('tracking.send');
    Route::get('/track/{id}', [TrackingController::class, 'trackUser'])->name('tracking.view');
    Route::get('/approve-tracking-request/{token}', [TrackingController::class, 'approveTrackingRequest'])->name('approve.tracking.request');
    Route::post('/tracking/save-location', [TrackingController::class, 'saveLocation'])->name('tracking.save-location');
    Route::get('/tracking-history', [TrackingController::class, 'trackingHistory'])->name('tracking.history');
    Route::get('/tracking-historys', [TrackingController::class, 'trackingHistory'])->name('tracking.historys');


    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});


Route::post('/payment-complete', [PaymentController::class, 'paymentComplete'])->name('process.payment');
Route::post('/create-payment-intent', [PaymentController::class, 'createPaymentIntent'])->name('process.payment');


Route::middleware(['guest'])->group(function () {
    Route::get('register', [AuthController::class, 'register_form'])->name('register.form');
    Route::post('register', [AuthController::class, 'register'])->name('register');
    Route::get('login', [AuthController::class, 'login_form'])->name('login.form');
    Route::post('login', [AuthController::class, 'login'])->name('login');

    Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

