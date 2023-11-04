<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Auth::routes(['verify' => true]);
Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('verified');;

/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {
    // Route::get('order/{id}', [OrdersController::class, 'index'])->name('order');
    // Route::post('order/{id}', [OrdersController::class, 'order'])->name('order');

    Route::controller(OrdersController::class)->prefix('order')->group(function () {
        Route::get('/{id}', 'index')->name('order');
        Route::post('/{id}', 'order')->name('order');
    });

    Route::controller(OrdersController::class)->prefix('checkout')->group(function () {
        Route::get('', 'checkout')->name('checkout');
        Route::get('confirm', 'confirm')->name('checkout.confirm');
        Route::delete('destroy/{id}', 'destroy')->name('checkout.destroy');
    });

    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get('', 'index')->name('profile');
        Route::put('edit', 'update')->name('profile.update');
    });

    Route::controller(HistoryController::class)->prefix('history')->group(function () {
        Route::get('', 'index')->name('history');
        Route::get('/{id}', 'detail')->name('history.detail');
    });
});


/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');

    Route::controller(ProductsController::class)->prefix('product')->group(function () {
        Route::get('', 'index')->name('product');
        Route::get('add', 'create')->name('product.create');
        Route::post('add', 'store')->name('product.store');
        Route::get('edit/{id}', 'edit')->name('product.edit');
        Route::put('edit/{id}', 'update')->name('product.update');
        Route::get('destroy/{id}', 'destroy')->name('product.destroy');
    });
});
