<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\PublicTrackingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;
use App\Http\Controllers\Admin\PermissionMatrixController;

// Redirect root to login
Route::get('/', fn() => redirect('/login'));

// Dashboard view (only for verified users)
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// ========================
// Admin Panel (Only for admin users)
// ========================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Profile Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Courier Management
    Route::resource('couriers', CourierController::class);

    // Shipment Tracking for Admin
    Route::get('/track', [PublicTrackingController::class, 'showForm'])->name('tracking.form');
    Route::post('/track', [PublicTrackingController::class, 'track'])->name('tracking.search');

    // Roles & Permissions
    Route::get('/roles', [AdminRoleController::class, 'index'])->name('roles.index');
    Route::post('/roles/{role}/permissions', [AdminRoleController::class, 'assignPermissions'])->name('roles.assignPermissions');
    Route::post('/roles', [AdminRoleController::class, 'store'])->name('roles.store');


    // Users & Role Assignment
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::post('/users/{user}/assign-role', [AdminUserController::class, 'assignRole'])->name('users.assignRole');

    // Permission Matrix UI
    Route::get('/permissions/matrix', [PermissionMatrixController::class, 'index'])->name('permissions.matrix');
    Route::post('/permissions/matrix/update', [PermissionMatrixController::class, 'update'])->name('permissions.matrix.update');
});


// ========================
// Authenticated Users (All Roles)
// ========================
Route::middleware(['auth'])->group(function () {
    // Shipments CRUD
    Route::resource('shipments', ShipmentController::class);

    // Personal Profile Settings (non-admin)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';