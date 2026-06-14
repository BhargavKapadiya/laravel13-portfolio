<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminCMSController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminFAQsController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminEmailController;
use App\Http\Controllers\Admin\Auth\LoginController;
use Rap2hpoutre\LaravelLogViewer\LogViewerController;
use App\Http\Controllers\Admin\AdminEnquiryController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;

Route::group(['middleware' => ['revalidate', 'secure.headers']], function () {

    Route::get('/', [AdminController::class, 'index'])->name('admin');

    // ---------------------------------------------------------
    // Guest-only routes (login, password reset)
    // ---------------------------------------------------------
    Route::middleware('guest:' . ADMIN_GUARD)->group(function () {

        // Login
        Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('login', [LoginController::class, 'login'])->name('admin-login');

        // Forgot password
        Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('admin.password.request');
        Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('admin.password.email');

        // Reset password
        Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('admin.password.reset');
        Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('admin.password.update');
    });

    // ---------------------------------------------------------
    // Authenticated admin routes
    // ---------------------------------------------------------
    Route::middleware(['auth:' . ADMIN_GUARD, 'admin'])->name('admin.')->group(function () {

        Route::post('logout', [LoginController::class, 'logout'])->name('logout');

        // Dashboard
        Route::get('dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

        // Change password
        Route::get('change-password', [ChangePasswordController::class, 'changePassword'])->name('change.password');
        Route::post('update-password', [ChangePasswordController::class, 'updatePassword'])->name('update.password');

        // ---------------------------------------------------------
        // Users
        // ---------------------------------------------------------
        Route::post('users/block', [AdminUserController::class, 'block'])->name('user.block');
        Route::post('users/exists', [AdminUserController::class, 'checkExists'])->name('user.exists');
        Route::get('user-login/{id}', [AdminUserController::class, 'userLogin'])->name('user-login');
        Route::resource('users', AdminUserController::class, ['names' => 'user']);

        // ---------------------------------------------------------
        // Blogs
        // ---------------------------------------------------------
        Route::post('blogs/records', [AdminBlogController::class, 'getRecords'])->name('blogs.records');
        Route::post('blogs/exists', [AdminBlogController::class, 'exists'])->name('blogs.exists');
        Route::resource('blogs', AdminBlogController::class, ['names' => 'blogs']);

        // ---------------------------------------------------------
        // FAQs
        // ---------------------------------------------------------
        Route::post('faqs/records', [AdminFAQsController::class, 'getRecords'])->name('faqs.records');
        Route::post('faqs/exists', [AdminFAQsController::class, 'exists'])->name('faqs.exists');
        Route::resource('faqs', AdminFAQsController::class, ['names' => 'faqs']);

        // ---------------------------------------------------------
        // Categories
        // ---------------------------------------------------------
        Route::post('categories/records', [AdminCategoryController::class, 'index'])->name('category.records');
        Route::post('categories/exists', [AdminCategoryController::class, 'checkExists'])->name('category.exists');
        Route::resource('categories', AdminCategoryController::class, ['names' => 'category']);

        // ---------------------------------------------------------
        // Enquiries
        // ---------------------------------------------------------
        Route::resource('enquiry', AdminEnquiryController::class, ['names' => 'enquiry'])->except(['show']);

        // ---------------------------------------------------------
        // Emails
        // ---------------------------------------------------------
        Route::post('emails/records', [AdminEmailController::class, 'index'])->name('email.records');
        Route::resource('emails', AdminEmailController::class, ['names' => 'email'])->except(['show']);

        // ---------------------------------------------------------
        // CMS pages
        // ---------------------------------------------------------
        // Route::get('cms-pages', [AdminCMSController::class, 'index'])->name('cms.index');
        // Route::get('cms-pages/edit-page/{id}', [AdminCMSController::class, 'edit'])->name('cms.edit');
        // Route::post('cms-pages/edit-page', [AdminCMSController::class, 'update'])->name('cms.update');

        // ---------------------------------------------------------
        // Settings
        // ---------------------------------------------------------
        Route::get('settings', [AdminController::class, 'settings'])->name('settings');
        Route::post('save-settings', [AdminController::class, 'saveSettings'])->name('save.settings');
        Route::get('edit/privacy-policy', [AdminController::class, 'editPageContent'])->name('privacy-policy');
        Route::get('edit/terms-conditions', [AdminController::class, 'editPageContent'])->name('terms-&-conditions');
        Route::get('edit/about-us', [AdminController::class, 'editPageContent'])->name('about-us');
        Route::post('save-page-content', [AdminController::class, 'savePageContent'])->name('save.pageContent');

        // ---------------------------------------------------------
        // Shared / utility
        // ---------------------------------------------------------
        Route::post('notifications', [HomeController::class, 'notifications'])->name('notifications');
    });

    // ---------------------------------------------------------
    // Shared / utility
    // ---------------------------------------------------------
    Route::post('exists-user', [HomeController::class, 'checkUserExists'])->name('user.exists');
    Route::post('upload-files', [HomeController::class, 'uploadFiles'])->name('upload-files');
    Route::post('upload-images', [HomeController::class, 'uploadCKeditorImage'])->name('upload-ck-editor-images');
    Route::post('upload-crop-image', [HomeController::class, 'uploadCropImage'])->name('upload-crop-image');

    // ---------------------------------------------------------
    // Log viewer — protected, admins only
    // ---------------------------------------------------------
    Route::middleware(['auth:' . ADMIN_GUARD, 'admin'])
        ->get('logs', [LogViewerController::class, 'index'])
        ->name('admin.logs');
});
