<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Middleware\AdminAuthenticate;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminNotificationController;
use App\Http\Controllers\Admin\AdminAuth\AdminNewPasswordController;
use App\Http\Controllers\Admin\AdminAuth\AdminPasswordResetLinkController;
use App\Http\Controllers\Admin\AdminAuth\AdminAuthenticatedSessionController;


Route::prefix('admin')->middleware([AdminAuthenticate::class])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/users', UserController::class);
    Route::get('/users/{user}/posts', [UserController::class, 'posts'])->name('user.posts');
    Route::resource('posts', PostController::class);
    Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});
Route::prefix('dashboard')->group(function () {
    Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('login', [AdminAuthenticatedSessionController::class, 'store'])->name('admin.login.submit');
    Route::get('forgot-password', [AdminPasswordResetLinkController::class, 'create'])->name('admin.password.request');
    Route::post('forgot-password', [AdminPasswordResetLinkController::class, 'store'])->name('admin.password.email');
    Route::get('reset-password/{token}', [AdminNewPasswordController::class, 'create'])->name('admin.password.reset');
    Route::post('reset-password', [AdminNewPasswordController::class, 'store'])->name('admin.password.store');
    Route::get('notifications', [AdminNotificationController::class, 'index'])
        ->name('notifications.index');
});
