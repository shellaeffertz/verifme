<div class="convo">
    <h1>MESSAGES</h1>
    <div class="chatt">
        @foreach ($messages as $message)
            @if ($message->sender_id != $order->seller_id)
                <div class="sender my-msg" style="border-radius: 0 15px 15px 15px ;">
                    <img src="{{ asset('.././assets/user.png') }}" alt="Avatar" style="width:100%;">
                    <p>{{ $message->message }}</p>
                    <span class="time-right">{{ $message->created_at->format('H:i') }}</span>
                </div>
            @else
                <div class="sender " style="border-radius: 15px 0 15px 15px ;">
                    <img src="{{ asset('.././assets/user.png') }}" alt="Avatar" class="right" style="width:100%;">
                    <p>{{ $message->message }}</p>
                    <span class="time-left">{{ $message->created_at->format('H:i') }}</span>
                </div>
            @endif
        @endforeach
    </div>
</div>
