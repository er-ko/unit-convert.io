<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('locale/{lang}', [LocaleController::class, 'setLocale']);

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/search', [WelcomeController::class, 'search'])->name('search');