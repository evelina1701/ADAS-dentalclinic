<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\VisitController;
use App\Http\Controllers\Admin\MedicalRecordController;

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

Route::middleware(['auth'])->prefix('admin')->group(function () {
        // Manage Patients page: only accessible if user has "view patients"
        Route::get('/patients', [PatientController::class, 'index'])
             ->name('admin.patients.index')
             ->middleware('permission:view patients');
    
        // Create Patient routes: accessible if user has "create patients"
        Route::get('/patients/create', [PatientController::class, 'create'])
             ->name('admin.patients.create')
             ->middleware('permission:create patients');
        Route::post('/patients', [PatientController::class, 'store'])
             ->name('admin.patients.store')
             ->middleware('permission:create patients');
    
        // Edit Patient routes: accessible if user has "edit patients"
        Route::get('/patients/{patient}/edit', [PatientController::class, 'edit'])
             ->name('admin.patients.edit')
             ->middleware('permission:edit patients');
        Route::put('/patients/{patient}', [PatientController::class, 'update'])
             ->name('admin.patients.update')
             ->middleware('permission:edit patients');
    
        // Delete Patient route: accessible if user has "delete patients"
        Route::delete('/patients/{patient}', [PatientController::class, 'destroy'])
             ->name('admin.patients.destroy')
             ->middleware('permission:delete patients');

        Route::get('/patients/personal-codes', [PatientController::class, 'fetchCodes'])
             ->name('patients.fetchCodes');
         
    });
    
Route::middleware(['auth'])->prefix('admin')->group(function () {
     // Manage Visits: only if the user has "view appointments" permission.
     Route::get('/visits', [VisitController::class, 'index'])
          ->name('admin.visits.index')
          ->middleware('permission:view appointments');
 
     // Create Visit: requires "create appointments" permission.
     Route::get('/visits/create', [VisitController::class, 'create'])
          ->name('admin.visits.create')
          ->middleware('permission:create appointments');
     Route::post('/visits', [VisitController::class, 'store'])
          ->name('admin.visits.store')
          ->middleware('permission:create appointments');
 
     // Edit Visit: requires "edit appointments" permission.
     Route::get('/visits/{visit}/edit', [VisitController::class, 'edit'])
          ->name('admin.visits.edit')
          ->middleware('permission:edit appointments');
     Route::put('/visits/{visit}', [VisitController::class, 'update'])
          ->name('admin.visits.update')
          ->middleware('permission:edit appointments');
 
     // Delete Visit: requires "delete appointments" permission.
     Route::delete('/visits/{visit}', [VisitController::class, 'destroy'])
          ->name('admin.visits.destroy')
          ->middleware('permission:delete appointments');
 });

Route::middleware(['auth'])->prefix('admin')->group(function () {
     // Manage Medical Records: Only users with "view medical records" can list records.
     Route::get('/medical-records', [MedicalRecordController::class, 'index'])
          ->name('admin.medical_records.index')
          ->middleware('permission:view medical records');
 
     // Create Medical Record: Only if user has "create medical records" permission.
     Route::get('/medical-records/create', [MedicalRecordController::class, 'create'])
          ->name('admin.medical_records.create')
          ->middleware('permission:create medical records');
     Route::post('/medical-records', [MedicalRecordController::class, 'store'])
          ->name('admin.medical_records.store')
          ->middleware('permission:create medical records');
 
     // Edit Medical Record: Only if user has "edit medical records" permission.
     Route::get('/medical-records/{medicalRecord}/edit', [MedicalRecordController::class, 'edit'])
          ->name('admin.medical_records.edit')
          ->middleware('permission:edit medical records');
     Route::put('/medical-records/{medicalRecord}', [MedicalRecordController::class, 'update'])
          ->name('admin.medical_records.update')
          ->middleware('permission:edit medical records');
 
     // Delete Medical Record: Only if user has "delete medical records" permission.
     Route::delete('/medical-records/{medicalRecord}', [MedicalRecordController::class, 'destroy'])
          ->name('admin.medical_records.destroy')
          ->middleware('permission:archive medical records');
 });
require __DIR__.'/auth.php';
