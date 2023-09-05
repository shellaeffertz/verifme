<?php

namespace App\Http\Livewire;

use App\Models\Message;
use App\Services\NotificationService;
use Livewire\Component;

class SellerChat extends Component
{
    public $order;
    public $message;

    public function render()
    {
        $messages = Message::where('source_id', $this->order->id)->where('source_type', "order")->get();
        return view(
            'livewire.seller-chat',
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
        $message->sender_type = 'seller';
        $message->save();
        $this->message = '';
        NotificationService::addNotification( $this->order->buyer , 'message_received', 'You have a new message', 'You have a new message', '/orders/' . $this->order->uuid);

    }
}
