<?php

use App\Http\Controllers\Admin\AdminCatController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
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

Route::prefix('/admin')->group(function(){
    Route::get('/',[AdminDashboardController::class, 'index'])->name('admin-dashboard');
    Route::prefix('/cat')->group(function(){
        Route::get('/', [AdminCatController::class, 'index'])->name('admin.cat.index');
        Route::get('/create', [AdminCatController::class, 'getCreateCategory'])->name('admin.cat.create.category');
        Route::post('/create', [AdminCatController::class, 'postCreateCategory'])->name('admin.cat.create.category');
        Route::post('/update', [AdminCatController::class, 'updateCategory'])->name('admin.cat.update.category');
        Route::post('/delete', [AdminCatController::class, 'deleteCategory'])->name('admin.cat.delete.category');
    });
    Route::prefix('/product')->group(function(){
        Route::get('/', [AdminProductController::class, 'index'])->name('admin.product.index');
        Route::get('/add', [AdminProductController::class, 'createProduct'])->name('admin.product.create');
        Route::post('/add', [AdminProductController::class, 'postCreateProduct'])->name('admin.product.create');
       });
});

