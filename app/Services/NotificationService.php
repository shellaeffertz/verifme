<?php

namespace App\Services;

use App\Models\Notification;

class NotificationService
{
    public static function addNotification($user, $type, $title, $content, $link)
    {
        if ($user) {
            $notification = Notification::where('user_id', $user->id)
                ->where('type', $type)
                ->where('title', $title)
                ->where('content', $content)
                ->where('link', $link)
                ->first();

            if ($notification) {
                $notification->seen = false;
                $notification->seen_at = null;
                $notification->save();
                return;
            }

            $notification = new Notification();
            $notification->user_id = $user->id;
            $notification->type = $type;
            $notification->title = $title;
            $notification->content = $content;
            $notification->link = $link;
            $notification->save();

            return;
        }

        $notification = Notification::whereNull('user_id')
            ->where('type', $type)
            ->where('title', $title)
            ->where('content', $content)
            ->where('link', $link)
            ->first();

        if ($notification) {
            $notification->seen = false;
            $notification->seen_at = null;
            $notification->save();
            return;
        }

        $notification = new Notification();
        $notification->type = $type;
        $notification->title = $title;
        $notification->content = $content;
        $notification->link = $link;
        $notification->save();

        return;
    }
}
