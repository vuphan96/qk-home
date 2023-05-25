<?php

use App\Http\Controllers\Admin\AdminCatController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUnitController;
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
        Route::post('/create', [AdminCatController::class, 'postCreateCategory'])->name('admin.cat.create.category');
        Route::post('/update', [AdminCatController::class, 'postUpdateCategory'])->name('admin.cat.update.category');
        Route::post('/delete', [AdminCatController::class, 'deleteCategory'])->name('admin.cat.delete.category');
        Route::get('/import', [AdminCatController::class, 'getImport'])->name('admin.cat.get_import.category');
        Route::post('/import', [AdminCatController::class, 'postImport'])->name('admin.cat.post_import.category');
    });
    Route::prefix('/product')->group(function(){
        Route::get('/', [AdminProductController::class, 'index'])->name('admin.product.index');
        Route::get('/create', [AdminProductController::class, 'createProduct'])->name('admin.product.create');
        Route::post('/create', [AdminProductController::class, 'postCreateProduct'])->name('admin.product.create');
    });
    Route::prefix('/unit')->group(function(){
        Route::get('/', [AdminUnitController::class, 'index'])->name('admin.unit.index');
        Route::post('/create', [AdminUnitController::class, 'postCreateunit'])->name('admin.unit.create');
        Route::post('/update', [AdminUnitController::class, 'postUpdateUnit'])->name('admin.unit.update');
        Route::post('/delete', [AdminUnitController::class, 'deleteUnit'])->name('admin.unit.delete');

    });
});

