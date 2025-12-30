<?php

use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\RegisterCompany;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Homepage
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    // Authentication
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
    Route::get('/register/company', RegisterCompany::class)->name('register.company');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.request');

    // Email verification
    // Route::get('/email/verify/{token}', \App\Http\Controllers\Auth\VerifyEmailController::class)
    //     ->name('verification.verify');
});

// ============================================
// AUTHENTICATED ROUTES (Common)
// ============================================
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', function () {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    })->name('logout');

    // Email verification notice
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice')->withoutMiddleware('verified');

    require __DIR__.'/super-admin.php';
    require __DIR__.'/company.php';
    require __DIR__.'/public-user.php';
    require __DIR__.'/participant.php';
});
