
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\UserManualController;

if (App::environment('production')) {
    URL::forceScheme('https');
}


Route::middleware(['web', 'auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('home');
    Route::patch('/derank/search/{id}', [DashboardController::class, 'derank'])->name('derank.search');
    Route::delete('/derank/{id}', [DashboardController::class, 'derank'])->name('derank.search');

    //contacts
    Route::resource('contacts', ContactController::class);

    //categories
    Route::resource('categories', CategoryController::class);

    //products
    Route::resource('products', ProductController::class);
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');

    //brands
    Route::resource('brands', BrandController::class);

    //users
    Route::resource('users', UserController::class);

    //orders
    Route::resource('orders', OrderController::class);
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/show/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
    Route::patch('/orders/{order}', [OrderController::class, 'update'])->name('orders.update');

    //logout
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    //dasboard


    //banners
    Route::resource('banners', BannerController::class);

    // Route for the index method in UserManualController
    Route::get('/usermanual', [UserManualController::class, 'index'])->name('usermanual.index');
});

Route::get('login', [AuthController::class, 'index'])
    ->name('login')
    ->middleware('guest');

Route::post('login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware(['guest', 'throttle:2,1']);

