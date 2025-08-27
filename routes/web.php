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
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\Projects\ProjectController as projectUserController;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\UserController as WebUserController;

Route::get('/{guard}/verify-email', [EmailVerificationController::class, 'verify'])->name('verification.verify')->where('guard', 'web|freelancer');


// dashboard admin routes :
Route::prefix('admin/')->name('admin.')->middleware(['auth:admin'])->group(function () {
    // 5 routes : index | getdata | store | update | delete
    Route::dataTableRoutesMacro('texts/', TextMailController::class, 'text');
    Route::dataTableRoutesMacro('permissions/', PermissionController::class, 'permission');
    Route::dataTableRoutesMacro('roles/', RoleController::class, 'role');
    Route::dataTableRoutesMacro('admins/', AdminController::class, 'admin');
    Route::dataTableRoutesMacro('users/', UserController::class, 'user');
    Route::dataTableRoutesMacro('freelancers/', FreelancerController::class, 'freelancer');
});




// Route::name('web.')->middleware(['auth:web'])->group(function () {
//     Route::prefix('profile')->controller(WebUserController::class)->name('profile.')->group(function () {
//         Route::get('/', 'showProfile')->name('show');
//         Route::post('update', 'update')->name('update')->defaults('guard', 'web');
//         Route::post('avatar', 'updateAvatar')->name('avatar.update');
//         Route::post('password', 'changePassword')->name('password.change');
//         Route::delete('delete', 'deleteAccount')->name('delete');
//     });

//     Route::dataTableRoutesMacro('projects/', ProjectController::class, 'project');
// });



// // auth macro routes :
// Route::authGuard('', 'web', 'web');
// Route::authGuard('freelancer', 'freelancer', 'freelancer');
// Route::authGuard('admin', 'admin', 'admin', ['register' => false]);





// //ودي السابق
Route::get('/{guard}/verify-email', [EmailVerificationController::class, 'verify'])->name('verification.verify')->where('guard', 'web|freelancer');
Route::get('confirm', function () {
    return 'تحقق من البريد يا شاطر';
})->name('con');

Route::get('file', function () {
    return view('file');
})->name('file');

Route::post('file', function (Request $request) {
    // Retrieve the admin by ID
    $admin = Admin::query()->where('id', '01k2s386tztjr3bhkksbqts905')->first();

    if (!$admin) {
        return redirect()->route('file')->with('error', 'المسؤول غير موجود');
    }

    // Generate the image name using a unique identifier
    $nameImage = 'FreeLnaGo_' . time() . '_' . rand() . '.' . $request->file('file')->getClientOriginalExtension();

    // Store the file in the 'admins' directory within 'public' disk
    $path = $request->file('file')->storeAs('admins', $nameImage, 'public');

    // Create an image record in the database and associate it with the admin
    $admin->images()->create([
        'url' => $path,
    ]);

    // Redirect back to the same page with success message
    return redirect()->route('file')->with('success', 'تم تخزين الصورة بنجاح');
});

// clinet
// Route::name('web.')->middleware(['auth:web'])->group(function () {
//     Route::prefix('profile')->controller(WebUserController::class)->name('profile.')->group(function () {
//         Route::post('update', 'update')->name('update')->defaults('guard', 'web');
//     });

//     Route::dataTableRoutesMacro('projects/', ProjectController::class, 'project');
// });


Route::prefix('web')->name('web.')->middleware('auth:web')->group(function () {
    // Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile Routes
    Route::prefix('profile')->name('profile.')->controller(WebUserController::class)->group(function () {
        Route::get('/', 'showProfile')->name('show');
        Route::post('/update', 'update')->name('update');
        Route::post('/avatar', 'updateAvatar')->name('avatar.update');
        Route::post('/password', 'changePassword')->name('password.change');
    });

    // Projects Routes
    Route::prefix('projects')->name('projects.')->controller(projectUserController::class)->group(function () {
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
