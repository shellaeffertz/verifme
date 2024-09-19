<div class="convo">
    <h1>MESSAGES</h1>
    <div class="chatt" wire:poll>
        @foreach ($messages as $message)
            @if ($message->sender_id != $order->seller_id)
                {{-- <div class="sender my-msg" style="border-radius: 0 15px 15px 15px ;">
                    <img src="{{ asset('.././assets/user.png') }}" alt="Avatar" style="width:100%;">
                    <p>{{ $message->message }}</p>
                    <span id="messageTime" class="time-right">{{ $message->created_at->format('H:i') }}</span>
                </div> --}}
                @if($user->isOnline())
                    <div class="sender my-msg" style="border-radius: 0 15px 15px 15px ;">
                        <img src="{{ asset('.././assets/icons/user_online_icon.png') }}" alt="Avatar" style="width:100%;">
                        <p>{{ $message->message }}</p>
                        <span id="messageTime" class="time-right" style="color:white;">{{ $message->created_at->diffForHumans(null,false,false) }}</span>
                    </div>
                @else 
                    <div class="sender my-msg" style="border-radius: 0 15px 15px 15px ;">
                        <img src="{{ asset('.././assets/icons/user_offline_icon.png') }}" alt="Avatar" style="width:100%;">
                        <p>{{ $message->message }}</p>
                        <span id="messageTime" class="time-right" style="color:white;">{{ $message->created_at->diffForHumans(null,false,false) }}</span>
                    </div>
                @endif

            @else
                <div class="sender" style="border-radius: 15px 0 15px 15px ;">
                    <img src="{{ asset('.././assets/user.png') }}" alt="Avatar" class="right" style="width:100%;">
                    <p>{{ $message->message }}</p>
                    <span id="messageTime" class="time-left">{{ $message->created_at->diffForHumans(null,false,false) }}</span>
                </div> 
            @endif
        @endforeach
    </div>
    <form wire:submit.prevent="sendMessage" class="msg-form">
        <input type="text" wire:model="message" class="msg-input" placeholder="Type a message" />
        <button type="submit" class="msg-btn">Send</button>
    </form>
</div>
{{-- <script>
    // Function to update the time dynamically
    function updateTime() {
        const messageTime = document.getElementById('messageTime');
        const currentTime = new Date();
        const hours = currentTime.getHours().toString().padStart(2, '0');
        const minutes = currentTime.getMinutes().toString().padStart(2, '0');
        messageTime.textContent = hours + ':' + minutes;
    }

    // Update the time immediately and then update every minute
    updateTime();
    setInterval(updateTime, 60000); // Update every minute (60,000 milliseconds)
</script> --}}