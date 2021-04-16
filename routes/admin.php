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
    Route::resource('products', ProductController::class);
});


require __DIR__.'/auth-admin.php';