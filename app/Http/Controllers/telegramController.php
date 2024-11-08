<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TelegramRegister;
use App\Notifications\registerWithTeleg;
use Laravel\Socialite\Facades\Socialite;

class telegramController extends Controller
{
    public function message(Request $request)
    {
        auth()->user()->notify(new telegramNotif($request->get('message')));
        return redirect('/dashboard');
    }

    public function callback(Request $request)
    {
        
        $telegramUser = Socialite::driver('telegram')->user();

        $user = User::where('id', auth()->user()->id)->first();

        if ($user) {

            $user->update([
                'telegram_chat_id' => $telegramUser->getId(), // Replace with your column name and new value
            ]);

            Auth::login($user);

            auth()->user()->notify(new registerWithTeleg("you have been registered successfuly to our notification chanel verifme team thanks you for trusting our market place"));
        
            return redirect('/');
        } else {

            return redirect('/')->with('error', 'User not found');
        }

    }
}
