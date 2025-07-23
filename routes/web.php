<?php

use App\Http\Controllers\Auth\loginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login')->defaults('guard', 'admin');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit')->defaults('guard', 'admin');
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');
});


Route::prefix('freelancer')->name('freelancer.')->group(function () {
    Route::get('login', [LoginController::class, 'index'])->name('login')->defaults('guard', 'freelancer');
    Route::post('login', [LoginController::class, 'login'])->name('login.submit')->defaults('guard', 'freelancer');
    Route::get('dashboard', function () {
        return view('freelancer.dashboard');
    })->name('dashboard');
});


Route::get('login', [LoginController::class, 'index'])->name('web.login')->defaults('guard', 'web');
Route::post('login', [LoginController::class, 'login'])->name('web.login.submit')->defaults('guard', 'web');
Route::get('dashboard', function () {
    return 'مرحبًا بك في لوحة التحكم!';
})->name('web.dashboard');
