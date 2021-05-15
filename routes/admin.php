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
    Route::get('products/create/vital-info', [ProductController::class, 'showVitalInfoForm'])->name('products.create.vital-info');
    Route::post('products/store/vital-info', [ProductController::class, 'storeVitalInfo'])->name('products.store.vital-info');
    Route::get('products/create/images/{product}', [ProductController::class, 'showImagesForm'])->name('products.create.images');
    Route::post('products/images/{product}', [ProductController::class, 'uploadProductImage'])->name('products.store.image');
    Route::get('products/create/{section?}/{product?}', [ProductController::class, 'create'])->name('products.create');
    Route::post('products/{section?}', [ProductController::class, 'store'])->name('products.store');
    Route::get('products/{product}', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    // Route::resource('products', ProductController::class);
});


require __DIR__.'/auth-admin.php';