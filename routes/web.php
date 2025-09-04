<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\NetworksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FrontendController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Forgot Password
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Reset Password
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


/*
|--------------------------------------------------------------------------
| Admin Routes (auth required)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // resources/views/admin/dashboard.blade.php
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Coupons Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('coupons', CouponController::class)->except(['show']);
    Route::delete('coupons', [CouponController::class, 'bulkDelete'])->name('coupons.bulkDelete');
    Route::post('coupons/reorder', [CouponController::class, 'reorder'])->name('coupons.reorder');

    /*
    |--------------------------------------------------------------------------
    | Events Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('events', EventsController::class)->except(['show']);
    Route::delete('events', [EventsController::class, 'bulkDelete'])->name('events.bulkDelete');
    Route::post('events/reorder', [EventsController::class, 'reorder'])->name('events.reorder');

    /*
    |--------------------------------------------------------------------------
    | Networks Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('networks', NetworksController::class)->except(['show']);
    Route::delete('networks', [NetworksController::class, 'bulkDelete'])->name('networks.bulkDelete');
    Route::post('networks/reorder', [NetworksController::class, 'reorder'])->name('networks.reorder');

    /*
    |--------------------------------------------------------------------------
    | Categories Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::delete('categories', [CategoryController::class, 'bulkDelete'])->name('categories.bulk-delete');
    Route::post('categories/reorder', [CategoryController::class, 'reorder'])->name('categories.reorder');

    /*
    |--------------------------------------------------------------------------
    | Pages Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('pages', PageController::class)->except(['show']);
    Route::delete('pages', [PageController::class, 'bulkDelete'])->name('pages.bulk-delete');
    Route::post('pages/reorder', [PageController::class, 'reorder'])->name('pages.reorder');

    /*
    |--------------------------------------------------------------------------
    | Stores Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('stores', StoreController::class)->except(['show']);
    Route::delete('stores', [StoreController::class, 'bulkDelete'])->name('stores.bulkDelete');
    Route::post('stores/reorder', [StoreController::class, 'reorder'])->name('stores.reorder');
});



/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'home'])->name('home');

Route::get('/top-discounts', [FrontendController::class, 'topDiscounts'])->name('top-discounts');
Route::get('/categories', [FrontendController::class, 'categories'])->name('categories');

Route::get('/events', [FrontendController::class, 'events'])->name('events');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/mobile-app', [FrontendController::class, 'mobileApp'])->name('mobile-app');

Route::get('/share', [FrontendController::class, 'share'])->name('share');
Route::get('/deal-seeker', [FrontendController::class, 'dealSeeker'])->name('deal-seeker');
Route::get('/smash-voucher-codes', [FrontendController::class, 'smashVoucherCodes'])->name('smash-voucher-codes');

Route::get('/student-discount', [FrontendController::class, 'studentDiscount'])->name('student-discount');
Route::get('/black-friday-deals', [FrontendController::class, 'blackFridayDeals'])->name('black-friday-deals');
Route::get('/cyber-monday-voucher-codes', [FrontendController::class, 'cyberMondayVoucherCodes'])->name('cyber-monday-voucher-codes');

Route::get('/christmas-deals-online', [FrontendController::class, 'christmasDealsOnline'])->name('christmas-deals-online');
Route::get('/about-us', [FrontendController::class, 'aboutUs'])->name('about-us');
Route::get('/advertise-with-us', [FrontendController::class, 'advertiseWithUs'])->name('advertise-with-us');

Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/all-brands-uk', [FrontendController::class, 'allBrandsUk'])->name('all-brands-uk');

Route::get('/contact-details', [FrontendController::class, 'contactDetails'])->name('contact-details');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('category');
Route::get('/store/{slug}', [FrontendController::class, 'store'])->name('store');

// Search functionality
Route::get('/search', [FrontendController::class, 'search'])->name('search');

// Newsletter subscription
Route::post('/newsletter/subscribe', [FrontendController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
