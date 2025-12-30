<?php

use App\Livewire\Company\Dashboard\DashboardIndex as CompanyDashboardIndex;
use Illuminate\Support\Facades\Route;

Route::prefix('company')->middleware('role:COMPANY_ADMIN')->name('company.')->group(function () {
    // Dashboard
    Route::get('/dashboard', CompanyDashboardIndex::class)->name('dashboard');
});
