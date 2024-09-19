<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Channels\MailChannel;
use Illuminate\Notifications\Messages\MailMessage;

class EmailNotification extends Notification
{
    use Queueable;
    protected $notification_msg;
    protected $url;
    protected $order_type;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notification_msg,$url,$order_type)
    {
        //
        $this->notification_msg = $notification_msg;
        $this->url = $url;
        $this->order_type = $order_type;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [MailChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        try {
            return (new MailMessage)
                // ->view('email.custom_email_view') // Set the view for the email (replace with your actual view name)
                ->line('You have a new message: ' . $this->notification_msg->message )
                ->line('for the order: ' . $this->order_type)
                ->action('Visit your space for more action', url($this->url))
                ->line('The team verifme thanks you for trusting us and using our market place!');
        } catch (\Exception $e) {
            // Log or report the exception to help with debugging
            \Log::error('Email Notification Error: ' . $e->getMessage());
            return null; // Return null or handle the error gracefully
        }
    }
    

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
