<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', Login::class)->name('login');

Route::get('/dashboard', function () {
    return 'Dashboard (Work in Progress)';
})->name('dashboard.index');