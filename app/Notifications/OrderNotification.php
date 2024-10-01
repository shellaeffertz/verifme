<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderNotification extends Notification
{
    use Queueable;
    protected $notification_order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($order)
    {
        //
        $this->notification_order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                ->line('You have a new order: '."$". $this->notification_order->price )
                ->line('for the order: ' . $this->notification_order->type)
                ->action('Visit your space for more action', url("http://localhost:8000/orders/".$this->notification_order->uuid))
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
