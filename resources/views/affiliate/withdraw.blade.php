@extends('layouts.app')

@section('title')
    Withdraw Affiliate Balance
@endsection


@section('content')
    <form method="POST">
        <input type="number" name="amount" placeholder="Amount">
        <select name="coin">
            <option value="BTC">BTC</option>
            <option value="ETH">ETH</option>
            <option value="LTC">LTC</option>
        </select>
        <input type="text" name="address" placeholder="Address">
        <input type="submit" value="Withdraw">
    </form>

    <div class="withdraws">
        @foreach ($withdraws as $withdraw)
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $withdraw->amount }} USD</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $withdraw->coin }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $withdraw->address }}</h6>
                    <p class="card-text">{{ $withdraw->created_at }}</p>
                    <p class="card-text">{{ $withdraw->status }}</p>
                    @if ($withdraw->status == 'rejected')
                        <p class="card-text">{{ $withdraw->reject_reason }}</p>
                    @endif
                </div>
            </div>
        @endforeach
        {{ $withdraws->links() }}


    </div>
@endsection
