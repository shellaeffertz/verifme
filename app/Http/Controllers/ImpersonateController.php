<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ImpersonateController extends Controller
{
    public function leave(Request $request)
    {
        $impersonate = $request->session()->get('impersonate');
        $admin = User::where('id', $impersonate)->first();
        if ($admin) Auth::login($admin);
        $request->session()->forget('impersonate');
        return redirect('/');
    }

    public function start(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if ($user) {
            $request->session()->put('impersonate', Auth::user()->id);
            Auth::login($user);
        }
        return redirect('/');
    }
}
