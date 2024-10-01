<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\telegramController;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Services\CoinPaymentController;

Route::prefix('/products')->group(function () {
    Route::post('/buy', [ProductsController::class, 'buy'])->name('products.buy');
    Route::get('/accounts', [ProductsController::class, 'accounts'])->name('products.accounts');
    Route::get('/gateways', [ProductsController::class, 'gateways'])->name('products.gateways');
    Route::get('/wallets', [ProductsController::class, 'wallets'])->name('products.wallets');
    Route::get('/cracked', [ProductsController::class, 'rdps'])->name('products.rdps');
    Route::get('/payement-process', [ProductsController::class, 'hostings'])->name('products.hostings');
    Route::get('/smtps', [ProductsController::class, 'smtps'])->name('products.smtps');
    Route::get('/crypto', [ProductsController::class, 'leads'])->name('products.leads');
});

Route::prefix('/support')->group(function() {
    Route::get('/', [SupportController::class, 'indexClient'])->name('support.client.index');
    Route::get('/new', [SupportController::class, 'create'])->name('support.client.create');
    Route::post('/new', [SupportController::class, 'store'])->name('support.client.store');
    Route::post('/newReport', [SupportController::class, 'storeReport'])->name('support.client.storeReport');
    Route::get('/{id}', [SupportController::class, 'showClient'])->name('support.client.show');
    Route::post('/{id}', [SupportController::class, 'userReplay'])->name('support.client.replay');
});

Route::get('/logout', [UserController::class, 'logout']);

Route::put('/profile', [UserController::class, 'update']);
Route::get('/profile', [UserController::class, 'show']);

Route::get('/buy', [CoinPaymentController::class, 'buy']);
Route::post('/buy', [CoinPaymentController::class, 'initializePayment']);

Route::post('/buy/check/{id}', [CoinPaymentController::class, 'refreshPaymentStatus'])->name('coinpayment.check');

Route::get('/orders', [OrdersController::class, 'getBuyerOrders'])->name('orders');
Route::get('/orders/{uuid}', [OrdersController::class, 'showBuyerOrder'])->name('order');
Route::post('/orders/{uuid}', [OrdersController::class, 'completeOrder'])->name('buyer.order.complete');

Route::get('/notifications', [NotificationsController::class, 'indexNotifications'])->name('user.notifications');
Route::get('/notifications/{id}', [NotificationsController::class, 'handleNotification'])->name('user.notification');

Route::get('/auth/telegram/redirect', function(){
    return Socialite::driver('telegram')->redirect();
});

Route::post('/message', [telegramController::class,'message']);

Route::get('/auth/telegram/callback', [telegramController::class,'callback']); 
