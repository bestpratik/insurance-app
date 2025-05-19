<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\PurchaseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('providers', ProviderController::class);
    Route::resource('insurances', InsuranceController::class);
    Route::resource('purchases', PurchaseController::class);
    Route::get('insurance/pricing/{id}', [InsuranceController::class, 'insurance_pricing'])->name('insurance.pricing');
});

require __DIR__.'/auth.php';

