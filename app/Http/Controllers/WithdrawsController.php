<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;

class WithdrawsController extends Controller
{
    public function withdraw(Request $request)
    {
        $user = auth()->user();
        $withdraws = Withdraw::where('user_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('withdraws', [
            'user' => $user,
            'withdraws' => $withdraws
        ]);
    }

    public function withdraws(Request $request)
    {
        $withdraws = Withdraw::where('status', 'pending')->join('users', 'users.id', '=', 'withdraws.user_id')->select('withdraws.*', 'users.nickname', 'users.username', 'users.email', 'users.balance')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.withdraws', [
            'withdraws' => $withdraws
        ]);
    }

    public function requestWithdraw(Request $request)
    {
        $user = request()->user();

        $data = $request->validate([
            'amount' => 'required|numeric|min:5',
            'coin' => 'required|in:BTC,ETH,LTC,XMR,USDT',
            'address' => 'required|string|min:10'
        ]);
    
        $balance = $user->balance;
        if ($data['amount'] > $balance) {
            return redirect('/withdraw')->withErrors(['amount' => 'Insufficient balance']);
        }
    
        $data['user_id'] = $user->id;
        $data['status'] = 'pending';
        $data['uuid'] = uniqid();
        Withdraw::forceCreate($data);
    
        $user->balance = $balance - $data['amount'];
        $user->save();
    
        return redirect('/withdraw')->with('success', 'Withdraw request sent successfully');
    }

    public function processWithdraw(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,rejected,approved',
            'reason' => 'required_if:status,rejected'
        ]);

        $withdraw = Withdraw::where('uuid', $id)->where('status', 'pending')->first();
        if (!$withdraw) return redirect('/admin/withdraws')->with('error', 'Invalid withdraw selected');

        $withdraw->status = $request->status;
        $withdraw->reject_reason = $request->reason;
        $withdraw->save();

        if ($withdraw->status == 'rejected') {
            $user = User::find($withdraw->user_id);
            if (!$user) return redirect('/admin/withdraws')->with('error', 'Invalid withdraw selected');

            if($withdraw->type == 'affiliate'){
                $user->affiliate_balance = $user->affiliate_balance + $withdraw->amount;
            }else{
                $user->balance = $user->balance + $withdraw->amount;
            }

            $user->save();
        }

        return redirect('/admin/withdraws')->with('success', 'Withdraw updated successfully!');
    }
}
