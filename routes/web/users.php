<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\WithdrawsController;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\Services\CoinPaymentController;


Route::get('/register', [UserController::class, 'registerView'])->name('register');
Route::post('/register', [UserController::class, 'register']);

Route::get('/login', [UserController::class, 'loginView'])->name('login');
Route::post('/login', [UserController::class, 'login']);

Route::get('/reset', [UserController::class, 'forgetPasswordView'])->name('reset');
Route::post('/reset', [UserController::class, 'forgetPassword']);

Route::get('/reset-password/{token}', [UserController::class, 'validateResetPasswordToken'])->name('reset-password');
Route::post('/reset-password/{token}', [UserController::class, 'resetPassword']);

Route::get('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::post('/profile', [UserController::class, 'update'])->middleware('auth');
Route::get('/profile', [UserController::class, 'show'])->middleware('auth');

Route::get('/buy', [CoinPaymentController::class, 'buy'])->middleware('auth');
Route::post('/buy', [CoinPaymentController::class, 'initializePayment'])->middleware('auth');

Route::post('/buy/check/{id}', [CoinPaymentController::class, 'refreshPaymentStatus'])->name('coinpayment.check')->middleware('auth');

Route::get('/withdraw', [WithdrawsController::class, 'withdraw'])->name('withdraw')->middleware('seller');
Route::post('/withdraw', [WithdrawsController::class, 'requestWithdraw'])->name('withdraw.request')->middleware('seller');

Route::get('/orders', [OrdersController::class, 'getBuyerOrders'])->name('orders')->middleware('auth');
Route::get('/orders/{uuid}', [OrdersController::class, 'showBuyerOrder'])->name('order')->middleware('auth');
// Route::post('/orders/{uuid}/messages', [OrdersController::class, 'sendMessage'])->name('order-message')->middleware('auth');

Route::get('/notifications', [NotificationsController::class, 'indexNotifications'])->name('user.notifications')->middleware('auth');
Route::get('/notifications/{id}', [NotificationsController::class, 'handleNotification'])->name('user.notification')->middleware('auth');
