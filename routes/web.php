<?php

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

Route::get('/main', function () {
    return view('main');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/brand', [App\Http\Controllers\BrandController::class, 'index'])->name('brand');


Route::get('/ajax/dataBrand/{id}', [App\Http\Controllers\BrandController::class, 'getDataBrand']);

// pengelolaan brand
Route::post('/brand', [App\Http\Controllers\BrandController::class, 'submit_brand'])->name('brand.submit');
Route::patch('/brand/update', [App\Http\Controllers\BrandController::class, 'update_brand'])->name('brand.update');
Route::delete('/brand/delete', [App\Http\Controllers\BrandController::class, 'delete_brand'])->name('brand.delete');


// Route::get('/admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')->middleware('is_admin');

Route::middleware('is_admin')->prefix('admin')->group(function(){
    Route::get('/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
});

// Route::middleware('is_user')->prefix('user')->group(function(){

// });


// PENGOLOLAAN BRANDS
