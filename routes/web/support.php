<?php

use App\Http\Controllers\SupportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', [SupportController::class, 'indexClient'])->name('support.client.index');
Route::get('/new', [SupportController::class, 'create'])->name('support.client.create');
Route::post('/new', [SupportController::class, 'store'])->name('support.client.store');
Route::post('/newReport', [SupportController::class, 'storeReport'])->name('support.client.storeReport');
Route::get('/{id}', [SupportController::class, 'showClient'])->name('support.client.show');
Route::post('/{id}', [SupportController::class, 'userReplay'])->name('support.client.replay');

