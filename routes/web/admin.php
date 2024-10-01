<?php

use App\Models\User;
use App\Models\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\WithdrawsController;
use Illuminate\Http\Request as LaravelRequest;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationsController;

Route::get('/notifications', [NotificationsController::class, 'indexAdminNotifications'])->name('admin.notifications');
Route::get('/notifications/{id}', [NotificationsController::class, 'handleAdminNotification'])->name('admin.notification');
Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
Route::get('/order/{uuid}', [AdminController::class, 'showOrder'])->name('admin.order');

Route::put('/order/refund', [AdminController::class, 'refundOrder'])->name('admin.order.refund');

Route::get('/withdraws', [WithdrawsController::class, 'withdraws'])->name('admin.withdraws');
Route::put('/withdraws/{id}', [WithdrawsController::class, 'processWithdraw'])->name('admin.withdraw-update');

Route::get('/support', [SupportController::class, 'indexAdmin'])->name('admin.support.index');
Route::get('/support/{id}', [SupportController::class, 'showAdmin'])->name('admin.support.show');
Route::post('/support/{id}', [SupportController::class, 'supportReplay'])->name('admin.support.replay');
Route::post('/support/{id}/complete', [SupportController::class, 'markAsCompleted'])->name('admin.support.complete');

Route::get('/affiliates', function (LaravelRequest $request) {
    $affiliate_requests = Request::join('users', 'users.id', '=', 'requests.user_id')->select('requests.*', 'users.username', 'users.email')->where('requests.type', 'affiliate')->where('requests.status', 'pending')->paginate(10);
    return view('admin.affiliates', compact('affiliate_requests'));
})->name('admin.affiliates');

Route::put('/affiliates/{id}', function (LaravelRequest $request, $id) {
    $affiliate_request = Request::find($id);
    if(!$affiliate_request) return redirect()->route('admin.affiliates')->withErrors(['Request not found.']);

    $request->validate([
        'status' => 'required|string|max:255|in:approved,rejected',
        'code' => 'nullable|string|max:255|unique:users,affiliate_code',
        'commission' => 'nullable|numeric|min:0|max:20',
    ]);

    if($request->status == 'approved'){
        $user = User::find($affiliate_request->user_id);
        $user->is_affiliate = true;
        $user->affiliate_code = $request->code ? $request->code : Str::random(8);
        $user->affiliate_commission = $request->commission ? $request->commission / 100 : 0.05;
        $user->save();
    }

    $affiliate_request->delete();

    return redirect()->route('admin.affiliates');
})->name('admin.affiliate-update');
