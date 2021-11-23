<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\editProfileController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\Usercontroller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendController::class, 'index'])->name('home');
//Route::redirect('/','login');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
//User //
Route::get('/users', [Usercontroller::class, 'index'])->name('users-index');
Route::put('/user-edit-response/', [Usercontroller::class, 'edit_response'])->name('user-edit-response');
Route::get('/user-edit/{id}', [Usercontroller::class, 'edit'])->name('user-edit');
Route::delete('/user-delete/{id}', [Usercontroller::class, 'user_delete'])->name('user-delete');
// dashboard
Route::get('/dashboard', [DashBoardController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');
// category Routes//
Route::get('/admin/categories-add', [CategoriesController::class, 'categoriesAdd'])->name('categoriesAdd');
Route::post('/admin/categories-post', [CategoriesController::class, 'categoriesPost'])->name('categoriesPost');
Route::get('/admin/categories-view', [CategoriesController::class, 'categoriesView'])->name('categoriesView');
Route::get('/admin/categories-edit/{id}', [CategoriesController::class, 'categoriesEdit'])->name('categoriesEdit');
Route::post('/admin/categories-edit-response/{id}', [CategoriesController::class, 'categoriesEditResponse'])->name('categoriesEditResponse');
Route::get('/admin/categories-soft/{id}', [CategoriesController::class, 'categoriesSoftDelete'])->name('categoriesSoftDelete');
Route::get('/admin/categories-trashed', [CategoriesController::class, 'categoriesTrashed'])->name('categoriesTrashed');
Route::get('/admin/categories-restore/{id}', [CategoriesController::class, 'categoriesRestore'])->name('categoriesRestore');
Route::get('/admin/categories-delete/{id}', [CategoriesController::class, 'categoriesDelete'])->name('categoriesDelete');
// subcategory Routes //
Route::get('/admin/sub-category-view', [SubCategoryController::class, 'index'])->name('subCategory');
Route::post('/admin/sub-category-insert', [SubCategoryController::class, 'SubCategoryInsert'])->name('subCategoryInsert');
Route::get('/admin/sub-category-edit/{id}', [SubCategoryController::class, 'subCategoryEdit'])->name('subCategoryEdit');
Route::post('/admin/sub-category-edit-response/{id}', [SubCategoryController::class, 'subCategoryDataEditResponse'])->name('subCategoryEditResponse');
Route::get('/admin/sub-category-soft/{id}', [SubCategoryController::class, 'subCategorySoft'])->name('subCategorySoft');
Route::get('/admin/sub-category-trashed', [SubCategoryController::class, 'subCategoryTrash'])->name('subCategoryTrash');
Route::get('/admin/sub-category-restore/{id}', [SubCategoryController::class, 'subCategoryRestore'])->name('subCategoryRestore');
Route::get('/admin/sub-category-deleted/{id}', [SubCategoryController::class, 'subCategoryDeleted'])->name('subCategoryDeleted');
Route::post('/admin/sub-category-check', [SubCategoryController::class, 'subCategoryCheck'])->name('subcategoryCheck');
Route::get('/admin/editProfile/{id}', [editProfileController::class, 'index'])->name('editProfile');
Route::post('/admin/updateProfile/{id}', [editProfileController::class, 'updateProfile'])->name('updateProfile');
//Product Route //
Route::resource("products", ProductsController::class);
//FrontEnd Route //
Route::get('singleProduct/{id}', [FrontendController::class, 'singleProduct'])->name('single');
Route::get("/shop", [FrontendController::class, 'shop'])->name('shop');
Route::get("/category_shop/{id}", [FrontendController::class, 'category_shop'])->name('category_shop');
// cart //
Route::post("/cart", [CartController::class, 'cart_store'])->name('cart_store');
Route::get('/cart_show', [CartController::class, 'cart_show'])->name('cart_show');
Route::get('/cart_delete/{uuid}', [CartController::class, 'cart_delete'])->name('cart_deleted');
Route::get('/cart_coupon/{coupon_name}', [CouponController::class, 'coupon_match'])->name('apply_coupon');
Route::post('/update_cart', [CartController::class, 'cart_update'])->name('update_cart');
// coupon//
Route::get('/admin/coupon', [CouponController::class, 'coupon_index'])->name('coupon');
Route::post('/admin/coupon_add', [CouponController::class, 'coupon_add'])->name('coupon_add');
Route::get('/admin/coupon_delete/{id}', [CouponController::class, 'coupon_delete'])->name('coupon_delete');
// checkout //
Route::get('/checkout/{discount?}', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/get-city', [CheckoutController::class, 'city'])->name('city');
Route::get('/get-phone/{id}', [CheckoutController::class, 'phone'])->name('phone');
Route::post('/order-submit', [CheckoutController::class, 'order'])->name('order_submit');
Route::post('/order-billing', [CheckoutController::class, 'billing_details'])->name('order_billing_details');
Route::post('/order-product-details', [CheckoutController::class, 'ordered_products'])->name('order_products_details');
// SSLCOMMERZ Start
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax'])->name('payViaAjax');

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

require __DIR__ . '/auth.php';
