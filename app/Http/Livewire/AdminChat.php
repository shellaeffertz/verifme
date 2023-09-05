<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

class AdminChat extends Component
{
    public $order;
    public $message;

    public function render()
    {
        $messages = Message::where('source_id', $this->order->id)->where('source_type', "order")->get();
        return view(
            'livewire.admin-chat',
            [
                'messages' => $messages
            ]
        );
    }
}
