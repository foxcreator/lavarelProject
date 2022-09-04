<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard', ['role' => 'Customer']);
})->middleware(['auth'])->name('dashboard');

Route::get('/categories/products/{id}' , [\App\Http\Controllers\Admin\CategoriesController::class, 'productsOfCategory'])->name('category.products');

Route::delete(
    'ajax/images/{image}',
    \App\Http\Controllers\Ajax\RemoveImageController::class
)->middleware(['auth', 'admin'])->name('ajax.images.delete');

Auth::routes();



Route::name('admin.')->prefix('admin')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard', ['role' => 'Admin']);
    })->name('dashboard');

    Route::resource('products', \App\Http\Controllers\Admin\ProductsController::class)->except(['show']);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoriesController::class)->only(['show', 'index', 'create', 'store']);
});
