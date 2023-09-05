@extends('layouts.app')

@section('style')
    <style>
        .order {
            display: flex;
            justify-content: space-between;
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .order-details {
            width: 60%
        }

        label {
            font-weight: bolder;
            font-size: .7rem
        }
    </style>
    <link rel="stylesheet" href="{{ asset('../././css/chat-modal.css') }}" />
@endsection

@section('title')
    Order
@endsection


@section('content')
    <div class="order">
        <div class="order-details">
            @switch($order->type)
                @case('bank_accounts')
                    @include('seller.orders.products.bank_accounts')
                @break

                @case('payement_processors')
                    @include('seller.orders.products.hostings')
                @break

                @case('crypto_exchanges')
                    @include('seller.orders.products.leads')
                @break

                @case('cracked_account')
                    @include('seller.orders.products.rdps')
                @break

                @case('real_fakedocs')
                    @include('seller.orders.products.smtps')
                @break

                @default
            @endswitch
        </div>

        @livewire('seller-chat', ['order' => $order])

    </div>
@endsection


