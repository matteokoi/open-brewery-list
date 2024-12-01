<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BreweryController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\LoginController;

Route::middleware('throttle:10,1')->group(function () {
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', action: [LoginController::class, 'login']);
});
Route::middleware(['auth'])->group(function () {
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/', [BreweryController::class, 'index'])->name('welcome');
Route::get('/search', [SearchController::class, 'index'])->name('search');

});

