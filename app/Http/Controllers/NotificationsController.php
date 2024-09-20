<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\NotificationService;

class NotificationsController extends Controller
{
    public function handleNotification(Request $request, $id)
    {
        $user = $request->user();
        $notification = Notification::where('id', $id)->where('user_id', $user->id)->first();

        if(!$notification) return redirect()->back()->with('error', 'Notification not found');

        if(!$notification->seen) {
            $notification->seen = true;
            $notification->seen_at = now();
            $notification->save();
        }
        
        return redirect($notification->link);
    }

    public function indexNotifications(Request $request)
    {
        $user = $request->user();
        $notifications = Notification::where('user_id', $user->id)->orderBy('updated_at', 'desc')->paginate(10);
        return view('notifications.index', compact('notifications'));
    }

    public function indexAdminNotifications(Request $request)
    {
        $user = $request->user();
        $notifications = Notification::whereNull('user_id')->orderBy('updated_at', 'desc')->paginate(10);
        return view('notifications.admin', compact('notifications'));
    }

    public function handleAdminNotification(Request $request, $id)
    {
        $notification = Notification::where('id', $id)->whereNull('user_id')->first();

        if(!$notification) return redirect()->back()->with('error', 'Notification not valid');

        if(!$notification->seen) {
            $notification->seen = 1;
            $notification->seen_at = now();
            $notification->save();
        }
        
        return redirect($notification->link);
    }
}



// NotificationService::addNotification($user, 'new_post', 'New Product was created', 'A new product was created', '/seller/products/[]');