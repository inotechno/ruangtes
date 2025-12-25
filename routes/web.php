<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', Login::class)->name('login');