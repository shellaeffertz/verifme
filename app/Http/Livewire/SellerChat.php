<?php

namespace App\Http\Livewire;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Notice;
use App\Models\Message;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;
use App\Notifications\userNotification;

class SellerChat extends Component
{
    public $order;
    public $message;

    public function render()
    {
        $messages = Message::where('source_id', $this->order->id)->where('source_type', "order")->latest()->take(20)->get()->sortBy('id');
        // dd(User::find($this->order->buyer_id)->isOnline());
        return view(
            'livewire.seller-chat',
            [
                'messages' => $messages,
                'user' =>$user = User::find($this->order->buyer_id)
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

        if($this->order->seller->telegram_chat_id!=NULL){
        // $noticeContent ='Hello'."\t".$this->order->seller->nickname."\n" .'You have a new message : '.$message->message."\n"."From the user:".$this->order->buyer->nickname."\n"."for your order:".$this->order->product->title."\n"."Price :".$this->order->price."\n".'please visite our market place to complete your order with the buyer'."\t".$this->order->buyer->nickname;

        $noticeContent = 'you sent a message';

        $notice = new Notice([
            'id'  =>  Uuid::uuid4()->toString(),
            'notice' => $noticeContent,
            'noticedes' => $this->order->seller->telegram_chat_id,
            'noticelink' => "https://verifme.com/orders/".$this->order->uuid,
       ]);
    
        $notice->notify(new userNotification());

        Log::info('Telegram notif sent');
    }

        NotificationService::addNotification( $this->order->buyer , 'message_received', 'You have a new message', 'You have a new message', '/orders/' . $this->order->uuid);

        // $this->reset($message);
    }
}
