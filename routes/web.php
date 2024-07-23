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
use App\Http\Controllers\LoginadminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\MaterialAdminController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [CustomerAuthController::class, 'registerView'])->name('register');
    Route::post('/register', [CustomerAuthController::class, 'registerPost'])->name('register');
    Route::get('/login', [CustomerAuthController::class, 'loginView'])->name('login');
    Route::post('/login', [CustomerAuthController::class, 'loginPost'])->name('login');
});

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('/shop', [ShopController::class, 'shopView'])->name('shop');
Route::get('/productcategory', [ProductCategoryController::class, 'ProductCategoryView'])->name('productcategory');
Route::get('/ourstory', [OurstoryController::class, 'ourstoryView'])->name('ourstory');
Route::get('/blog', [BlogController::class, 'blogView'])->name('blog');
Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->where('slug', '[A-Za-z0-9-]+');

// Route::prefix('admin')->group(function(){
    Route::get('/loginadmin', [LoginadminController::class, 'loginadminView'])->name('loginadmin');
    Route::get('admin/dashboard', [DashboardController::class, 'dashboardView'])->name('dashboard');
    // Products
    Route::get('admin/products', [ProductAdminController::class, 'productsView'])->name('products');
    Route::get('admin/addproducts', [ProductAdminController::class, 'addproductsView'])->name('addproducts');
    Route::post('admin/addProducts', [ProductAdminController::class, 'addProduct']);
    Route::delete('admin/{product}', [ProductAdminController::class, 'deleteProduct'])->name('products.delete');
    Route::get('admin/edit/{slug}', [ProductAdminController::class, 'editProductView'])->name('products.edit');
    Route::put('admin/update/{slug}', [ProductAdminController::class, 'updateProduct'])->name('products.update');
    // category
    Route::get('admin/category', [CategoryAdminController::class, 'categoriesadminView'])->name('category');
    Route::get('admin/addcategories', [CategoryAdminController::class, 'addcategories'])->name('admin.category.addcategory');
    Route::post('admin/addcategories', [CategoryAdminController::class, 'addCategory'])->name('admin.category.add');
    Route::get('admin/editcategory/{id}', [CategoryAdminController::class, 'editCategory'])->name('editcategory');
    Route::post('admin/updatecategory/{id}', [CategoryAdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::delete('admin/deletecategory/{id}', [CategoryAdminController::class, 'deleteCategory'])->name('admin.category.delete');
    // customers
    Route::get('admin/customers', [CustomerAuthController::class, 'showCustomers'])->name('customers');
    //materials
    Route::get('/admin/materials', [MaterialAdminController::class, 'materialsadminView'])->name('materials');
    Route::get('/admin/materials/add', [MaterialAdminController::class, 'showAddMaterialsForm'])->name('addmaterials');
    Route::post('/admin/materials', [MaterialAdminController::class, 'addMaterials'])->name('storematerials');
    Route::get('/admin/materials/{id}/edit', [MaterialAdminController::class, 'editMaterials'])->name('editmaterials');
    Route::put('/admin/materials/{id}', [MaterialAdminController::class, 'updateMaterials'])->name('updatematerials');
    Route::delete('/admin/materials/{id}', [MaterialAdminController::class, 'deleteMaterials'])->name('deletematerials');
// })


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
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    // Route::resource('checkout', CheckoutController::class);
    Route::post('/checkout', [CheckoutController::class, 'checkoutProduct']);
    Route::get('/cart/items', [CartController::class, 'itemsView']);
});
