@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="{{ asset('./assets/css/seller-withdraw.css') }}" />
<link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}" />
<link rel="stylesheet" href="{{ asset('././css/sucess-modal.css') }}" />


@endsection

@section('title')
    Withdraws
@endsection

 
@section('content')
    
    <div class="create-form">

        <div class="form-group">

            <h2 class="section-headline">WITHDRAW</h2>

            <form method="POST">
 
                <div>
                    <label for="amount">Amount</label>
                    <input type="number" name="amount" placeholder="Amount" value="{{ old('amount') }}">
                </div>
        
                <div>
                    <label for="coin">Coin</label>
                    <select name="coin">
                        <option {{ old('coin') == 'BTC' ? 'selected' : '' }} value="BTC">BTC</option>
                        <option {{ old('coin') == 'ETH' ? 'selected' : '' }} value="ETH">ETH</option>
                        <option {{ old('coin') == 'LTC' ? 'selected' : '' }} value="LTC">LTC</option>
                    </select>
                </div>
                
                <div>
                    <label for="address">Adress</label>
                    <input type="text" name="address" placeholder="Address" value="{{ old('address') }}">
                </div>
                
                <div class="form-btn-wrapper">
                    <button class="simple-btn" type="submit">Withdraw</button>
                </div>
        
            </form>

        </div>

    </div>

    <div class="withdraws">
        @foreach ($withdraws as $withdraw)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        <span>{{ $withdraw->amount }} USD</span>
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span style="font-weight: bold; color: #1c3879;">Coin : </span>
                        <span>{{ $withdraw->coin }}</span>
                    </h6>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <span style="font-weight: bold; color: #1c3879;">Address : </span>
                        <span>{{ $withdraw->address }}</span>
                    </h6>
                    <p class="card-text">
                        <span style="font-weight: bold; color: #1c3879;">Registered At : </span>
                        <span>{{ $withdraw->created_at }}</span>
                    </p>
                    <p class="card-text">
                        <span style="font-weight: bold; color: #1c3879;">Status : </span>
                        <span>{{ ucfirst($withdraw->status) }}</span>
                    </p>
                    @if ($withdraw->status == 'rejected')
                        <p class="card-text">
                            <span style="font-weight: bold; color: #1c3879;" >Reason Of Reject : </span>
                            <p>{{ $withdraw->reject_reason }}</p>
                        </p>
                    @endif
                </div>
            </div>
        @endforeach
        {{ $withdraws->links() }}
    </div>

@endsection


