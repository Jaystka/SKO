<?php

use App\Http\Controllers\Auth\AdminAuthController;
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
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MaterialAdminController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\TransactionAdminController;

//guest
Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [CustomerAuthController::class, 'registerView'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [CustomerAuthController::class, 'loginView'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'loginPost'])->name('login');
});

//global
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/shop', [ShopController::class, 'shopView'])->name('shop');
Route::get('/categories', [ProductCategoryController::class, 'ProductCategoriesView'])->name('categories');
Route::get('/ourstory', [OurstoryController::class, 'ourstoryView'])->name('ourstory');
Route::get('/blog', [BlogController::class, 'blogView'])->name('blog');
Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->where('slug', '[A-Za-z0-9-]+');

//api
Route::get('/api/proxy/provinces', [ProxyController::class, 'getProvinces']);
Route::get('/api/proxy/regencies/{provinceId}', [ProxyController::class, 'getRegencies']);
Route::get('/api/proxy/districts/{regencyId}', [ProxyController::class, 'getDistricts']);
Route::get('/api/proxy/districts/{regencyId}', [ProxyController::class, 'getDistricts']);
Route::get('/api/proxy/villages/{districtId}', [ProxyController::class, 'getVillages']);

//admin
Route::redirect('/admin', '/admin/login');
Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'loginView'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'loginPost']);
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('logoutadmin', [AdminAuthController::class, 'logoutadmin'])->name('admin.logout');
        Route::get('dashboard', [DashboardController::class, 'dashboardView'])->name('dashboard');
        // Products
        Route::get('products', [ProductAdminController::class, 'productsView'])->name('products');
        Route::get('addproducts', [ProductAdminController::class, 'addproductsView'])->name('addproducts');
        Route::post('addProducts', [ProductAdminController::class, 'addProduct'])->name('products.add');
        Route::delete('{product_id}', [ProductAdminController::class, 'deleteProduct'])->name('products.delete');
        Route::get('edit/{slug}', [ProductAdminController::class, 'editProductView'])->name('products.edit');
        Route::put('update/{slug}', [ProductAdminController::class, 'updateProduct'])->name('products.update');
        // category
        Route::get('category', [CategoryAdminController::class, 'categoriesadminView'])->name('category');
        Route::get('addcategories', [CategoryAdminController::class, 'addcategories'])->name('admin.category.addcategory');
        Route::post('addcategories', [CategoryAdminController::class, 'addCategory'])->name('admin.category.add');
        Route::get('editcategory/{id}', [CategoryAdminController::class, 'editCategory'])->name('editcategory');
        Route::post('updatecategory/{id}', [CategoryAdminController::class, 'updateCategory'])->name('admin.category.update');
        Route::delete('deletecategory/{id}', [CategoryAdminController::class, 'deleteCategory'])->name('admin.category.delete');
        // customers
        Route::get('customers', [CustomerAuthController::class, 'showCustomers'])->name('customers');
        //materials
        Route::get('materials', [MaterialAdminController::class, 'materialsadminView'])->name('materials');
        Route::get('materials/add', [MaterialAdminController::class, 'showAddMaterialsForm'])->name('addmaterials');
        Route::post('materials', [MaterialAdminController::class, 'addMaterials'])->name('storematerials');
        Route::get('materials/edit/{id}', [MaterialAdminController::class, 'editMaterials'])->name('editmaterials');
        Route::put('materials/{id}', [MaterialAdminController::class, 'updateMaterials'])->name('updatematerials');
        Route::delete('materials/{id}', [MaterialAdminController::class, 'deleteMaterials'])->name('deletematerials');
        //Sells
        Route::get('transactions', [TransactionAdminController::class, 'transactionsadminView'])->name('transactions.admin');
    });
});


//customer
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
