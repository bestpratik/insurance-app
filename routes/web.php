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

    Route::get('purchase-list', [PurchaseController::class, 'purchaseList'])->name('purchase.list');
    Route::get('purchase/edit/{id}', [PurchaseController::class, 'purchaselist_edit'])->name('purchase.edit');

    Route::get('insurance/pricing/{id}', [InsuranceController::class, 'insurance_pricing'])->name('insurance.pricing');
    Route::post('insurance/pricing/submit/{id}', [InsuranceController::class, 'insurance_pricing_submit'])->name('insurance.pricing.submit');

    Route::get('insurance/static-doc/{id}', [InsuranceController::class, 'static_document'])->name('insurance.static.document');
    Route::post('insurance/static/document/submit/{id}', [InsuranceController::class, 'static_document_submit'])->name('insurance.static.document.submit');
    Route::delete('insurance/static/delete/{id}', [InsuranceController::class, 'static_document_delete'])->name('insurance.static.delete');

    Route::get('insurance/dynamic-doc/{id}', [InsuranceController::class, 'dynamic_document'])->name('insurance.dynamic.document');
    Route::post('insurance/dynamic-document/submit/{id}', [InsuranceController::class, 'dynamic_document_submit'])->name('insurance.dynamic.document.submit');

    Route::get('insurance/email-template/{id}', [InsuranceController::class, 'insurance_email_template'])->name('insurance.email.template');
    Route::post('insurance/email-template/update/{id}', [InsuranceController::class, 'insurance_email_template_update'])->name('insurance.email.template.update');

    Route::get('insurance/summary/{id}', [InsuranceController::class, 'insurance_summary'])->name('insurance.summary');
    Route::get('insurance/success', [InsuranceController::class, 'success'])->name('insurance.success');
    
    Route::get('purchase/edit/{id}', function ($id) {
    return view('purchase.edit', ['id' => $id]); 
    })->name('purchase.edit');

});

require __DIR__.'/auth.php';

