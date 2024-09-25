<?php

namespace App\Http\Controllers\Services;

use App\Models\CoinPayment;
use Illuminate\Http\Request;
use App\Http\Requests\BuyRequest;
use Illuminate\Support\Facades\Log; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\CoinPaymentServices;

class CoinPaymentController extends Controller
{
    public function createTransaction(Request $request)
    {
        $user = Auth::user();
        $amount = $request->get('amount');
        $response = CoinPaymentServices::createTransaction($amount, 'BTC', $user);
        return response()->json($response);
    }

    public function handleIPN(Request $request)
    {
        $data = $request->all();
        Log::alert($data);
        $response = CoinPaymentServices::handleIPN($data);
        return response()->json($response);
    }

    public function getPaymentList(Request $request)
    {
        $user = $request->user();
        $response = CoinPaymentServices::getUserTransactions($user, $request->all());
        return response()->json($response);
    }

    public function getPaymentStatus(Request $request, $id)
    {
        $user = $request->user();
        $response = CoinPaymentServices::getPaymentStatus($user, $id);
        return response()->json($response);
    }

    public function refreshPaymentStatus(Request $request, $id)
    {
        $user = Auth::user();
        $response = CoinPaymentServices::checkTransaction($id);
        return response()->json($response);
    }

    public function buy(Request $request)
    {
        $user = $request->user();
        $coin_payments = CoinPayment::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(5);
        return view('buy', [
            'user' => $user,
            'coin_payments' => $coin_payments
        ]);
    }

    public function initializePayment(BuyRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();
        $amount = $data['amount'];
        $coin = $data['coin'];
        $coin_payment = CoinPaymentServices::createTransaction($amount, $coin, $user);
        if (!$coin_payment) return redirect("/buy")->with('error', 'Something went wrong, please try again later');
        return view('buy-details', [
            'user' => $request->user(),
            'coin_payment' => $coin_payment
        ]);
    }
}
