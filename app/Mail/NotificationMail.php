<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $message;
    protected $url;
    protected $order_type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($message,$url,$order_type,$seller)
    {
        //
        $this->message = $message;
        $this->url = $url;
        $this->order_type = $order_type;
        $this->seller = $seller;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return  $this // Set the view for the email
                        ->from('support@verifme.com')
                        ->to($this->seller)
                        ->line('You have a new message '.$this->message->message."\n".'for the order :'.$order_type)
                        ->action('Viste your space for more action', url($this->url))
                        ->line('The team verifme thanks you for trusting us and using our market place!')
                        ->markdown('email.custom_email_view');
                   
        // $this->view('view.name');
    }
}
