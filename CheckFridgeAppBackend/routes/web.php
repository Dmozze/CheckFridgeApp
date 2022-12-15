<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\FridgeController;
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

Route::group(['namespace' => 'Product'], function (){
//    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
//    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
//    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
//    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
//    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
//    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
//    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');


});

Route::group(['namespace' => 'Fridge'], function (){
    Route :: get('/fridges', [FridgeController::class, 'index'])->name('fridges.index');
    // oute :: get('/fridges/create', [FridgeController::class, 'create'])->name('fridges.create');
    Route :: get('/fridges/{id}/products', [FridgeController::class, 'showProducts'])->name('fridges.show');
    Route :: post('/fridges/{id}/products', [FridgeController::class, 'addProduct'])->name('fridges.store');
    Route :: post('/fridges', [FridgeController::class, 'store'])->name('fridges.store');
    Route :: delete('/fridges/{id}', [FridgeController::class, 'destroy'])->name('fridges.destroy');
    Route :: delete('/fridges/{fridge_id}/products/{product_id}', [FridgeController::class, 'removeProduct'])->name('fridges.removeProduct');
    // Route :: get('/fridges/{id}/edit', [FridgeController::class, 'edit'])->name('fridges.edit');
    // Route :: put('/fridges/{id}', [FridgeController::class, 'update'])->name('fridges.update');
});

Route :: get('/token', function (){
    return json_encode(csrf_token());
});

