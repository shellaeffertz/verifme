@extends('layouts.app')

@section('title')
    Join Our Affiliate Program
@endsection
@section('subtitle')
    Earn money by referring customers to us
    <br>
    and get paid for up to 10% for every order they place.
@endsection

@section('content')
    @if($affiliate_request)
        <div class="alert alert-warning" role="alert">
            Your affiliate request is pending approval.
        </div>
    @else
        <form method="POST">
            <div>
                <label for="code">Referral Code <small>{{config('app.url')}}/register?ref=xxxx</small></label>
                <br>
                <input type="text" name="code" placeholder="xxxxx">
            </div>
            <input type="submit" value="Submit">
        </form>
    @endif
@endsection


