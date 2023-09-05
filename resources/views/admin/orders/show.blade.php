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
                    @include('admin.orders.products.bank_accounts')
                @break

                @case('payement_processors')
                    @include('admin.orders.products.payement_processors')
                @break

                @case('crypto_exchanges')
                    @include('admin.orders.products.crypto_exchanges')
                @break

                @case('cracked_account')
                    @include('admin.orders.products.cracked_account')
                @break

                @case('real_fakedocs')
                    @include('admin.orders.products.real_fakedocs')
                @break

                @default
            @endswitch
        </div>

        @livewire('admin-chat', ['order' => $order])

    </div>
@endsection

