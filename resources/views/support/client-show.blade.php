@extends('layouts.app')

@section('style')
    <style>
        .ticket_details {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .ticket_details__subject {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            padding: .5rem 1rem;
            border-radius: .25rem;
            overflow: hidden;
            background-color: #1c387952;

        }

        .ticket_details__message {
            font-size: 16px;
            background-color: #1c387944;
            padding: .5rem 1rem;
            border-radius: .25rem;
            overflow: hidden;
        }

        .ticket_label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 10px;

        }

        .chat {
            margin-top: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .chat-container{
            max-height: 250px;
            overflow-y: auto;
        }


        /* width */
        .chat-container::-webkit-scrollbar {
            width: 4px;
        }

        /* Track */
        .chat-container::-webkit-scrollbar-track {
            background: var(--background--main);
        }

        /* Handle */
        .chat-container::-webkit-scrollbar-thumb {
            background: var(--text-main)
        }

        /* Handle on hover */
        .chat-container::-webkit-scrollbar-thumb:hover {
            background: var(--accent-color-400);
        }



        .chat_headline {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .chat_subheadline {
            font-size: .75rem;
            margin-bottom: 10px;
            font-style: italic;
            font-weight: normal;
        }

        .chat_message {
            margin-bottom: .5rem;
            width: 100%;
        }

        .chat_message__message__client {
            font-size: 16px;
            background-color: #1abe7a44;
            padding: .5rem 1rem;
            border-radius: .25rem;
            overflow: hidden;
            margin-left: auto;
            width: fit-content;
            max-width: 80%;

        }

        .chat_message__message__admin {
            font-size: 16px;
            background-color: #2e0950c7;
            padding: .5rem 1rem;
            border-radius: .25rem;
            overflow: hidden;
            width: fit-content;
            max-width: 80%;

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
@endsection

@section('title')
    Support Ticket
@endsection

@section('subtitle')
    {{ $support->created_at }} |
    {{ $support->status }}
@endsection


@section('content')
    <div class="ticket_details">
        <div class="ticket_label">Subject</div>
        <div class="ticket_details__subject">
            {{ $support->subject }}
        </div>
        <div class="ticket_label">Message</div>

        <div class="ticket_details__message">
            {{ $support->message }}
        </div>
    </div>

    @livewire('support-chat', ['support' => $support], key($support->id))
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
