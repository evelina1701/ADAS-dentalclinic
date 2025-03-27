<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController; // if you have a separate RoleController

// Login route
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login'); // Redirect to login page
});

Route::get('/dashboard', function () {
    // if (auth()->check() && auth()->user()->hasRole('admin')) {
    //     return redirect()->route('admin.users.index');
    // }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Disable the registration routes (if Auth::routes() is used)
// Auth::routes(['register' => false]);

Route::middleware(['auth', 'admin_mw'])->prefix('admin')->group(function () {

    // User management routes
    Route::get('/users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.users.index');
    Route::get('/users/create', [\App\Http\Controllers\Admin\UserController::class, 'create'])->name('admin.users.create');
    Route::post('/users', [\App\Http\Controllers\Admin\UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{user}/edit', [\App\Http\Controllers\Admin\UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('admin.users.destroy');

    // Role & permission management (optional)
    Route::get('/roles', [\App\Http\Controllers\Admin\RoleController::class, 'index'])->name('admin.roles.index');
    Route::get('/roles/{role}/edit', [\App\Http\Controllers\Admin\RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/roles/{role}', [\App\Http\Controllers\Admin\RoleController::class, 'update'])->name('admin.roles.update');
});

Route::middleware(['auth', 'permission:change role permissions'])
    ->prefix('admin')
    ->group(function () {

        // Role & permission management
        Route::get('/roles', [RoleController::class, 'index'])->name('admin.roles.index');
        Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
        Route::put('/roles/{role}', [RoleController::class, 'update'])->name('admin.roles.update');
    });

Route::middleware(['auth'])->prefix('admin')->group(function () {
        // Only users with "view users" can see the list:
        Route::get('/users', [UserController::class, 'index'])
             ->name('admin.users.index')
             ->middleware('permission:view users');
    
        // Only users with "create users" can access the create form and store action:
        Route::get('/users/create', [UserController::class, 'create'])
             ->name('admin.users.create')
             ->middleware('permission:create users');
        Route::post('/users', [UserController::class, 'store'])
             ->name('admin.users.store')
             ->middleware('permission:create users');
    
        // Only users with "edit users" can access the edit form and update action:
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])
             ->name('admin.users.edit')
             ->middleware('permission:edit users');
        Route::put('/users/{user}', [UserController::class, 'update'])
             ->name('admin.users.update')
             ->middleware('permission:edit users');
    
        // Only users with "delete users" can delete:
        Route::delete('/users/{user}', [UserController::class, 'destroy'])
             ->name('admin.users.destroy')
             ->middleware('permission:delete users');
    });
require __DIR__.'/auth.php';
