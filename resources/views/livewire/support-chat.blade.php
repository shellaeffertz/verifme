<div>
    <div class="chat">
        <div class="chat_headline">Chat</div>
        <div class="chat_subheadline">You can chat with our support team here.</div>
        <div class="chat-container">
            @foreach ($messages as $m)
                <div class="chat_message" wire:key="{{ $m->id }}">
                    @if ($m->sender_id == auth()->user()->id)
                        <div class="chat_message__message__client">
                            {{ $m->message }}
                        </div>
                    @else
                        <div class="chat_message__message__admin">
                            {{ $m->message }}
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <div class="send">
            <input type="text" wire:model="message" class="send__input" onclick="scroll()"
                wire:keydown.enter="sendMessage">
            <button class="simple-btn" wire:click="sendMessage" onclick="scroll()">Send</button>
        </div>
    </div>
    <script>
        let scroll = () => {
            let chat_container = document.querySelector(".chat-container");
            chat_container.scrollTop = chat_container.scrollHeight;
        }
        scroll();
    </script>
</div>
