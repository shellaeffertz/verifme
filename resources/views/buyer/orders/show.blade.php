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
    </style>
    <link rel="stylesheet" href="{{ asset('../././css/chat-modal.css') }}" />
@endsection

@section('title')
    Order
@endsection


@section('content')
    @if ($order->status == 'pending')
        <div class="order-status">
            <div class="order-status-title">
                Order Status
            </div>
            <div class="order-status-content">
                <div class="order-status-content-title">
                    Pending
                </div>
                <div class="order-status-content-description">
                    Your order is pending. Please wait for the seller to accept your order.
                    <br>
                    You can contact the seller by clicking the chat button.
                    <br>
                    or create a dispute by clicking the dispute button.
                </div>
            </div>
        </div>
    @endif

    <div class="order">
        <div class="order-details">
            @switch($order->type)
                @case('accounts')
                    @include('buyer.orders.products.bank_accounts')
                @break

                @case('payement_processors')
                    @include('buyer.orders.products.hostings')
                @break

                @case('crypto_exchanges')
                    @include('buyer.orders.products.leads')
                @break

                @case('cracked_account')
                    @include('buyer.orders.products.rdps')
                @break

                @case('real_fakedocs')
                    @include('buyer.orders.products.smtps')
                @break

                @default
                @break
            @endswitch
        </div>

        @livewire('buyer-chat', ['order' => $order])
    @endsection
