<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AffiliateController;

Route::get('/', [AffiliateController::class, 'createAffiliateRequest'])->name('affiliate.home')->middleware('auth');

Route::post('/', [AffiliateController::class, 'storeAffiliateRequest'])->name('affiliate.request')->middleware('auth');

Route::get('/withdraw', [AffiliateController::class, 'createWithdrawRequest'])->name('affiliate.withdraw')->middleware('affiliate');

Route::post('/withdraw', [AffiliateController::class, 'storeWithdrawRequest'])->name('affiliate.withdraw.store')->middleware('affiliate');