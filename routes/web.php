<?php

use App\Http\Controllers\Auth\CustomerAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OurstoryController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductCategoryController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [CustomerAuthController::class, 'registerView'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [CustomerAuthController::class, 'loginView'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'loginPost'])->name('login');
});

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/shop', [ShopController::class, 'shopView'])->name('shop');
Route::get('/productcategories', [ProductCategoryController::class, 'ProductCategoriesView'])->name('productcategories');
Route::get('/ourstory', [OurstoryController::class, 'ourstoryView'])->name('ourstory');
Route::get('/blog', [BlogController::class, 'blogView'])->name('blog');
Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->where('slug', '[A-Za-z0-9-]+');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/cart/items', [CartController::class, 'itemsView']);
    Route::delete('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'profileView'])->name('profileView');
    Route::resource('/editprofile', ProfileController::class);
    Route::resource('cart', CartController::class)->middleware('redirect');
    Route::put('/cart/update/{cart_id}', [CartController::class, 'update']);
    Route::get('/product', [ProductController::class, 'productView'])->name('product');
    Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('logout');
    Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('checkoutRedirect')->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'checkoutProduct']);
    Route::post('/payment', [CheckoutController::class, 'process'])->name('payment');
    Route::post('/check-payment-status', [CheckoutController::class, 'checkStatus'])->name('check.payment.status');
    Route::post('/pay', [CheckoutController::class, 'process'])->name('pay');
    Route::get('/cart/items', [CartController::class, 'itemsView']);
});
