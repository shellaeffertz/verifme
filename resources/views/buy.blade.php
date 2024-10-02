@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/buy1.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/seller-products.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././css/sucess-modal.css') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                            <td>
                                <button onclick="info('{{ $coin_payment->qrcode_url }}', '{{ $coin_payment->address }}', '{{ $coin_payment->status_url }}')" class="simple-btn" type="button">Info</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>

        {{ $coin_payments->links() }}

    </div>

    <div id="info-modal" class="delete-modal">
        <div class="delete-modal-content" id="info-modal-content">
        </div>
    </div>

    <script type="text/javascript" src="./js/buy.js"></script>

@endsection

@section('title')
    Buy
@endsection
