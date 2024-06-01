<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OurstoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/shop', [ShopController::class, 'shopView']);
    Route::get('/ourstory', [OurstoryController::class, 'ourstoryView'])->name('ourstory');
    Route::get('/blog', [BlogController::class, 'blogView'])->name('blog');
    Route::get('/product', [ProductController::class, 'productView'])->name('product');
    Route::get('/register', [AuthController::class, 'registerView'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [AuthController::class, 'loginView'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'profileView'])->name('profileView');
    Route::get('/editprofile', [ProfileController::class, 'profileEdit'])->name('ProfileEdit');
    Route::get('/shop', [ShopController::class, 'shopView']);
    Route::get('/ourstory', [OurstoryController::class, 'ourstoryView'])->name('ourstory');
    Route::get('/blog', [BlogController::class, 'blogView'])->name('blog');
    Route::get('/product', [ProductController::class, 'productView'])->name('product');
});
