<?php

namespace App\Services;

use App\Models\User;
use App\Models\Record;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use App\Mail\User\ResetPasswordMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserServices
{
    public static function register($data)
    {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['is_seller'] = false;
        $data['channel_id'] = Str::random(64);
        $totalUser = User::all()->count() + 1;
        $data['nickname'] = "User#".$totalUser;
        $data['commission'] = 0.2;
        $user = User::create($data);
        return $user;
    }

    public static function login($data)
    {
        $user  = User::where('email', $data['username'])->orWhere('username', $data['username'])->first();
        if (!$user || !password_verify($data['password'], $user->password)) return false;
        return $user;
    }

    public static function forgetPassword($data)
    {
        $user  = User::where('email', $data['username'])->orWhere('username', $data['username'])->first();
        if (!$user) return null;

        $token = base64_encode(Str::random(64));
        Record::create([
            'user_id' => $user->id,
            'type' => 'password_reset',
            'data' => $token
        ]);

        Mail::to($user->email)->send(new ResetPasswordMail($user, $token));
        return true;
    }

    public static function validateResetPasswordToken($token)
    {
        $record = Record::where('type', 'password_reset')->where('data', $token)->where('created_at', '>', date('Y-m-d H:i:s', time() - 30 * 60))->first();
        if (!$record) return null;
        return $record;
    }

    public static function resetPassword($password, $user_id)
    {
        $user = User::find($user_id);
        if (!$user) return null;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();
        return true;
    }

    public static function update($user_id, $data)
    {
        $user = User::find($user_id);
        if (!$user) return null;

        if (isset($data['current_password'])) {
            if (!password_verify($data['current_password'], $user->password)) throw new HttpResponseException(response()->json(['message' => 'Invalid current password', 'errors' => ['current_password' => ['Invalid current password']]], 422));
            unset($data['current_password']);
        }

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
            unset($data['password_confirmation']);
        }

        $user->update($data);
        return $user;
    }

    public static function getProfile($user_id)
    {
        $user = User::find($user_id);
        if (!$user) return null;
        return [
            'username' => $user->username,
            'nickname' => $user->nickname,
            'email' => $user->email,
            'balance' => $user->balance,
            'channel_id' => $user->channel_id,
            'updated_at' => $user->updated_at,
        ];
    }
}
