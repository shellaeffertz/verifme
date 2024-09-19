<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use NotificationChannels\Telegram\Telegram;
use Illuminate\Notifications\Messages\MailMessage;
use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramMessage;

class userNotification extends Notification
{
    use Queueable;

    // private $Content;
    // private $orderuuid;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    // public function __construct($noticeContent,$orderuuid)
    // {
    //     //
    //     $this->Content = $noticeContent;
    //     $this->orderlink = "http://hama9a-2.test/orders/".$orderuuid;
    // }

    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

        /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
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

    public function toTelegram($notifiable)
    {
        // dd($notifiable);
        return TelegramMessage::create()
         ->to($notifiable->noticedes)
         ->content('*'.$notifiable->notice."*\n")
         ->button('view details',$notifiable->noticelink);
    }

}
