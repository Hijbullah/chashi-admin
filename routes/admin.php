<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SupplierController;

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
    return Inertia::render('Admin/Welcome');
})->name('admin.welcome');


Route::name('admin.')->middleware(['auth:admin', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard');
    })->name('dashboard');

    Route::resource('categories', CategoryController::class)->except('show');
    Route::resource('suppliers', SupplierController::class);

    //products
    Route::get('products', [ProductController::class, 'index'])->name('products.index');

    Route::get('products/create/vital-info', [ProductController::class, 'createVitalInfo'])->name('products.create.vital-info');
    Route::post('products/vital-info', [ProductController::class, 'storeVitalInfo'])->name('products.store.vital-info');
    
    Route::get('products/{product}/vital-info', [ProductController::class, 'editVitalInfo'])->name('products.edit.vital-info');
    Route::put('products/{product}/vital-info', [ProductController::class, 'updateVitalInfo'])->name('products.update.vital-info');
    
    Route::get('products/{product}/images', [ProductController::class, 'editImages'])->name('products.edit.images');
    Route::post('products/{product}/images', [ProductController::class, 'storeImage'])->name('products.images.store');
    Route::delete('products/{image}/images', [ProductController::class, 'destroyImage'])->name('products.images.destroy');
    
    Route::get('products/{product}/description', [ProductController::class, 'editDescription'])->name('products.edit.description');
    Route::put('products/{product}/description', [ProductController::class, 'updateDescription'])->name('products.update.description');
    
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

});


require __DIR__.'/auth-admin.php';