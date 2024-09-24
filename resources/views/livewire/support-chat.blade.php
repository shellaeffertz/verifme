<div class="convo">
    <h1>Chat With The Support Team</h1>
    <div class="chatt" wire:poll>
        @foreach ($messages as $message)
            @if (auth()->user()->id == $message->sender_id)
                <div class="sender" style="border-radius: 15px 0 15px 15px ;">
                    <img src="{{ asset('.././assets/user.png') }}" alt="Avatar" class="right" style="width:100%;">
                    <p>{{ $message->message }}</p>
                    <span id="messageTime" class="time-left">{{ $message->created_at->diffForHumans(null,false,false) }}</span>
                </div>
            @else
                @if($user->isOnline())
                    <div class="sender my-msg" style="border-radius: 15px 0 15px 15px ;">
                        <img src="{{ asset('.././assets/icons/user_online_icon.png') }}" alt="Avatar" style="width:100%;">
                        <p>{{ $message->message }}</p>
                        <span id="messageTime" class="time-right" style="color:white;">{{ $message->created_at->diffForHumans(null,false,false) }}</span>
                    </div>
                @else
                    <div class="sender my-msg" style="border-radius: 15px 0 15px 15px ;">
                        <img src="{{ asset('.././assets/icons/user_offline_icon.png') }}" alt="Avatar" style="width:100%;">
                        <p>{{ $message->message }}</p>
                        <span id="messageTime" class="time-right" style="color:white;">{{ $message->created_at->diffForHumans(null,false,false) }}</span>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
    <form wire:submit.prevent="sendMessage" class="msg-form">
        <textarea rows="3" wire:model="message" class="msg-input" placeholder="Type your message"></textarea>
        <button type="submit" class="simple-btn">Send</button>
    </form>
</div>