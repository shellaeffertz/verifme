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
                    /* Media query for smaller screens (e.g., mobile devices) */
    @media (max-width: 767px) {
        .order {
            flex-direction: column; /* Stack product info and chat on top of each other on mobile screens */
            padding: 1px;
        }
        .order-details{
            width: 100%;
        }

        .convo {
            margin-top: 20px; 
            width: 100% !important; /* Make the chat section take up the full width of the order div */
            
        }
        .chatt{
            width: 100%;
            /* height: auto !important; */
            
        }
    }

    </style>
    <link rel="stylesheet" href="{{ asset('../././css/chat-modal.css') }}" />
@endsection

@section('title')
    Order
@endsection

@section('subtitle')
    Order registered at | {{ $order->created_at }}
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


