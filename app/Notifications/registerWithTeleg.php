<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class registerWithTeleg extends Notification
{
    // use Queueable;

    // private $message;

    // /**
    //  * Create a new notification instance.
    //  *
    //  * @return void
    //  */

    // public function __construct($message)
    // {
    //     //
    //     $this->message = $message;
    // }

    // /**
    //  * Get the notification's delivery channels.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return array
    //  */
    // public function via($notifiable)
    // {
    //     return [TelegramChannel::class];
    // }

    // /**
    //  * Get the mail representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return \Illuminate\Notifications\Messages\MailMessage
    //  */
    // // public function toMail($notifiable)
    // // {
    // //     return (new MailMessage)
    // //                 ->line('The introduction to the notification.')
    // //                 ->action('Notification Action', url('/'))
    // //                 ->line('Thank you for using our application!');
    // // }

    // /**
    //  * Get the array representation of the notification.
    //  *
    //  * @param  mixed  $notifiable
    //  * @return array
    //  */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }


    // public function toTelegram($notifiable)
    // {
    //     return TelegramMessage::create()
    //         ->to($notifiable->telegram_id)
    //         ->content($this->message);
        
    // }

    use Queueable;

    /**
     * Create a new notification instance.
     */
    private $message;

    public function __construct(string $message)
    {
        //
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return [TelegramChannel::class];
    }

    // /**
    //  * Get the mail representation of the notification.
    //  */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
    public function toTelegram($notifiable)
    {
        // dd($notifiable);
        return TelegramMessage::create()
            ->to($notifiable->telegram_chat_id)
            ->content($this->message);
        
    }

}
