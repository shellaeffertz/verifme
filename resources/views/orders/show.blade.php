@extends('layouts.app')

@section('style')
    <style>
        .order {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }

        .conversation_messages {
            height: 200px;
            background: #fff;
        }
    </style>
@endsection


@section('content')
    <div class="order">
        <div class="order_details">
            <h1>Order Details</h1>
            Title : {{ $order->title }} <br>
            Seller : {{ $order->seller->nickname }} <br>
            Price : {{ $order->price }} <br>

            Description : {{ $order->public_data->description }} <br>
            Delivery Type : {{ $order->delivery_type }} <br>
            Delivery Period : {{ $order->delivery_period }} <br>
            Country : {{ $order->public_data->country }} <br>
            Account Details : {{ $order->private_data->account_details }} <br>
            Account links : {{ $order->private_data->document_links }} <br>
        </div>
        <div class="chat">
            <div class="chat_messages">

            </div>
            <div class="chat_input">
                <div class="conversation">
                    <h1>Conversation</h1>
                    <div class="conversation_messages">

                    </div>
                </div>
                <form method="POST">
                    @csrf
                    <input type="text" name="message" id="message" placeholder="Type your message here">
                    <button type="submit">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('title')
    Order
@endsection


@push('script')
    <script>
        Echo.private('order.{{ $order->id }}')
            .listen('OrderMessageSent', (e) => {
                console.log(e);
            });
    </script>
@endpush
