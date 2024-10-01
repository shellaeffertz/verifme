<?php

namespace App\SDKs;

class CoinPaymentSDK
{
    public $private_key;
    public $public_key;


    public function __construct()
    {
        $this->private_key = config('services.coinpayment.private_key');
        $this->public_key = config('services.coinpayment.public_key');
    }

    public function createTransaction($amount, $coin, $email, $ipn = null)
    {
        $params = [
            'amount' => $amount,
            'currency1' => 'USD',
            'currency2' => $coin,
            'buyer_email' => $email,
        ];

        if($ipn) {
            $params['ipn_url'] = $ipn;
        }

        $params['cmd'] = 'create_transaction';
        $params['version'] = 1;
        $params['key'] = $this->public_key;
        $params['format'] = 'json';
        $header_HMAC = hash_hmac('sha512', http_build_query($params), $this->private_key);
        $base_url = 'https://www.coinpayments.net/api.php';
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'HMAC: ' . $header_HMAC,
            'Content-Type: application/x-www-form-urlencoded'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        $result = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [
            'data' => $result,
            'http_status' => $http_status,
        ];
    }

    public function getPaymentsStatus($txids)
    {
        $params = [
            'txid' => implode('|', $txids),
        ];
        
        $params['cmd'] = 'get_tx_info_multi';
        $params['version'] = 1;
        $params['key'] = $this->public_key;
        $params['format'] = 'json';
        $header_HMAC = hash_hmac('sha512', http_build_query($params), $this->private_key);
        $base_url = 'https://www.coinpayments.net/api.php';
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'HMAC: ' . $header_HMAC,
            'Content-Type: application/x-www-form-urlencoded'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        $result = curl_exec($ch);
        $result = json_decode($result, true);
        return $result;
    }

    public function getPaymentInfo($txid)
    {
        $params = [
            'txid' => $txid,
        ];
        
        $params['cmd'] = 'get_tx_info';
        $params['version'] = 1;
        $params['key'] = $this->public_key;
        $params['format'] = 'json';
        $header_HMAC = hash_hmac('sha512', http_build_query($params), $this->private_key);
        $base_url = 'https://www.coinpayments.net/api.php';
        $ch = curl_init($base_url);
        curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'HMAC: ' . $header_HMAC,
            'Content-Type: application/x-www-form-urlencoded'
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        $result = curl_exec($ch);
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return [
            'data' => $result,
            'http_status' => $http_status,
        ];
    }
}
