<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Auth\VerificationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['revalidate', 'secure.headers']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('index');

    // Login, Register, Forgot Password, Reset Password
    Auth::routes(['verify' => true]);

    // Login user account from admin panel
    Route::get('redirect-user-login/{id}', [AdminUserController::class, 'userLoginRedirect'])->name('redirect.user-login');

    // If you want to set new password while creating user from admin side
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::get('verified/{user}', [VerificationController::class, 'showVerifiedPage'])->name('verify');
    Route::post('verified', [VerificationController::class, 'verified'])->name('verified');

    Route::get('about-us', [HomeController::class, 'aboutUs'])->name('about-us');
    Route::get('terms-conditions', [HomeController::class, 'termsConditions'])->name('terms-conditions');
    Route::get('privacy-policy', [HomeController::class, 'privacyPolicy'])->name('privacy-policy');

    Route::get('contact-us', [HomeController::class, 'contactUs'])->name('contact-us');
    Route::post('contact/send-enquiry', [HomeController::class, 'enquiry'])->name('contact.enquiry');

    Route::get('blog/{slug?}', [HomeController::class, 'blogs'])->name('blogs');

    Route::get('faqs', [HomeController::class, 'faqs'])->name('faqs');

    Route::get('home', [HomeController::class, 'dashboard'])->name('home');
    // User URLs
    Route::group(['middleware' => ['auth']], function () {

        // Complete Profile
        Route::get('complete-profile', [AccountController::class, 'profile'])->name('user.complete.profile');
        Route::post('save-profile', [AccountController::class, 'saveProfile'])->name('save.profile');

        Route::group(['middleware' => ['user']], function () {

            // Profile
            Route::get('profile', [AccountController::class, 'profile'])->name('user.profile');

            // Change password
            Route::get('change-password', [AccountController::class, 'changePassword'])->name('user.change.password');
            Route::post('update-password', [AccountController::class, 'updatePassword'])->name('user.update.password');

            // Get Notifications
            Route::post('notifications', [HomeController::class, 'notifications'])->name('user.notifications');
        });
    });

    // CMS page if entire page content update from Admin section wise
    Route::get('cms-home', [HomeController::class, 'cmsHome'])->name('cms.home');
});
