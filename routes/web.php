<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\Freelancer\FreelancerController;
use App\Http\Controllers\Admin\Permissions\PermissionController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\EmailVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\Role\RoleController;
use App\Http\Controllers\Admin\Text\TextMail;
use App\Http\Controllers\Admin\Text\TextMailController;
use App\Http\Controllers\Admin\Verification\FreelancerrVerificationController;
use App\Http\Controllers\Admin\Verification\FreelancerVerificationController;
use App\Http\Controllers\Admin\Verification\UesrVerificationController;
use App\Http\Controllers\Admin\Verification\UserVerificationController;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use Illuminate\Http\Request;

Route::get('/{guard}/verify-email', [EmailVerificationController::class, 'verify'])->name('verification.verify')->where('guard', 'web|freelancer');

Route::get('confirm', function () {
    return 'تحقق من البريد يا شاطر';
})->name('con');



Route::get('file', function () {
    return view('file');
});

Route::post('file', function (Request $request) {
    // Retrieve the admin by ID
    $admin = Admin::query()->where('id', '01k2f3n5cpb5zjhhbx097zw5we')->first();

    // Generate the image name using a unique identifier
    $nameImage = 'FreeLnaGo_' . time() . '_' . rand() . '.' .  $request->file('file')->getClientOriginalExtension();

    // Store the file in the 'admins' directory within 'public' disk
    $path = $request->file('file')->storeAs('admins', $nameImage, 'public');

    // Create an image record in the database and associate it with the admin
    $admin->images()->create([
        'url' => $path,
    ]);

    // Use dd() to dump and die, checking the admin data and related image
    dd($admin->images);  // This will show the related images for the admin

    return 'تم تخزين الصورة ';
})->name('file');






// Routes for admin dashboard
Route::prefix('admin')->name('admin.')->middleware('auth:admin')->group(function () {
    // Dashboard Route
    Route::get('/panel', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboardadmin');


    Route::get('/texts', [TextMailController::class, 'index'])->name('text.index');
    Route::post('/texts', [TextMailController::class, 'store'])->name('text.store');



    // لإحضار المستخدمين للجدول
    Route::get('/users/data', [TextMailController::class, 'getdata'])->name('user.getdata');


    // Route::prefix('texts/')->controller(TextMailController::class)->name('text.')->group(function () {
    //     Route::get('/', 'index')->name('index');
    //     Route::get('/getdata', 'getdata')->name('getdata');
    //     Route::post('/store', 'store')->name('store');
    //     Route::post('/update', 'update')->name('update');
    //     Route::post('/delete', 'delete')->name('delete');
    // });

    // Permissions Routes
    Route::prefix('permissions/')->controller(PermissionController::class)->name('permission.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    // Roles Routes
    Route::prefix('roles/')->controller(RoleController::class)->name('role.')->group(function () {
        // Route to get role data for editing (including guards and permissions)
        Route::get('/{id}/edit')->name('edit');

        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    // Verification - Freelancers
    Route::prefix('verification/freelancers')->name('verification.freelancers.')->controller(FreelancerVerificationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/toggle', 'toggle')->name('toggle');
        Route::post('/delete', 'delete')->name('delete');
    });

    // Verification - Users
    Route::prefix('verification/users')->name('verification.users.')->controller(UserVerificationController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/toggle', 'toggle')->name('toggle');
        Route::post('/delete', 'delete')->name('delete');
    });

    // Admins Routes
    Route::prefix('admins')->name('admins.')->controller(AdminController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    // Users Routes
    Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    // Freelancers Routes
    Route::prefix('freelancers')->name('freelancers.')->controller(FreelancerController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    // Projects Routes
    Route::prefix('projects')->name('projects.')->controller(ProjectController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/getdata', 'getdata')->name('getdata');
        Route::post('/store', 'store')->name('store');
        Route::post('/update', 'update')->name('update');
        Route::post('/delete', 'delete')->name('delete');
    });

    // Proposals Routes
    Route::prefix('proposals')->name('proposals.')->controller(\App\Http\Controllers\Admin\ProposalController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
    });
});

// Route to get guards
Route::get('/admin/guards', function () {
    return response()->json(['admin', 'web']);  // إرجاع قائمة المستحقين المتاحة
})->name('admin.role.getGuards');

// Authentication routes
Route::authGuard('', 'web', 'web');
Route::authGuard('freelancer', 'freelancer', 'freelancer');
Route::authGuard('admin', 'admin', 'admin', ['register' => false]);
