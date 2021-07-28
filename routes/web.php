<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashBoardController;
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


require __DIR__ . '/auth.php';
