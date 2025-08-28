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
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login.form');
});
