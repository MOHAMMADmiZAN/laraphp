<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashBoardController;
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
Route::get('/admin/categories-add', [CategoriesController::class, 'categoriesAdd'])->name('categoriesAdd');
Route::post('/admin/categories-post', [CategoriesController::class, 'categoriesPost'])->name('categoriesPost');
Route::get('/admin/categories-view', [CategoriesController::class, 'categoriesView'])->name('categoriesView');
Route::get('/admin/categories-edit/{id}', [CategoriesController::class, 'categoriesEdit'])->name('categoriesEdit');
Route::post('/admin/categories-edit-response/{id}', [CategoriesController::class, 'categoriesEditResponse'])->name('categoriesEditResponse');
Route::get('/admin/categories-soft/{id}', [CategoriesController::class, 'categoriesSoftDelete'])->name('categoriesSoftDelete');
Route::get('/admin/categories-trashed', [CategoriesController::class, 'categoriesTrashed'])->name('categoriesTrashed');
Route::get('/admin/categories-restore/{id}', [CategoriesController::class, 'categoriesRestore'])->name('categoriesRestore');
Route::get('/admin/categories-delete/{id}', [CategoriesController::class, 'categoriesDelete'])->name('categoriesDelete');
Route::get('/admin/sub-category-view', [SubCategoryController::class, 'index'])->name('subCategory');
Route::post('/admin/sub-category-insert', [SubCategoryController::class, 'SubCategoryInsert'])->name('subCategoryInsert');


require __DIR__ . '/auth.php';
