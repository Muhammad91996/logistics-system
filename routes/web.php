<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\PublicTrackingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\PermissionMatrixController;

// ========================
// Public Access
// ========================

// Redirect root to login
Route::get('/', fn() => redirect('/login'));

// Dashboard for verified users
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Public Shipment Tracking (outside admin area)
Route::get('/track', [PublicTrackingController::class, 'showForm'])->name('tracking.form');
Route::post('/track', [PublicTrackingController::class, 'track'])->name('tracking.search');


// ========================
// Admin Panel (Only for admin users)
// ========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Admin Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Courier Management
    Route::resource('couriers', CourierController::class);

    // Role & Permission Management
    Route::get('/roles', [AdminRoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [AdminRoleController::class, 'store'])->name('roles.store');
    Route::post('/roles/{role}/permissions', [AdminRoleController::class, 'assignPermissions'])->name('roles.assignPermissions');

    // User Management
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/assign-role', [AdminUserController::class, 'assignRole'])->name('users.assignRole');

    // Permissions Matrix
    Route::get('/permissions/matrix', [PermissionMatrixController::class, 'index'])->name('permissions.matrix');
    Route::post('/permissions/matrix/update', [PermissionMatrixController::class, 'update'])->name('permissions.matrix.update');
});


// ========================
// Authenticated Users (All Roles)
// ========================
Route::middleware(['auth'])->group(function () {
    // Shipment CRUD
    Route::resource('shipments', ShipmentController::class);

    // Personal Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
