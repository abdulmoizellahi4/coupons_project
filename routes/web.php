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
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
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
        $response = response()->view('admin.dashboard');
        
        // Prevent caching of dashboard page to avoid back button issues after logout
        $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0');
        $response->headers->set('Pragma', 'no-cache');
        $response->headers->set('Expires', '0');
        
        return $response;
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

    /*
    |--------------------------------------------------------------------------
    | Blog Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('blogs', BlogController::class);
    Route::delete('blogs/bulk-delete', [BlogController::class, 'bulkDelete'])->name('blogs.bulk-delete');
    Route::post('blogs/reorder', [BlogController::class, 'reorder'])->name('blogs.reorder');

    /*
    |--------------------------------------------------------------------------
    | Contact Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('contacts', ContactController::class)->except(['create', 'edit', 'store', 'update']);
    Route::patch('contacts/{contact}/status', [ContactController::class, 'updateStatus'])->name('contacts.update-status');
    Route::delete('contacts/bulk-delete', [ContactController::class, 'bulkDelete'])->name('contacts.bulk-delete');

    /*
    |--------------------------------------------------------------------------
    | User Management Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('users', UserController::class);
    Route::patch('users/{user}/status', [UserController::class, 'updateStatus'])->name('users.update-status');
    Route::delete('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulk-delete');

    /*
    |--------------------------------------------------------------------------
    | Customer Management Routes
    |--------------------------------------------------------------------------
    */
    Route::resource('customers', CustomerController::class);
    Route::patch('customers/{customer}/status', [CustomerController::class, 'updateStatus'])->name('customers.update-status');
    Route::delete('customers/bulk-delete', [CustomerController::class, 'bulkDelete'])->name('customers.bulk-delete');

    /*
    |--------------------------------------------------------------------------
    | Settings Routes
    |--------------------------------------------------------------------------
    */
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::post('settings/reset', [SettingsController::class, 'reset'])->name('settings.reset');
    Route::get('settings/colors.css', [SettingsController::class, 'generateColorCss'])->name('settings.colors.css');

    /*
    |--------------------------------------------------------------------------
    | Newsletter Management Routes
    |--------------------------------------------------------------------------
    */
    Route::get('newsletters', [FrontendController::class, 'adminNewsletters'])->name('newsletters.index');
    Route::delete('newsletters/{newsletter}', [FrontendController::class, 'adminNewsletterDelete'])->name('newsletters.destroy');
    Route::delete('newsletters/bulk-delete', [FrontendController::class, 'adminNewsletterBulkDelete'])->name('newsletters.bulk-delete');
});



/*
|--------------------------------------------------------------------------
| Dynamic CSS Route (Public)
|--------------------------------------------------------------------------
*/
Route::get('/css/colors.css', [SettingsController::class, 'generateColorCss'])->name('colors.css');

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [FrontendController::class, 'home'])->name('home');

Route::get('/top-discounts', [FrontendController::class, 'topDiscounts'])->name('top-discounts');
Route::get('/categories', [FrontendController::class, 'categories'])->name('categories');

Route::get('/events', [FrontendController::class, 'events'])->name('events');
Route::get('/event/{slug}', [FrontendController::class, 'eventDetail'])->name('event.detail');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [FrontendController::class, 'contactSubmit'])->name('contact.submit');
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
Route::get('/blog/{slug}', [FrontendController::class, 'blogShow'])->name('blog.show');
Route::post('/blog/{slug}/view', [FrontendController::class, 'blogView'])->name('blog.view');
Route::get('/all-brands-uk', [FrontendController::class, 'allBrandsUk'])->name('all-brands-uk');
Route::get('/all-stores', [FrontendController::class, 'allBrandsUk'])->name('all-stores');

Route::get('/contact-details', [FrontendController::class, 'contactDetails'])->name('contact-details');
Route::get('/category/{slug}', [FrontendController::class, 'category'])->name('category');
Route::get('/store/{slug}', [FrontendController::class, 'store'])->name('store');

// Search functionality
Route::get('/search', [FrontendController::class, 'search'])->name('search');
Route::get('/storesearch', [FrontendController::class, 'search'])->name('storesearch');
Route::get('/getHeaderSearchDefault', [FrontendController::class, 'getHeaderSearchDefault'])->name('getHeaderSearchDefault');
Route::get('/ajax-search', [FrontendController::class, 'ajaxSearch'])->name('ajax.search');
Route::get('/test-search/{query}', [FrontendController::class, 'testSearch'])->name('test.search');

// Newsletter subscription
Route::post('/newsletter/subscribe', [FrontendController::class, 'newsletterSubscribe'])->name('newsletter.subscribe');

/*
|--------------------------------------------------------------------------
| Customer Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login.submit');
Route::get('/customer/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register.submit');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');

/*
|--------------------------------------------------------------------------
| Default Route
|--------------------------------------------------------------------------
*/
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});
