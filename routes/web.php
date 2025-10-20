<?php

use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\FactController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\ContactformController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\InsuranceController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('home');
    //return redirect('/login');
});

Route::get('/login', function () {
    //return view('welcome');
    return redirect('/login'); 
});

/*Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware(['auth', 'verified'])->name('dashboard'); 
*/



Route::get('/', [FrontController::class, 'home'])->name('home');
Route::get('about-us', [FrontController::class, 'about'])->name('about.us');
Route::get('contact-us', [FrontController::class, 'contact'])->name('contact.us');
Route::get('service', [FrontController::class, 'services'])->name('service');
Route::get('/service/{slug}', [FrontController::class, 'service_details'])->name('service.details'); 
// Route::get('policy-buyer', [FrontController::class, 'policyBuyer'])->name('policy.buyer');
Route::get('policy-buyer/{slug}', [FrontController::class, 'policyBuyer'])->name('policy.buyer');  
Route::get('referral-form', [FrontController::class, 'referralForm'])->name('referral.form');
Route::get('policy-referral-form', [FrontController::class, 'policy_referral_form'])->name('policy.referral.form'); 

Route::get('user-register', [FrontController::class, 'userSignin'])->name('user.register');
Route::post('user-register-submit', [FrontController::class, 'user_register_submit'])->name('user.register.submit');
Route::get('user-login', [FrontController::class, 'userLogin'])->name('user.login'); 
Route::post('user-login-submit', [FrontController::class, 'loginSubmit'])->name('user.login.submit');
// Route::get('front-dashboard', [FrontController::class, 'frontDashboard'])->name('dashboard.frontend');

Route::get('login/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('social.login');
Route::get('login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

// Route::get('/user-login/facebook', [SocialiteController::class, 'redirectToProvider']);
// Route::get('/user-login/facebook/callback', [SocialiteController::class, 'handleProviderCallback']);

/**
 * Social Login
 */
Route::get('auth/google', [FrontController::class, 'googleLogin'])->name('auth.google'); 
Route::get('auth/google-callback', [FrontController::class, 'googleAuthentication'])->name('auth.google-callback');

Route::get('auth/facebook', [FrontController::class, 'facebookLogin'])->name('auth.facebook');
Route::get('auth/facebook-callback', [FrontController::class, 'facebookAuthentication'])->name('auth.facebook-callback');


Route::post('/stripe/webhook', [StripePaymentController::class, 'handleWebhook']);

Route::get('/stripe/success', [StripePaymentController::class, 'success'])->name('stripe.success');
Route::get('/stripe/cancel', [StripePaymentController::class, 'cancel'])->name('stripe.cancel');

Route::get('forgotpassword', [FrontController::class, 'forgot_password'])->name('forgot.pass'); 
Route::post('send-mail', [FrontController::class, 'validate_forgotpass'])->name('validate.pass'); 
Route::get('reset-pass/{token}', [FrontController::class, 'showResetPassword'])->name('reset.password'); 
Route::post('submit-reset-Password', [FrontController::class, 'submitResetPassword'])->name('reset.Password.submit'); 

Route::get('terms-conditions', [FrontController::class, 'termsConditions'])->name('terms.conditions');

Route::middleware(['auth'])->group(function () {
    Route::get('front-dashboard', [FrontController::class, 'frontDashboard'])->name('dashboard.frontend');
    Route::get('active-insurance', [FrontController::class, 'active_insurance'])->name('active.insurance');  
    Route::get('inactive-insurance', [FrontController::class, 'inactive_insurance'])->name('inactive.insurance');
    Route::get('cancel-insurance', [FrontController::class, 'cancel_insurance'])->name('cancel.insurance');


    Route::get('front-purchase-success', [FrontController::class, 'frontSuccessPage'])->name('front.purchase.success'); 
    Route::get('referral-purchase-success', [FrontController::class, 'referralSuccessPage'])->name('referral.purchase.success'); 
  
    Route::get('fornt-logout', [FrontController::class, 'logout'])->name('user.logout'); 

    Route::get('policy-detail-page/{id}', [FrontController::class, 'policyDetailPage'])->name('policy.detail.page'); 




 
    Route::get('/stripe/booking', [StripePaymentController::class, 'booking'])->name('stripe.booking');
    



   
});


  Route::get('policy-referral/success', [FrontController::class, 'policyReferralSuccessPage'])->name('policy-referral.success');  


// Route::get('policy-referral/success/{purchase_id}', [FrontController::class, 'policyReferralSuccessPage'])
//     ->name('policy-referral.success');


// Route::middleware(['auth'])->group(function () {

//     Route::get('front-dashboard', function () {
//         if (Auth::check() && Auth::user()->type === 'user') {
//             return app(FrontController::class)->frontDashboard();
//         }
//         return redirect('/dashboard')->with('error', 'Unauthorized access.');
//     })->name('dashboard.frontend');

//     Route::get('user/logout', function () {
//         session()->forget('user_login');
//         session()->forget('logged_in_user');
//         return redirect('user-login')->with('success', 'Successfully logged out'); 
//     });
// });

Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard'); 

Route::get('insurance-invoice/{purchase_id}', [PurchaseController::class, 'downloadInvoice'])->name('insurance.invoice.genarate');
Route::get('referral-invoice/{purchase_id}', [PurchaseController::class, 'referralDownloadInvoice'])->name('referral.invoice.genarate');

    // Route::get('/insurance/static-document/pdf/{id}', [PurchaseController::class, 'generateStaticDocumentPdf'])->name('static.document.generate.pdf');

    // Route::get('insurance/document/{id}', [PurchaseController::class, 'downloadDynamicDocument'])->name('insurance.document.download');
Route::get('/insurance-document-download/{purchase_id}/{document_id}', [PurchaseController::class, 'downloadDynamicDocument'])->name('insurance.document.download');
Route::get('/referral-document-download/{purchase_id}/{document_id}', [PurchaseController::class, 'referralDownloadDynamicDocument'])->name('referral.document.download');


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('providers', ProviderController::class);
    Route::resource('insurances', InsuranceController::class);   
    Route::resource('purchases', PurchaseController::class);  

    /*All Purchase List*/

    Route::get('/all-purchase-list', function () { 
        return view('purchase.all_list'); 
    })->name('purchase.list');  

    Route::get('/all-referral-list', function () { 
        return view('purchase.referral_list'); 
    })->name('referral.list');  


    Route::get('/all-purchase-cancel-list', function () {
        return view('purchase.all_cancel_list');
    })->name('purchase.cancel.list'); 

    //Route::get('purchase-list', [PurchaseController::class, 'purchaseList'])->name('purchase.list');
    Route::get('purchase/edit/{policy_no}', [PurchaseController::class, 'purchaselist_edit'])->name('purchase.edit'); 
    // Route::get('purchase-success', [PurchaseController::class, 'successPage'])->name('purchase.success');

    Route::get('purchase-success/{id}', [PurchaseController::class, 'successPage'])->name('purchase.success');   
    Route::get('purchase/details/{id}', [PurchaseController::class, 'detailsPage'])->name('purchase.details');   

    Route::get('referral/details/{id}', [PurchaseController::class, 'referralDetailsPage'])->name('referral.details');   

    Route::get('referral-pdf/{id}', [PurchaseController::class, 'referrralForm_pdf'])->name('referral.download');

    Route::get('insurance/pricing/{uuid}', [InsuranceController::class, 'insurance_pricing'])->name('insurance.pricing');
    Route::post('insurance/pricing/submit/{uuid}', [InsuranceController::class, 'insurance_pricing_submit'])->name('insurance.pricing.submit');

    Route::get('insurance/static-doc/{uuid}', [InsuranceController::class, 'static_document'])->name('insurance.static.document');
    Route::post('insurance/static/document/submit/{uuid}', [InsuranceController::class, 'static_document_submit'])->name('insurance.static.document.submit');
    Route::delete('insurance/static/delete/{id}', [InsuranceController::class, 'static_document_delete'])->name('insurance.static.delete');

    Route::get('insurance/dynamic-doc/{id}', [InsuranceController::class, 'dynamic_document'])->name('insurance.dynamic.document');
    Route::post('insurance/dynamic-document/submit/{id}', [InsuranceController::class, 'dynamic_document_submit'])->name('insurance.dynamic.document.submit');
    Route::delete('insurance/dynamic/delete/{id}', [InsuranceController::class, 'dynamic_document_delete'])->name('insurance.dynamic.delete');
    Route::put('insurance/dynamic/update/{id}/{insurancedynamicdocId}', [InsuranceController::class, 'dynamic_document_update'])->name('insurance.dynamic.update');

    Route::get('insurance/email-template/{id}', [InsuranceController::class, 'insurance_email_template'])->name('insurance.email.template');
    Route::put('insurance/email-template/update/{uuid}', [InsuranceController::class, 'insurance_email_template_update'])->name('insurance.email.template.update');

    Route::get('insurance/summary/{uuid}', [InsuranceController::class, 'insurance_summary'])->name('insurance.summary');
    Route::post('/insurance/invoice-submit/{id}', [InsuranceController::class, 'invoiceSubmit'])->name('insurance.invoice.submit');
    Route::get('insurance/success', [InsuranceController::class, 'success'])->name('insurance.success');
    // Route::get('insurance/success', [InsuranceController::class, 'success'])->name('insurance.success');

    Route::get('purchase/edit/{id}', function ($id) {
        return view('purchase.edit', ['id' => $id]);
    })->name('purchase.edit');

    Route::get('test-mail', [InsuranceController::class, 'testmail']);

    /*Datewise Purchase Report*/
    Route::get('/date-wise-purchase-report', function () {
        return view('purchase.datewise_report');
    })->name('purchase.datewise');


    Route::get('online-purchase', [UserController::class, 'online_purchase'])->name('online.purchase');
    Route::get('offline-purchase', [UserController::class, 'offline_purchase'])->name('offline.purchase');

    Route::get('test-mail', [StripePaymentController::class, 'test_mail']);


    
//About sections
Route::get('about', [AboutController::class, 'index'])->name('about');
Route::get('create-about', [AboutController::class, 'create'])->name('create.about');
Route::post('save-about', [AboutController::class, 'store'])->name('save.about');
Route::get('/about/{id}/edit', [AboutController::class, 'edit'])->name('edit.about');
Route::put('/about/{id}/update', [AboutController::class, 'update'])->name('update.about');
Route::delete('/about/{id}/delete', [AboutController::class, 'destroy'])->name('delete.about');



//Banner sections
Route::get('banner', [BannerController::class, 'index'])->name('banner');
Route::get('create-banner', [BannerController::class, 'create'])->name('create.banner');
Route::post('save-banner', [BannerController::class, 'store'])->name('save.banner');
Route::get('/banner/{id}/edit', [BannerController::class, 'edit'])->name('edit.banner');
Route::put('/banner/{id}/update', [BannerController::class, 'update'])->name('update.banner');
Route::delete('/banner/{id}/delete', [BannerController::class, 'destroy'])->name('delete.banner');


//Fact sections
Route::get('fact', [FactController::class, 'index'])->name('fact');
Route::get('create-fact', [FactController::class, 'create'])->name('create.fact');
Route::post('save-fact', [FactController::class, 'store'])->name('save.fact');
Route::get('/fact/{id}/edit', [FactController::class, 'edit'])->name('edit.fact');
Route::put('/fact/{id}/update', [FactController::class, 'update'])->name('update.fact');
Route::delete('/fact/{id}/delete', [FactController::class, 'destroy'])->name('delete.fact');


//Service sections
Route::get('services', [ServiceController::class, 'index'])->name('services');
Route::get('create-service', [ServiceController::class, 'create'])->name('create.service');
Route::post('save-service', [ServiceController::class, 'store'])->name('save.service');
Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('edit.service');
Route::put('/service/{id}/update', [ServiceController::class, 'update'])->name('update.service');
Route::delete('/service/{id}/delete', [ServiceController::class, 'destroy'])->name('delete.service');

//Client sections
Route::get('client', [ClientController::class, 'index'])->name('client');
Route::get('create-client', [ClientController::class, 'create'])->name('create.client');
Route::post('save-client', [ClientController::class, 'store'])->name('save.client');
Route::get('/client/{id}/edit', [ClientController::class, 'edit'])->name('edit.client');
Route::put('/client/{id}/update', [ClientController::class, 'update'])->name('update.client');
Route::delete('/client/{id}/delete', [ClientController::class, 'destroy'])->name('delete.client');


//Contact sections
Route::get('contact', [ContactController::class, 'index'])->name('contact');
Route::get('create-contact', [ContactController::class, 'create'])->name('create.contact');
Route::post('save-contact', [ContactController::class, 'store'])->name('save.contact');
Route::get('/contact/{id}/edit', [ContactController::class, 'edit'])->name('edit.contact');
Route::put('/contact/{id}/update', [ContactController::class, 'update'])->name('update.contact');
Route::delete('/contact/{id}/delete', [ContactController::class, 'destroy'])->name('delete.contact');


//Contentsections
Route::get('content', [ContentController::class, 'index'])->name('content');
Route::get('create-content', [ContentController::class, 'create'])->name('create.content');
Route::post('save-content', [ContentController::class, 'store'])->name('save.content');
Route::get('/content/{id}/edit', [ContentController::class, 'edit'])->name('edit.content');
Route::put('/content/{id}/update', [ContentController::class, 'update'])->name('update.content');
Route::delete('/content/{id}/delete', [ContentController::class, 'destroy'])->name('delete.content');


// Contact Form
Route::get('/contactform_list', [ContactFormController::class, 'index'])->name('contactform.list');
Route::get('/contactform/create', [ContactFormController::class, 'create'])->name('contactform.create');
Route::post('/contactform/store', [ContactFormController::class, 'store'])->name('contactform.store');


// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::get('/newsletter_list', [NewsletterController::class, 'index'])->name('newsletter.list');

});






// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     Route::resource('providers', ProviderController::class);
//     Route::resource('insurances', InsuranceController::class);
//     Route::resource('purchases', PurchaseController::class); 

//     /*All Purchase List*/

//     Route::get('/all-purchase-list', function () { 
//         return view('purchase.all_list'); 
//     })->name('purchase.list'); 


//     Route::get('/all-purchase-cancel-list', function () {
//         return view('purchase.all_cancel_list');
//     })->name('purchase.cancel.list'); 

//     //Route::get('purchase-list', [PurchaseController::class, 'purchaseList'])->name('purchase.list');
//     Route::get('purchase/edit/{policy_no}', [PurchaseController::class, 'purchaselist_edit'])->name('purchase.edit');
//     // Route::get('purchase-success', [PurchaseController::class, 'successPage'])->name('purchase.success');

//     Route::get('purchase-success/{id}', [PurchaseController::class, 'successPage'])->name('purchase.success'); 
//     Route::get('purchase/details/{id}', [PurchaseController::class, 'detailsPage'])->name('purchase.details');  

//     Route::get('insurance-invoice/{purchase_id}', [PurchaseController::class, 'downloadInvoice'])->name('insurance.invoice.genarate');
//     // Route::get('/insurance/static-document/pdf/{id}', [PurchaseController::class, 'generateStaticDocumentPdf'])->name('static.document.generate.pdf');

//     // Route::get('insurance/document/{id}', [PurchaseController::class, 'downloadDynamicDocument'])->name('insurance.document.download');
//     Route::get('/insurance-document-download/{purchase_id}/{document_id}', [PurchaseController::class, 'downloadDynamicDocument'])->name('insurance.document.download');

//     Route::get('insurance/pricing/{uuid}', [InsuranceController::class, 'insurance_pricing'])->name('insurance.pricing');
//     Route::post('insurance/pricing/submit/{uuid}', [InsuranceController::class, 'insurance_pricing_submit'])->name('insurance.pricing.submit');

//     Route::get('insurance/static-doc/{uuid}', [InsuranceController::class, 'static_document'])->name('insurance.static.document');
//     Route::post('insurance/static/document/submit/{uuid}', [InsuranceController::class, 'static_document_submit'])->name('insurance.static.document.submit');
//     Route::delete('insurance/static/delete/{id}', [InsuranceController::class, 'static_document_delete'])->name('insurance.static.delete');

//     Route::get('insurance/dynamic-doc/{id}', [InsuranceController::class, 'dynamic_document'])->name('insurance.dynamic.document');
//     Route::post('insurance/dynamic-document/submit/{id}', [InsuranceController::class, 'dynamic_document_submit'])->name('insurance.dynamic.document.submit');
//     Route::delete('insurance/dynamic/delete/{id}', [InsuranceController::class, 'dynamic_document_delete'])->name('insurance.dynamic.delete');
//     Route::put('insurance/dynamic/update/{id}/{insurancedynamicdocId}', [InsuranceController::class, 'dynamic_document_update'])->name('insurance.dynamic.update');

//     Route::get('insurance/email-template/{id}', [InsuranceController::class, 'insurance_email_template'])->name('insurance.email.template');
//     Route::put('insurance/email-template/update/{uuid}', [InsuranceController::class, 'insurance_email_template_update'])->name('insurance.email.template.update');

//     Route::get('insurance/summary/{uuid}', [InsuranceController::class, 'insurance_summary'])->name('insurance.summary');
//     Route::post('/insurance/invoice-submit/{id}', [InsuranceController::class, 'invoiceSubmit'])->name('insurance.invoice.submit');
//     Route::get('insurance/success', [InsuranceController::class, 'success'])->name('insurance.success');
//     // Route::get('insurance/success', [InsuranceController::class, 'success'])->name('insurance.success');

//     Route::get('purchase/edit/{id}', function ($id) {
//         return view('purchase.edit', ['id' => $id]);
//     })->name('purchase.edit');

//     Route::get('test-mail', [InsuranceController::class, 'testmail']);

//     /*Datewise Purchase Report*/
//     Route::get('/date-wise-purchase-report', function () {
//         return view('purchase.datewise_report');
//     })->name('purchase.datewise');


//     Route::get('online-purchase', [UserController::class, 'online_purchase'])->name('online.purchase');
//     Route::get('offline-purchase', [UserController::class, 'offline_purchase'])->name('offline.purchase');
// });

require __DIR__ . '/auth.php';

Route::get('policy-holder-email', [InsuranceController::class, 'policy_holder_email']);
