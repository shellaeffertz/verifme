<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BuyerChat extends Component
{
    public $order;
    public $message;

    public function render()
    {
        Log::info('Rendering buyer chat');
        $messages = Message::where('source_id', $this->order->id)->where('source_type', "order")->get();
        return view(
            'livewire.buyer-chat',
            [
                'messages' => $messages
            ]
        );
    }

    public function sendMessage()
    {
        if ($this->message == '') return;

        $message = new Message();
        $message->source_id = $this->order->id;
        $message->source_type = 'order';
        $message->sender_id = auth()->user()->id;
        $message->message = $this->message;
        $message->sender_type = 'buyer';
        $message->save();
        $this->message = '';
        Log::info('Message sent');
        NotificationService::addNotification( $this->order->seller , 'message_received', 'You have a new message', 'You have a new message', '/seller/orders/' . $this->order->uuid);

    }
}
