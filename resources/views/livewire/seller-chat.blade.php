<div class="convo">
    <h1>MESSAGES</h1>
    <div class="chatt">


        @foreach ($messages as $message)
            @if ($message->sender_id != $order->seller_id)
                <div class="sender my-msg" style="border-radius: 0 15px 15px 15px ;">
                    <img src="{{ asset('.././assets/user.png') }}" alt="Avatar" style="width:100%;">
                    <p>{{ $message->message }}</p>
                    <span class="time-right">11:00</span>
                </div>
            @else
                <div class="sender " style="border-radius: 15px 0 15px 15px ;">
                    <img src="{{ asset('.././assets/user.png') }}" alt="Avatar" class="right" style="width:100%;">
                    <p>{{ $message->message }}</p>
                    <span class="time-left">11:01</span>
                </div>
            @endif
        @endforeach
    </div>
    <form wire:submit.prevent="sendMessage" class="msg-form">
        <input type="text" wire:model="message" class="msg-input" placeholder="Type a message" />
        <button type="submit" class="msg-btn">Send</button>
    </form>
</div>
