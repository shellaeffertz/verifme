<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Message;
use App\Services\NotificationService;
use Livewire\Component;

class SupportChat extends Component
{

    public $message;
    public $support;

    public function render()
    {
        $messages = Message::where('source_type', 'support_ticket')->where('source_id', $this->support->id)->get();

        return view('livewire.support-chat', [
            'messages' => $messages,
            'user' => User::find($this->support->user_id)
        ]);
    }

    public function sendMessage()
    {
        if ($this->message == '') return;
        $message = new Message();
        $message->source_id = $this->support->id;
        $message->source_type = 'support_ticket';
        $message->sender_id = auth()->user()->id;
        $message->sender_type = 'user';
        $message->message = $this->message;
        $message->save();
        $this->message = '';
        NotificationService::addNotification( null, 'message_received', 'You have a new message from ticket', 'You have a new message', '/admin/support/' . $this->support->id);


        if ($this->support->user_id == auth()->user()->id) {
            $this->support->status = 'open';
            $this->support->save();
        }
    }
}
