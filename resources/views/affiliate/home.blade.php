@extends('layouts.app')

@section('title')
    Affiliate Dashboard
@endsection


@section('content')

    <div class="create-form">

        <div class="form-group">

            <h2 class="section-headline">AFFILIATE INFORMATION</h2>
    
            <div>
                <label>My Referral Link</label>
                <input type="text" value="{{config('app.url')}}/?ref={{$user->affiliate_code}}" disabled/>
            </div>
    
    
            <div>
                <label>Affiliate Balance</label>
                <input type="text" value="{{ $user->affiliate_balance }}" disabled/>
            </div>
    
            <div>
                <label>Commission</label>
                <small>This is the commission you get for every sale made by your referrals or a buyer who signed up using your referral link</small>
                <input type="text" value="{{$user->affiliate_commission * 100}}%" disabled/>
            </div>

            <div>
                <label>Referrals</label>
                <small>These are the users who signed up using your referral link</small>
                <input type="text" value="{{$referrals}}" disabled/>
            </div>

            <div class="form-btn-wrapper">
                <a class="simple-btn" href = "/affiliate/withdraw" >Withdraw</a>
            </div>

        </div>

    </div>

@endsection