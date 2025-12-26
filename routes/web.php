<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\RegisterCompany;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', Login::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/register-company', RegisterCompany::class)->name('register.company');

Route::get('/dashboard', function () {
    return 'Dashboard (Work in Progress)';
})->name('dashboard.index');