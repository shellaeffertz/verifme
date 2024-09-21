@extends('layouts.app')

@section('style')
    <style>
        .order {
            display: flex;
            gap: 15px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border: 1px solid lightgray;
            border-radius: 15px;
        }

        .order-details {
            border: 1px solid lightgray;
            border-radius: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
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

            <div style="padding:20px;display:flex;justify-content: flex-end; gap: 15px;">
                <a class="simple-btn" style="text-decoration: none" href="order/refund/{{ $order->uuid }}">Refund</a>
            </div>

        </div>

        @livewire('admin-chat', ['order' => $order])

    </div>
@endsection

