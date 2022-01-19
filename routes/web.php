<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HouseController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RentController;
use Illuminate\Support\Facades\Route;


Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/registration', [RegisterController::class, 'index'])->name('registration');

Route::post('/login', [LoginController::class, 'login']);
Route::post('/registration', [RegisterController::class, 'save']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/rent/{id}', [RentController::class, 'index'])->middleware('auth')->name('rent-house');
Route::post('/rent/{id}', [RentController::class, 'rentHouse']);

Route::get('/profile', [IndexController::class, 'profile'])->middleware('auth')->name('profile');

Route::name('admin.')->middleware(['auth', 'admin'])->group(function() {
    Route::get('/admin', [IndexController::class, 'admin'])->name('index');

    Route::name('categories.')->group(function() {
        Route::get('/admin/categories', [CategoryController::class, 'index'])->name('categories');

        Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('create-category');
        Route::post('/admin/categories/create', [CategoryController::class, 'store']);

        Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->name('edit-category');
        Route::post('/admin/categories/{category}/edit', [CategoryController::class, 'update']);

        Route::delete('/admin/categories/{category}/delete', [CategoryController::class, 'destroy'])->name('delete-category');
    });

    Route::name('houses.')->group(function() {
        Route::get('/admin/houses', [HouseController::class, 'index'])->name('houses');

        Route::get('/admin/houses/create', [HouseController::class, 'create'])->name('create-house');
        Route::post('/admin/houses/create', [HouseController::class, 'store']);

        Route::get('/admin/houses/{house}/edit', [HouseController::class, 'edit'])->name('edit-house');
        Route::post('/admin/houses/{house}/edit', [HouseController::class, 'update']);

        Route::delete('/admin/houses/{house}/delete', [HouseController::class, 'destroy'])->name('delete-house');
    });

    Route::name('orders.')->group(function() {
        Route::get('/admin/orders', [OrderController::class, 'index'])->name('orders');

        Route::get('/admin/orders/{order}/change-status', [OrderController::class, 'editStatus'])->name('change-status-order');
        Route::post('/admin/orders/{order}/change-status', [OrderController::class, 'updateStatus']);
    });
});

