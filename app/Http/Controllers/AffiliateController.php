<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Request as ModelRequest;

class AffiliateController extends Controller
{
    public function createAffiliateRequest(Request $request) {

        $user = $request->user();

        if($user->is_affiliate){
            $referrals = User::where('referrer', $user->id)->count();
            return view('affiliate.home', compact('user', 'referrals'));
        }

        $affiliate_request = ModelRequest::where('user_id', $user->id)->where('type', 'affiliate')->where('status', 'pending')->first();
        return view('affiliate.register', compact('affiliate_request'));
    }

    public function storeAffiliateRequest(Request $request) {

        $user = $request->user();
        if($user->is_affiliate) return redirect()->route('affiliate.home');

        $affiliate_request = ModelRequest::where('user_id', $user->id)->where('type', 'affiliate')->where('status', 'pending')->first();
        if($affiliate_request) return redirect()->route('affiliate.request')->withErrors(['You already have a pending request.']);

        $request->validate([
            'code' => 'nullable|string|max:255|unique:users,affiliate_code',
        ]);

        $affiliate_request = new ModelRequest();
        $affiliate_request->user_id = $user->id;
        $affiliate_request->type = 'affiliate';
        $affiliate_request->status = 'pending';
        $affiliate_request->data = $request->code ? $request->code : Str::random(8);
        $affiliate_request->save();

        return redirect()->route('affiliate.request');

    }

    public function createWithdrawRequest(Request $request) {

        $user = $request->user();
        $withdraws = Withdraw::where('user_id', $request->user()->id)->where('type', 'affiliate')->paginate(5);
        return view('affiliate.withdraw', compact('user', 'withdraws'));
    }

    public function storeWithdrawRequest(Request $request) {

        $user = request()->user();

        $data = $request->validate([
            'amount' => 'required|numeric|min:5',
            'coin' => 'required|in:BTC,ETH,LTC',
            'address' => 'required|string|min:10'
        ]);

        $balance = $user->affiliate_balance;

        if ($data['amount'] > $balance) {
            return redirect('/affiliate/withdraw')->withErrors(['amount' => 'Insufficient balance']);
        }

        $data['user_id'] = $user->id;
        $data['status'] = 'pending';
        $data['uuid'] = uniqid();
        $data['type'] = 'affiliate';

        Withdraw::forceCreate($data);

        $user->affiliate_balance = $balance - $data['amount'];
        $user->save();

        return redirect('/affiliate/withdraw')->with('success', 'Withdraw request sent successfully');
    }
}
