<?php

use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//

Route::get('/{guard}/verify-email', [EmailVerificationController::class, 'verify'])->name('verification.verify')->where('guard', 'web|freelancer');

Route::get('confirm', function () {
    return 'تحقق من البريد يا شاطر ';
})->name('con');


// dashboard admin routes :
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // Admins
    Route::prefix('admins')->name('admins.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });
    // Users
    Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    // Freelancers
    Route::prefix('freelancers')->name('freelancers.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });
    // Verification - Users
    Route::prefix('verification/users')->name('verification.users.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });
    // Verification - Freelancers
    Route::prefix('verification/freelancers')->name('verification.freelancers.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });
    // Projects
    Route::prefix('projects')->name('projects.')->controller(ProjectController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });
});

// auth macro routes :
Route::authGuard('', 'web', 'web');
// Route::authGuard('client', 'client', 'client');
Route::authGuard('freelancer', 'freelancer', 'freelancer');
Route::authGuard('admin', 'admin', 'admin', ['register' => false]);














// Route::get('verify-email/{guard}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->where('guard', 'web|freelancer');
// Route::get('conf', function () {
//     return view('auth.confirmation');
// })->name('confirmation');


// client Routes
// Route::prefix('client/')->name('client.')->group(function () {
//     Route::controller(AuthController::class)->group(function () {
//         Route::get('login',  'indexLogin')->name('login')->defaults('guard', 'client');
//         Route::post('login',  'login')->name('login.submit')->defaults('guard', 'client');

//         Route::get('register',  'indexRegister')->name('register')->defaults('guard', 'client');
//         Route::post('register',  'register')->name('register.submit')->defaults('guard', 'client');

//         Route::get('forget-password',  'indexForgetPassword')->name('forget-password')->defaults('guard', 'client');
//         Route::post('forget-password',  'forgetPassword')->name('forget-password.submit')->defaults('guard', 'client');

//         Route::get('reset-password/{token}',  'showResetForm')->name('password.reset')->defaults('guard', 'client');
//         Route::post('reset-password', 'resetPassword')->name('password.update')->defaults('guard', 'client');

//         Route::get('dashboard', 'dashboard')->name('dashboard')->defaults('guard', 'client');
//     });
// });

// // Admin Routes
// Route::prefix('admin/')->name('admin.')->group(function () {
//     Route::controller(AuthController::class)->group(function () {
//         Route::get('login', 'indexLogin')->name('login')->defaults('guard', 'admin');
//         Route::post('login', 'login')->name('login.submit')->defaults('guard', 'admin');

//         Route::get('forget-password',  'indexForgetPassword')->name('forget-password')->defaults('guard', 'admin');
//         Route::post('forget-password',  'forgetPassword')->name('forget-password.submit')->defaults('guard', 'admin');

//         Route::get('reset-password/{token}',  'showResetForm')->name('password.reset')->defaults('guard', 'admin');
//         Route::post('reset-password', 'resetPassword')->name('password.update')->defaults('guard', 'admin');

//         Route::get('dashboard', 'dashboard')->name('dashboard')->defaults('guard', 'admin');
//     });
// });


// // Freelancer Routes
// Route::prefix('freelancer/')->name('freelancer.')->group(function () {
//     Route::controller(AuthController::class)->group(function () {
//         Route::get('login',  'indexLogin')->name('login')->defaults('guard', 'freelancer');
//         Route::post('login',  'login')->name('login.submit')->defaults('guard', 'freelancer');

//         Route::get('register',  'indexRegister')->name('register')->defaults('guard', 'freelancer');
//         Route::post('register',  'register')->name('register.submit')->defaults('guard', 'freelancer');

//         Route::get('forget-password',  'indexForgetPassword')->name('forget-password')->defaults('guard', 'freelancer');
//         Route::post('forget-password',  'forgetPassword')->name('forget-password.submit')->defaults('guard', 'freelancer');

//         Route::get('reset-password/{token}',  'showResetForm')->name('password.reset')->defaults('guard', 'freelancer');
//         Route::post('reset-password', 'resetPassword')->name('password.update')->defaults('guard', 'freelancer');

//         Route::get('dashboard', 'dashboard')->name('dashboard')->defaults('guard', 'freelancer');
//     });
// });




// User Routes
// Route::controller(AuthController::class)->group(function () {


//     Route::get('forget-password', function () {
//         return view('auth.forget-password');
//     })->name('forget-password');


//     Route::get('login',  'indexLogin')->name('web.login')->defaults('guard', 'web');
//     Route::post('login', 'login')->name('web.login.submit')->defaults('guard', 'web');

//     Route::get('register',  'indexRegister')->name('web.register')->defaults('guard', 'web');
//     Route::post('register',  'register')->name('web.register.submit')->defaults('guard', 'web');

//     Route::get('forget-password',  'indexForgetPassword')->name('forget-password')->defaults('guard', 'web');
//     Route::post('forget-password',  'forgetPassword')->name('forget-password.submit')->defaults('guard', 'web');

//     Route::get('reset-password/{token}',  'showResetForm')->name('password.reset')->defaults('guard', 'web');
//     Route::post('reset-password', 'resetPassword')->name('password.update')->defaults('guard', 'web');
//     Route::get('dashboard', 'dashboard')->name('dashboard')->defaults('guard', 'web');
// });
