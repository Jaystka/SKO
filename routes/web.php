<?php

use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MaterialAdminController;
use App\Http\Controllers\OurstoryController;
use App\Http\Controllers\PaymentNotificationController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProxyController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TransactionAdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Publik
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('/');
Route::redirect('/home', '/');
Route::get('/shop', [ShopController::class, 'shopView'])->name('shop');
Route::get('/categories', [ProductCategoryController::class, 'ProductCategoriesView'])->name('categories');
Route::get('/ourstory', [OurstoryController::class, 'ourstoryView'])->name('ourstory');
Route::get('/blog', [BlogController::class, 'blogView'])->name('blog');
Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->where('slug', '[A-Za-z0-9-]+')
    ->name('product.show');

// Proxy data wilayah (dipakai form alamat checkout)
Route::prefix('api/proxy')->middleware('throttle:60,1')->group(function () {
    Route::get('provinces', [ProxyController::class, 'getProvinces']);
    Route::get('regencies/{provinceId}', [ProxyController::class, 'getRegencies'])->whereNumber('provinceId');
    Route::get('districts/{regencyId}', [ProxyController::class, 'getDistricts'])->whereNumber('regencyId');
    Route::get('villages/{districtId}', [ProxyController::class, 'getVillages'])->whereNumber('districtId');
});

// Webhook Midtrans (CSRF dikecualikan di bootstrap/app.php)
Route::post('/payment/notification', PaymentNotificationController::class)
    ->middleware('throttle:120,1')
    ->name('payment.notification');
Route::post('/payment/midtrans-notification', PaymentNotificationController::class)
    ->middleware('throttle:120,1');

/*
|--------------------------------------------------------------------------
| Tamu (customer)
|--------------------------------------------------------------------------
*/
Route::middleware('guest:web')->group(function () {
    Route::get('/register', [CustomerAuthController::class, 'registerView'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'registerPost'])->middleware('throttle:10,1');
    Route::get('/login', [CustomerAuthController::class, 'loginView'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'loginPost'])->middleware('throttle:20,1');
});

/*
|--------------------------------------------------------------------------
| Customer yang sudah login
|--------------------------------------------------------------------------
*/
Route::middleware('auth:web')->group(function () {
    Route::match(['post', 'delete'], '/logout', [CustomerAuthController::class, 'logout'])->name('logout');

    Route::get('/profile', [ProfileController::class, 'profileView'])->name('profileView');
    Route::get('/editprofile', [ProfileController::class, 'index'])->name('editprofile.index');
    Route::put('/editprofile/{customer?}', [ProfileController::class, 'update'])->name('editprofile.update');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/items', [CartController::class, 'itemsView'])->name('cart.items');
    Route::post('/cart', [CartController::class, 'store'])->middleware('throttle:60,1')->name('cart.store');
    Route::put('/cart/update/{cart_id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{cart_id}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'checkoutProduct'])->name('checkout.select');
    Route::post('/payment', [CheckoutController::class, 'process'])->middleware('throttle:10,1')->name('payment');
    Route::post('/check-payment-status', [CheckoutController::class, 'checkStatus'])
        ->middleware('throttle:30,1')
        ->name('check.payment.status');
});

/*
|--------------------------------------------------------------------------
| Admin
|--------------------------------------------------------------------------
*/
Route::redirect('/admin', '/admin/login');
Route::prefix('admin')->group(function () {
    Route::middleware('guest:admin')->group(function () {
        Route::get('login', [AdminAuthController::class, 'loginView'])->name('admin.login');
        Route::post('login', [AdminAuthController::class, 'loginPost'])->middleware('throttle:20,1');
    });

    Route::middleware('auth:admin')->group(function () {
        Route::post('logoutadmin', [AdminAuthController::class, 'logoutadmin'])->name('admin.logout');
        Route::get('dashboard', [DashboardController::class, 'dashboardView'])->name('dashboard');

        // Produk
        Route::get('products', [ProductAdminController::class, 'productsView'])->name('products');
        Route::get('addproducts', [ProductAdminController::class, 'addproductsView'])->name('addproducts');
        Route::post('addProducts', [ProductAdminController::class, 'addProduct'])->name('products.add');
        Route::get('edit/{slug}', [ProductAdminController::class, 'editProductView'])->name('products.edit');
        Route::put('update/{slug}', [ProductAdminController::class, 'updateProduct'])->name('products.update');
        Route::delete('products/{product_id}', [ProductAdminController::class, 'deleteProduct'])->name('products.delete');

        // Kategori
        Route::get('category', [CategoryAdminController::class, 'categoriesadminView'])->name('category');
        Route::get('addcategories', [CategoryAdminController::class, 'addcategories'])->name('admin.category.addcategory');
        Route::post('addcategories', [CategoryAdminController::class, 'addCategory'])->name('admin.category.add');
        Route::get('editcategory/{id}', [CategoryAdminController::class, 'editCategory'])->name('editcategory');
        Route::put('updatecategory/{id}', [CategoryAdminController::class, 'updateCategory'])->name('admin.category.update');
        Route::delete('deletecategory/{id}', [CategoryAdminController::class, 'deleteCategory'])->name('admin.category.delete');

        // Customer
        Route::get('customers', [CustomerAdminController::class, 'index'])->name('customers');

        // Material
        Route::get('materials', [MaterialAdminController::class, 'materialsadminView'])->name('materials');
        Route::get('materials/add', [MaterialAdminController::class, 'showAddMaterialsForm'])->name('addmaterials');
        Route::post('materials', [MaterialAdminController::class, 'addMaterials'])->name('storematerials');
        Route::get('materials/edit/{id}', [MaterialAdminController::class, 'editMaterials'])->name('editmaterials');
        Route::put('materials/{id}', [MaterialAdminController::class, 'updateMaterials'])->name('updatematerials');
        Route::delete('materials/{id}', [MaterialAdminController::class, 'deleteMaterials'])->name('deletematerials');

        // Penjualan
        Route::get('transactions', [TransactionAdminController::class, 'transactionsadminView'])->name('transactions.admin');
    });
});
