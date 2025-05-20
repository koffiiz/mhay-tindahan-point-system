<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\AdminSettingController;
use App\Http\Controllers\CustomerQRController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = auth()->user();
    
    return redirect()->route(
        $user->role === 'admin' ? 'admin.dashboard' : 'customer.dashboard'
    );
})->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/customers', [AdminDashboardController::class, 'customers'])->name('customers');
    Route::get('/points/{id}/{type}', [AdminDashboardController::class, 'showPointForm'])->name('points.form');
    Route::post('/points', [AdminDashboardController::class, 'storePoints'])->name('points.store');
    Route::get('/settings', [AdminSettingController::class, 'edit'])->name('settings.edit');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');
    Route::get('/customers/print', [CustomerQRController::class, 'index'])->name('customers.qr.index');
    Route::post('/customers/print/bulk', [CustomerQRController::class, 'bulkPrint'])->name('customers.qr.bulk');
});


Route::middleware(['auth', 'customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');
    Route::get('/qr-card', [CustomerDashboardController::class, 'qrCard'])->name('qr-card');
});


require __DIR__.'/auth.php';
