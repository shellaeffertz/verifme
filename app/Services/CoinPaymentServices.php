<?php

namespace App\Services;

use App\Models\User;
use App\Models\CoinPayment;
use Illuminate\Support\Arr;
use App\SDKs\CoinPaymentSDK;
use Illuminate\Support\Facades\Log;

class CoinPaymentServices
{
    private static $sdk;

    private static function getSDK()
    {
        return !self::$sdk ? self::createSDK() : self::$sdk;
    }

    private static function createSDK()
    {
        self::$sdk = new CoinPaymentSDK();
        return self::$sdk;
    }

    public static function createTransaction($amount, $coin, $user)
    {
        $response =  self::getSDK()->createTransaction($amount, $coin, $user->email, config('app.url').'/coinpayment/ipn');

        $data = json_decode($response['data'], true);
        if ($response['http_status'] != 200 || Arr::get($data, 'error') != 'ok')  dd(Arr::get($data, 'error'));
        // return null;

        $result = Arr::get($data, 'result');
        $coin_payment = CoinPayment::forceCreate([
            'user_id' => $user->id,
            'amount_usd' => $amount,
            'amount_coin' => Arr::get($result, 'amount'),
            'address' => Arr::get($result, 'address'),
            'coin' => $coin,
            'txn_id' => Arr::get($result, 'txn_id'),
            'status' => "pending",
            'status_url' => Arr::get($result, 'status_url'),
            'processed' => false,
            'qrcode_url' => Arr::get($result, 'qrcode_url'),
            'timeout_at' => date('Y-m-d H:i:s', Arr::get($result, 'timeout') + time()),
        ]);
        // dd(Arr::get()->all());
        // dd($coin_payment);
        return $coin_payment;
    }

    public static function handleIPN($data)
    {
        $txid = Arr::get($data, 'txn_id');

        $coin_payment = CoinPayment::where([
            'txn_id' => $txid,
            'processed' => false
        ])->first();

        if (!$coin_payment) return "not found";

        $response = self::getSDK()->getPaymentInfo($txid);
        $data = json_decode($response['data'], true);

        if ($response['http_status'] != 200 || Arr::get($data, 'error') != 'ok')  return $response;

        $result = Arr::get($data, 'result');

        Log::alert($result);

        if(Arr::get($result, 'status') >= 100) {
            $coin_payment->status = "completed";
            $coin_payment->processed = true;
            $coin_payment->save();

            $user = User::find($coin_payment->user_id);
            $user->balance += $coin_payment->amount_usd;
            $user->save();
        }

        if(Arr::get($result, 'status') == -1) {
            $coin_payment->status = "expired";
            $coin_payment->processed = true;
            $coin_payment->save();
        }

        return true;
    }

    public static function checkTransaction($txid)
    {
        return self::handleIPN(['txn_id' => $txid]);
    }

    public static function getUserTransactions($user, $filters)
    {
        $coin_payments = CoinPayment::where('user_id', $user->id);

        if (isset($filters['status'])) {
            $coin_payments->where('status', $filters['status']);
        }

        if (isset($filters['coin'])) {
            $coin_payments->where('coin', $filters['coin']);
        }

        return $coin_payments->orderBy('created_at', 'desc')->paginate(10);
    }

    public static function getPaymentStatus($user, $id)
    {
        $coin_payment = CoinPayment::where([
            'user_id' => $user->id,
            'id' => $id
        ])->first();

        if (!$coin_payment) return null;

        return $coin_payment;
    }
}
