@extends('layouts.app')

@section('style')
    <style>
        .form-group {
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 10px;
        }

        input[type=text],
        input[type=email],
        input[type=password],
        select,
        textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: none;
        }
    </style>
@endsection

@section('title')
    Order Report
@endsection

@section('subtitle')
    Report a Problem with My Order {{ $order->uuid }}
@endsection

@section('content')

    <h2>Order Details</h2>
    <div class="report-details">
        <label for="nickname">Product title:</label>
        <input type="text" name="nickname" value=" {{ $order->title }}" disabled>

        <label for="nickname">Product type:</label>
        <input type="text" name="nickname" value=" {{ $order->type }}" disabled>

        <label for="nickname">Product status:</label>
        <input type="text" name="nickname" value=" {{ $order->status }}" disabled>

        <label for="nickname">Product Price:</label>
        <input type="text" name="nickname" value=" {{ $order->price }}" disabled>

        <label for="nickname">Seller Nickname:</label>
        <input type="text" name="nickname" value=" {{ $order->seller->nickname }}" disabled>

    </div>


    <h2>Report a Problem</h2>

    <form class="report-details" action="{{ route('support.client.storeReport') }}" method="POST">
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" name="subject" value="I'm having a issue with The order Number : {{$order->uuid}}" class="form-control" >
        </div>
        <input type="hidden" name="order" value="{{$order->uuid}}">
        <div class="form-group">
            <label for="message">Message</label>
            <textarea name="message"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="simple-btn">Send</button>
        </div>
    </form>
@endsection


