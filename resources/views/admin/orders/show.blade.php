@extends('layouts.app')

@section('style')
    <style>
        .order {
            display: flex;
            gap: 15px;
           margin: 30px 0;
        }

        .order-details {
            border: 1px solid lightgray;
            background-color: white;
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

@section('subtitle')
    Order registered at {{ $order->created_at }}
@endsection


@section('content')

    <div class="back-btn-wrapper">
        @if(count(explode('orders', url()->previous())) == 1)
            <a class="simple-btn" href="{{ route('admin.support.show', \App\Models\SupportTicket::where('order_uuid', $order->uuid)->first()->id) }}">
                <i class="fa-solid fa-circle-arrow-left" style="font-size: 24px;"></i>
            </a>
        @else
            <a class="simple-btn" href="{{ url()->previous() }}">
                <i class="fa-solid fa-circle-arrow-left" style="font-size: 24px;"></i>
            </a>
        @endif
    </div>

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

            @if(! $order->refunded)
            <div style="padding:20px;display:flex;justify-content: flex-end; gap: 15px;">
                <form method="POST" action="{{ route('admin.order.refund') }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="order_uuid" value="{{ $order->uuid }}" />
                    <button class="simple-btn" type="submit">Refund</button>
                </form>
            </div>
            @else
                <p style="padding:20px; display:flex; justify-content: flex-end; align-items: center; gap:5px;">
                    <i class="fa-solid fa-check" style="color: green; font-size: 18px;"></i>
                    <span style="font-size: 14px;">Refunded</span>
                </p>
            @endif
        </div>

        @livewire('admin-chat', ['order' => $order])

    </div>
@endsection

