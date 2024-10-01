<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\Products\ProductsController;
use App\Http\Controllers\Services\CoinPaymentController;
use App\Http\Controllers\Account\UserController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\AdminController;

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

Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function() {
    Route::get('/users', [UserController::class, 'showUsers'])->name('admin.users');
    Route::get('/users/{id}', [UserController::class, 'showUser'])->name('admin.user-edit'); 
    Route::put('/users/{id}', [UserController::class, 'updateUser'])->name('admin.user-update');
    Route::delete('/delete', [AdminController::class, 'delete'])->name('admin.destroy');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/{id}', [AdminController::class, 'showProduct'])->name('admin.product.show');
});

Route::middleware(['auth', 'support'])->prefix('/admin')->group(base_path('routes/web/admin.php'));

Route::middleware(['auth', 'seller'])->group(base_path('routes/web/seller.php'));

Route::prefix('/')->group(base_path('routes/web/users.php'));

Route::any('coinpayment/ipn', [CoinPaymentController::class, 'handleIPN'])->name('coinpayment.ipn');

Route::middleware('auth')->group(base_path('routes/web/users.php'));

Route::prefix('/affiliate')->group(base_path('routes/web/affiliate.php'));

Route::middleware('auth')->get('/impersonation/end', [ImpersonateController::class, 'leave'])->name('leave-impersonation');

Route::middleware('admin')->get('/impersonation/start/{id}', [ImpersonateController::class, 'start'])->name('start-impersonation');

Route::middleware('guest')->group(function() {

    Route::get('/register', [UserController::class, 'registerView'])->name('register');
    Route::post('/register', [UserController::class, 'register']);

    Route::get('/login', [UserController::class, 'loginView'])->name('login');
    Route::post('/login', [UserController::class, 'login']);

    Route::get('/reset', [UserController::class, 'forgetPasswordView'])->name('reset');
    Route::post('/reset', [UserController::class, 'forgetPassword']);

    Route::get('/reset-password/{token}', [UserController::class, 'validateResetPasswordToken'])->name('reset-password'); 
    Route::post('/reset-password/{token}', [UserController::class, 'resetPassword']);
});

Route::prefix('/products')->group(function () {
    Route::get('/accounts', [ProductsController::class, 'accounts'])->name('products.accounts');
    Route::get('/cracked', [ProductsController::class, 'rdps'])->name('products.rdps');
    Route::get('/payement-process', [ProductsController::class, 'hostings'])->name('products.hostings');
    Route::get('/smtps', [ProductsController::class, 'smtps'])->name('products.smtps');
    Route::get('/crypto', [ProductsController::class, 'leads'])->name('products.leads');
});

Route::get('/', function () {    
    return view('welcome');
})->name('home');

Route::fallback(function (Request $request) {
    return "404";
})->name('404')->middleware('auth');