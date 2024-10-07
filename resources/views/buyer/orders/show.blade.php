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

        .order-details .pay-attention-message {
            color: red;
            font-size: 12px;
            padding: 5px 15px;
        }

        .order-details .private-info {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .order-details .private-info p {
            color: red;
            font-size: 12px;
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

            @if($order->delivery_type == 'preorder' && $order->status != 'completed')
                <p class="pay-attention-message">Please request all private information from the seller in the chat section and verify its quality before  marking the order as completed. If you encounter any issues, report the order.</p>
            @endif

            <div style="padding:20px;display:flex;justify-content: flex-end; gap: 15px;">
                <a class="simple-btn" href="/support/new?order={{$order->uuid}}">Report Order</a>
                @if ($order->status != 'completed')
                    <form method="POST" action="{{ route('buyer.order.complete', $order->uuid)}}">
                        <input type="hidden" name="type" value="{{ $order->type}}" />
                        <button type="submit" class="simple-btn">Complete</button>
                    </form>
                @endif
            </div>

        </div>
    
        @livewire('buyer-chat', ['order' => $order])
        
    </div>
    
    @endsection