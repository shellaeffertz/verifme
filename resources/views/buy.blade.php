@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('./assets/css/buy1.css') }}" />
    <link rel="stylesheet" href="{{ asset('././css/sucess-modal.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection


@section('content')


    <div class="create-form">

        <div class="form-group">

            <form action="/buy" method="post" class="buy-form">
    
                <div>
                    <label for="amount">Amount</label>
                    <input id="amount" type="number" name="amount" value="5">
                </div>
        
                <div class="select-box">
                    <label for="coin">Coin</label>
                    <select id="coin" name="coin">
                        <option value="BTC">BTC</option>
                        <option value="LTC">LTC</option>
                        <option value="ETH">ETH</option>
                        <option value="XMR">XMR</option>
                    </select>
                </div>
        
                <div class="form-btn-wrapper">
                    <button type="submit" class="simple-btn">Buy</button>
                </div>
        
            </form>
        </div>
    </div>

    <div class="con">

        <h2 class="section-headline">All PAYMENTS</h2>

        <div class="display-table">
            <table>

                <thead>
                    <tr>
                        <th>AMOUNT</th>
                        <th>COIN</th>
                        <th>AMOUNT COIN</th>
                        <th>DATE</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>

                @if ($coin_payments->count() > 0)
                    <tbody>
                        @foreach ($coin_payments as $coin_payment)
                            <tr>
                                <td mobile-title="AMOUNT">$ {{ $coin_payment->amount_usd }}</td>
                                <td mobile-title="COIN">{{ $coin_payment->coin }}</td>
                                <td mobile-title="AMOUNT COIN">{{ $coin_payment->amount_coin }} {{ $coin_payment->coin }}</td>
                                <td mobile-title="DATE">{{ $coin_payment->timeout_at }}</td>
                                <td mobile-title="STATUS">{{ $coin_payment->status }}</td>
                                <td mobile-title="Details"><i class="fa fa-arrow-down icone" id='test{{ $coin_payment->id }}'
                                        onclick="showDetails({{ $coin_payment->id }})"></i>
                                </td>
                            </tr>
                            <tr>
                                <td style="display: none" class="payment-details" id={{ $coin_payment->id }}>
                                    <div style="display: flex">
                                        <img src="{{ $coin_payment->qrcode_url }}" alt="qr code" style="width: 30%">
                                        <div class="details-items-under">
                                            <p class="wallet-adresse"> {{ $coin_payment->address }} </p>
                                            <a class="button-status" href="{{ $coin_payment->status_url }}"
                                                target="_blank">Status</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                @endif


            </table>
            {{ $coin_payments->links() }}

        </div>
    </div>





    <script type="text/javascript" src="./js/buy.js"></script>

    <style>
        @media (max-width: 768px) 
        {
        td{
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis;
        }
        }
        </style>
@endsection

@section('title')
    Buy
@endsection
