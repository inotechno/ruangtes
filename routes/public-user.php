<?php

use App\Livewire\PublicUser\Dashboard\DashboardIndex as PublicUserDashboardIndex;
use Illuminate\Support\Facades\Route;

Route::prefix('public-user')->middleware('role:PUBLIC_USER')->name('public-user.')->group(function () {
    // Dashboard
    Route::get('/dashboard', PublicUserDashboardIndex::class)->name('dashboard');
});
