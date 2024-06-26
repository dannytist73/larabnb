<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SellerListingController;
use App\Http\Controllers\UserAccountController;

Route::get('/', [IndexController::class, 'index']);
Route::get('/hello', [IndexController::class, 'show'])->middleware('auth');

Route::resource('listing', ListingController::class)
  ->only(['create', 'store', 'edit', 'update'])
  ->middleware('auth');
Route::resource('listing', ListingController::class)
  ->except(['create', 'store', 'edit', 'update', 'destroy']);

Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');

Route::resource('user-account', UserAccountController::class)
  ->only(['create', 'store']);

Route::prefix('seller')
  ->name('seller.')
  ->middleware('auth')
  ->group(function () {
    // routes here
    Route::resource('listing', SellerListingController::class)
      ->only(['index', 'destroy']);
  });