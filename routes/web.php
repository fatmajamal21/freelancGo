<?php

use App\Http\Controllers\Auth\AdminPasswordResetController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\FreelancerPasswordResetController;
use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\Auth\UserPasswordResetController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('verify-email/{guard}', [EmailVerificationController::class, 'verify'])
    ->name('verification.verify')->where('guard', 'web|freelancer');

// User Routes
Route::controller(AuthController::class)->group(function () {
    // Login Routes
    Route::get('login', [AuthController::class, 'indexLogin'])->name('web.login')->defaults('guard', 'web');
    Route::post('login', [AuthController::class, 'login'])->name('web.login.submit')->defaults('guard', 'web');

    Route::get('register', [AuthController::class, 'indexRegister'])->name('web.register')->defaults('guard', 'web');
    Route::post('register', [AuthController::class, 'register'])->name('web.register.submit')->defaults('guard', 'web');
    Route::get('dashboard', 'dashboard')->name('dashboard')->defaults('guard', 'web');

    Route::get('/forgot-password', [UserPasswordResetController::class, 'showLinkRequestForm'])->name('client.password.request');
    Route::post('/forgot-password', [UserPasswordResetController::class, 'sendResetLinkEmail'])->name('client.password.email');
    Route::get('/reset-password/{token}', [UserPasswordResetController::class, 'showResetForm'])->name('client.password.reset');
    Route::post('/reset-password', [UserPasswordResetController::class, 'reset'])->name('client.password.update');
});




// Admin Routes
Route::prefix('admin/')->name('admin.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login',  'indexLogin')->name('login')->defaults('guard', 'admin');
        Route::post('login',  'login')->name('login.submit')->defaults('guard', 'admin');
        // Route::get('register',  'indexRegister')->name('register')->defaults('guard', 'admin');
        // Route::post('register',  'register')->name('register.submit')->defaults('guard', 'admin');
        Route::get('dashboard', 'dashboard')->name('dashboard')->defaults('guard', 'admin');


        // Route::get('/forgot-password', [AdminPasswordResetController::class, 'showLinkRequestForm'])->name('admin.password.request');
        // Route::post('/forgot-password', [AdminPasswordResetController::class, 'sendResetLinkEmail'])->name('admin.password.email');
        // Route::get('/reset-password/{token}', [AdminPasswordResetController::class, 'showResetForm'])->name('admin.password.reset');
        // Route::post('/reset-password', [AdminPasswordResetController::class, 'reset'])->name('admin.password.update');
    });
});


// Freelancer Routes
Route::prefix('freelancer/')->name('freelancer.')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get('login',  'indexLogin')->name('login')->defaults('guard', 'freelancer');
        Route::post('login',  'login')->name('login.submit')->defaults('guard', 'freelancer');
        Route::get('register',  'indexRegister')->name('register')->defaults('guard', 'freelancer');
        Route::post('register',  'register')->name('register.submit')->defaults('guard', 'freelancer');
        Route::get('dashboard', 'dashboard')->name('dashboard')->defaults('guard', 'freelancer');



        Route::get('/forgot-password', [FreelancerPasswordResetController::class, 'showLinkRequestForm'])->name('freelancer.password.request');
        Route::post('/forgot-password', [FreelancerPasswordResetController::class, 'sendResetLinkEmail'])->name('freelancer.password.email');
        Route::get('/reset-password/{token}', [FreelancerPasswordResetController::class, 'showResetForm'])->name('freelancer.password.reset');
        Route::post('/reset-password', [FreelancerPasswordResetController::class, 'reset'])->name('freelancer.password.update');
    });
});
