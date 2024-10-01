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
            font-weight: bold;
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

    <div class="report-details">
        
        <h2 class="section-headline">ORDER DETAILS</h2>

        <div>
            <label>Title:</label>
            <input type="text" value="{{ $order->title }}" disabled>
        </div>

        <div>
            <label>Type:</label>
            <input type="text" value="{{ $order->type }}" disabled>
        </div>

        <div>
            <label>Status:</label>
            <input type="text" value="{{ $order->status }}" disabled>
        </div>

        <div>
            <label>Price:</label>
            <input type="text" value="{{ $order->price }}" disabled>
        </div>

        <div>
            <label>Seller Nickname:</label>
            <input type="text" value="{{ $order->seller->nickname }}" disabled>
        </div>

    </div>


    
    <form class="report-details" action="{{ route('support.client.storeReport') }}" method="POST">
        
        <h2 class="section-headline">REPORT A PROBELM</h2>

        <div>
            <label for="subject">Subject</label>
            <input type="text" name="subject" value="I'm having a issue with The order Number : {{$order->uuid}}" class="form-control" >
        </div>

        <input type="hidden" name="order" value="{{$order->uuid}}">

        <div>
            <label for="message">Message</label>
            <textarea rows="5" name="message"></textarea>
        </div>

        <div class="form-btn-wrapper">
            <button type="submit" class="simple-btn">Send</button>
        </div>
        
    </form>

@endsection


