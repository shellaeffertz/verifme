<?php

namespace App\Http\Livewire;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Notice;
use App\Models\Message;
use Livewire\Component;
use App\Mail\NotificationMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Services\NotificationService;
use App\Notifications\userNotification;
use App\Notifications\EmailNotification;

class BuyerChat extends Component
{
    public $order;
    public $message;
    
    public function render()
    {
        Log::info('Rendering buyer chat');
        $messages = Message::where('source_id', $this->order->id)->where('source_type', "order")->latest()->take(20)->get()->sortBy('id');
        // dd(User::find($this->order->seller_id)->isOnline());
        return view(
            'livewire.buyer-chat',
            [
                'messages' => $messages,
                'user' =>$user = User::find($this->order->seller_id)
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
        
        if($this->order->buyer->telegram_chat_id!=NULL){
        $noticeContent ='Hello'."\t".$this->order->buyer->nickname."\n" .'You have a new message : '.$message->message."\n"."From the user:".$this->order->seller->nickname."\n"."for your order:".$this->order->product->title."\n"."Price :".$this->order->price."\n".'please visite our market place to complete your order with the seller'."\t".$this->order->seller->nickname;


        $notice = new Notice([
            'id'  =>  Uuid::uuid4()->toString(),
            'notice' => $noticeContent,
            'noticedes' => $this->order->buyer->telegram_chat_id,
            'noticelink' => "https://verifme.com/orders/".$this->order->uuid,
       ]);
    
           $notice->notify(new userNotification());

           Log::info('Telegram notif sent');
    }

        // Mail::send(new NotificationMail($message,$url,$order_type,$seller));

       

        Log::info('Message sent');
        NotificationService::addNotification( $this->order->seller , 'message_received', 'You have a new message', 'You have a new message', '/seller/orders/' . $this->order->uuid);

        // $this->reset($message);
    }
}
