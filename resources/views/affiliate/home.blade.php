@extends('layouts.app')

@section('title')
    Affiliate Dashboard
@endsection


@section('content')
    <div>
        <button class="simple-btn" onclick="window.location.href='/affiliate/withdraw'">Withdraw</button>
        <h3>My Referral Link</h3>
        <p>{{config('app.url')}}/?ref={{$user->affiliate_code}}</p>
        <br>
        <h3>Affiliate Balance</h3>
        <p>${{$user->affiliate_balance}}</p>
        <br>
        <h3>Commission</h3>
        <p>this is the commission you get for every sale made by your referrals or a buyer who signed up using your referral link</p>
        <p>{{$user->affiliate_commission * 100}}%</p>
        <br>

        <h3>Referrals</h3>
        <p>these are the users who signed up using your referral link</p>
        <p> {{$referrals}}</p>

    </div>
@endsection