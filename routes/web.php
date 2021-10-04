<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\editProfileController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SubCategoryController;
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

Route::get('/', function () {
    return view('welcome');
});
//Route::redirect('/','login');

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth'])->name('dashboard');
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

require __DIR__ . '/auth.php';
