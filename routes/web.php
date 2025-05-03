<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\DonorController as AdminDonorController;
use App\Http\Controllers\Admin\DonationController as AdminDonationController;
use App\Http\Controllers\Admin\InventoryController as AdminInventoryController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\Donor\DashboardController as DonorDashboardController;
use App\Http\Controllers\Donor\ProfileController as DonorProfileController;
use App\Http\Controllers\Donor\DonationController as DonorDonationController;
use App\Http\Controllers\Donor\ScheduleController as DonorScheduleController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\BloodInventoryController;
use App\Models\Donor;
use App\Models\Donation;
use App\Models\BloodInventory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Schema;

// Direct logout route
Route::get('/logout', function () {
    auth()->logout();
    return redirect('/');
})->name('logout');

Route::get('/', function () {
    return inertia('Welcome');
})->name('welcome');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('donors', AdminDonorController::class);
    Route::resource('donations', AdminDonationController::class);
    Route::resource('inventory', AdminInventoryController::class);
    Route::resource('reports', AdminReportController::class);
});

Route::middleware(['auth', 'role:donor'])->prefix('donor')->name('donor.')->group(function () {
    Route::get('/dashboard', [DonorDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DonorProfileController::class, 'index'])->name('profile');
    Route::get('/donations', [DonorDonationController::class, 'index'])->name('donations');
    Route::get('/schedule', [DonorScheduleController::class, 'index'])->name('schedule');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Donor Management Routes
    Route::get('/donors', [DonorController::class, 'index'])->name('donors.index');
    Route::get('/donors/create', [DonorController::class, 'create'])->name('donors.create');
    Route::post('/donors', [DonorController::class, 'store'])->name('donors.store');
    Route::get('/donors/{donor}/edit', [DonorController::class, 'edit'])->name('donors.edit');
    Route::put('/donors/{donor}', [DonorController::class, 'update'])->name('donors.update');
    Route::delete('/donors/{donor}', [DonorController::class, 'destroy'])->name('donors.destroy');

    // Donation Management Routes
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/create', [DonationController::class, 'create'])->name('donations.create');
    Route::post('/donations', [DonationController::class, 'store'])->name('donations.store');
    Route::get('/donations/{donation}/edit', [DonationController::class, 'edit'])->name('donations.edit');
    Route::put('/donations/{donation}', [DonationController::class, 'update'])->name('donations.update');
    Route::delete('/donations/{donation}', [DonationController::class, 'destroy'])->name('donations.destroy');

    // Blood Inventory Routes
    Route::get('/blood-inventory', [BloodInventoryController::class, 'index'])->name('blood-inventory.index');
    Route::get('/blood-inventory/create', [BloodInventoryController::class, 'create'])->name('blood-inventory.create');
    Route::post('/blood-inventory', [BloodInventoryController::class, 'store'])->name('blood-inventory.store');
    Route::get('/blood-inventory/{unit}/edit', [BloodInventoryController::class, 'edit'])->name('blood-inventory.edit');
    Route::put('/blood-inventory/{unit}', [BloodInventoryController::class, 'update'])->name('blood-inventory.update');
    Route::delete('/blood-inventory/{unit}', [BloodInventoryController::class, 'destroy'])->name('blood-inventory.destroy');
});

require __DIR__.'/auth.php';
