<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\WithdrawsController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Products\SellerController; 

Route::prefix('/seller')->group(function() {

    Route::get('/products', [ProductsController::class, 'index'])->name('seller.products');

    Route::get('/', [SellerController::class, 'dashboard'])->name('seller.dashboard');

    Route::get('/tos', [SellerController::class, 'tos'])->name('seller.tos');

    Route::get('/create', [ProductsController::class, 'create'])->name('seller.create');
    Route::post('/create', [ProductsController::class, 'store'])->name('seller.store');
    Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('seller.edit');
    Route::post('/edit/{id}', [ProductsController::class, 'update'])->name('seller.update');
    Route::delete('/delete', [ProductsController::class, 'delete'])->name('seller.destroy');

    Route::get('/orders', [OrdersController::class, 'getSellerOrders'])->name('seller.orders');
    Route::get('/orders/{uuid}', [OrdersController::class, 'showSellerOrder'])->name('seller.order');
    Route::post('/orders/{uuid}', [OrdersController::class, 'completeOrder'])->name('seller.order.complete');
});

Route::get('/withdraw', [WithdrawsController::class, 'withdraw'])->name('withdraw');
Route::post('/withdraw', [WithdrawsController::class, 'requestWithdraw'])->name('withdraw.request');

