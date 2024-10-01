@extends('layouts.app')

@section('style')
    <style>
        .order-details .ticket_details {
            display: flex;
            flex-direction: column;
            gap: 15px !important;
        }

        .ticket_details div {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .ticket_label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .order {
            display: flex;
            gap: 15px;
            padding: 20px;
        }

        .order-details {
            border: 1px solid lightgray;
            background-color: white;
            border-radius: 15px;
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 15px;
            gap: 20px;
        }
        .order-details .report, .order-details .report-message {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .order-details .report div:not(.form-btn-wrapper) {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        label {
            font-weight: bolder;
            font-size: .7rem;
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

        input[type=text],
        input[type=email],
        input[type=password],
        select,
        textarea {
            padding: 0.5rem 1rem;
            border: 1px solid #ccc;
            border-radius: 3px;
            resize: none;
            font-size: .75rem;

        }

        .send {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .send__input {
            width: 100%;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('../././css/chat-modal.css') }}" />

@endsection

@section('title')
    Support Ticket
@endsection

@section('subtitle')
    {{ $support->created_at }} |
    {{ $support->status }}
@endsection


@section('content')

    <div class="back-btn-wrapper">
        <a class="simple-btn" href="{{ route('admin.support.index') }}">
            <i class="fa-solid fa-circle-arrow-left" style="font-size: 24px;"></i>
        </a>
    </div>

    <div class="order">
        <div class="order-details">
            @if ($support->type == 'report' && $order)
                <div class="report">
    
                    <h2 style="font-size: 20px; font-weight: bold">ORDER</h2>
    
                    <div>
                        <label>Product type:</label>
                        <input type="text" value="{{ $order->type }}" disabled>
                    </div>
    
                    <div>
                        <label>Product status:</label>
                        <input type="text" value="{{ $order->status }}" disabled>
                    </div>
    
                    <div>
                        <label>Seller Nickname:</label>
                        <input type="text" value="{{ $order->seller->nickname }}" disabled>
                    </div>
    
    
                    <div class="form-btn-wrapper">
                        <a href="{{ route('admin.order', $order->uuid) }}" class="simple-btn">View</a>
                    </div>
    
                </div>
            @endif
    
            <div class="report-message" >
    
                <h2 style="font-size: 20px; font-weight: bold">REPORT</h2>
    
                <div class="ticket_details">
                    <div>
                        <label>Subject:</label>
                        <input type="text" value="{{ $support->subject }}" disabled>
                    </div>
                    <div>
                        <label>Message:</label>
                        <textarea rows="5" disabled>{{ $support->message }}</textarea>
                    </div>
                </div>
    
                <form action="{{ route('admin.support.complete', $support->id) }}" method="POST">
                    <div class="form-btn-wrapper">
                        <button type="submit" class="simple-btn">Complete</button>
                    </div>
                </form>
    
            </div>
        </div>
    
        @livewire('support-chat', ['support' => $support], key($support->id))
    </div>
@endsection



@push('script')
    <script>
        var chat_container = document.querySelector(".chat-container");
        // add event listener to the chat container
        chat_container.addEventListener("change", function() {
            var objDiv = document.querySelector(".chat-container");
            objDiv.scrollTop = objDiv.scrollHeight;
        });
    </script>
@endpush
