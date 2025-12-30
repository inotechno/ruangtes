<?php

use App\Livewire\SuperAdmin\Dashboard\DashboardIndex as SuperAdminDashboardIndex;
use App\Livewire\SuperAdmin\Menu\Create as MenuCreate;
use App\Livewire\SuperAdmin\Menu\Edit as MenuEdit;
use App\Livewire\SuperAdmin\Menu\Index as MenuIndex;
use App\Livewire\SuperAdmin\Menu\MenuItems;
use App\Livewire\SuperAdmin\Menu\RolePermissions;
use Illuminate\Support\Facades\Route;

Route::prefix('super-admin')->middleware('role:SUPER_ADMIN')->name('super-admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', SuperAdminDashboardIndex::class)->name('dashboard');

});
