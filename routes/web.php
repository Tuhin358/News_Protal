<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCtegoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\SubDistrictController;
use App\Http\Controllers\PostController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

// Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

                            // Category
Route::get('/categories-index',[CategoryController::class, 'index'])->name('all.index');
Route::get('/categories-create',[CategoryController::class, 'create'])->name('create.category');
Route::post('/categories-store',[CategoryController::class, 'store'])->name('cat.store');

Route::get('/categories-edit/{id}',[CategoryController::class, 'edit'])->name('cat.edit');
Route::post('/categories-update/{id}',[CategoryController::class, 'update'])->name('cat.update');
Route::get('/categories-delete/{id}',[CategoryController::class, 'destroy'])->name('cat.destroy');


                            // Sub-Category
Route::get('/subcategories-index',[SubCtegoryController::class, 'index'])->name('subcat.index');
Route::get('/subcategories-create',[SubCtegoryController::class, 'create'])->name('create.subcategory');
Route::post('/subcategories-store',[SubCtegoryController::class, 'store'])->name('subcat.store');

Route::get('/subcategories-edit/{id}',[SubCtegoryController::class, 'edit'])->name('subcat.edit');
// Route::post('/subscategories-update/{id}',[SubCtegoryController::class, 'update'])->name('subcats.update');
Route::post('/sub-cats/{id}',[SubCtegoryController::class, 'update'])->name('subcats.update');
Route::get('/subcategory-destroy/{id}', [SubCtegoryController::class, 'destroy'])->name('subcategory.destroy');


                            // District
Route::get('/district-index',[DistrictController::class, 'index'])->name('district.index');
Route::get('/district-create',[DistrictController::class, 'create'])->name('district.create');
Route::post('/district-store',[DistrictController::class, 'store'])->name('district.store');

Route::get('/district-edit/{id}',[DistrictController::class, 'edit'])->name('district.edit');
Route::post('/district-upd/{id}',[DistrictController::class, 'update'])->name('district.update');
Route::get('/district-delete/{id}',[DistrictController::class, 'destroy'])->name('district.destroy');



                          // Sub-District

Route::get('/subdistrict-index',[SubDistrictController::class, 'index'])->name('subdistrict.index');
Route::get('/subdistrict-create',[SubDistrictController::class, 'create'])->name('subdistrict.create');
Route::post('/subdistrict-create',[SubDistrictController::class, 'store'])->name('subdistrict.store');

 Route::get('/subdistrict-edit/{id}',[SubDistrictController::class, 'edit'])->name('subdistrict.edit');
Route::post('/subdistrict-upd/{id}',[SubDistrictController::class, 'update'])->name('subdistrict.update');
 Route::get('/subdistrict-delete/{id}',[SubDistrictController::class, 'destroy'])->name('subdistrict.destroy');

                           // Post
Route::get('/post-create',[PostController::class, 'create'])->name('insert.post');

Route::get('/get-subcategories/{category_id}',[PostController::class, 'getSubcategories'])->name('get-subcategories');
Route::get('/get-subdistricts/{dis_id}',[PostController::class, 'getSubdistricts'])->name('get-subdistricts');
Route::post('/store-post',[PostController::class, 'store'])->name('store.post');
Route::get('/all-post',[PostController::class, 'index'])->name('all.post');
Route::get('/post-delete/{id}',[PostController::class, 'destroy'])->name('post.destroy');
Route::get('/post-edit/{id}',[PostController::class, 'edit'])->name('post.edit');





