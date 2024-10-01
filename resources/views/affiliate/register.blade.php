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
        <div class="create-form">
            <div class="form-group">
                <form method="POST">
                    <div>
                        <label for="code">Referral Code <br/> <small>URL EXAMPLE : {{config('app.url')}}/register?ref=xxxx</small></label>
                        <input type="text" name="code" placeholder="xxxxx">
                    </div>
                    <div class="form-btn-wrapper">
                        <button type="submit" class="simple-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection


