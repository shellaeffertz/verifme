<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\NotificationService;
use App\Http\Requests\Seller\CompleteOrderRequest;

class OrdersController extends Controller
{
    public function getBuyerOrders(Request $request)
    {
        $user = auth()->user();
        $orders = Order::where('buyer_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('buyer.orders.index', [
            'orders' => $orders
        ]);
    }

    public function showBuyerOrder(Request $request, $uuid)
    {
        $user = auth()->user();
        $order = Order::where('buyer_id', $user->id)->where('uuid', $uuid)->first();

        if (!$order) return redirect('/orders')->with('error', 'Order not found');

        $order->public = json_decode($order->public_data);
        $order->private = json_decode($order->private_data);
        
        $seller = $order->seller;
        return view('buyer.orders.show', [
            'order' => $order
        ]);
    }

    public function getSellerOrders(Request $request)
    {
        $user = auth()->user();
        $orders = Order::where('seller_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        foreach ($orders as $order) {
            // Update the order type here based on your logic
        if($order->type == "bank_accounts")
            $order->type = 'Banck Accounts';
        elseif($order->type == "cracked_account")
            $order->type = 'Cracked Accounts';
        elseif($order->type == "payement_processors")
            $order->type = 'Payements process';       
        elseif($order->type == "crypto_exchanges")
            $order->type = 'Crypto and Exchanges';
        elseif($order->type == "real_fakedocs")
            $order->type = 'Real and fake documents';
        }
        return view('seller.orders.index', [
            'orders' => $orders
        ]);
    }

    public function showSellerOrder(Request $request, $uuid)
    {
        $user = auth()->user();
        $order = Order::where('seller_id', $user->id)->where('uuid', $uuid)->first();
        if (!$order) return redirect('/seller/orders')->withErrors('Order not found');
        $order->public = json_decode($order->public_data);
        $order->private = json_decode($order->private_data);
        return view('seller.orders.show', [
            'order' => $order
        ]);
    }

    public function completeOrder(CompleteOrderRequest $request, $uuid)
    {
        $user = $request->user(); // The buyer

        // retrieve Order from DB
        $order = Order::where('uuid', $uuid)->where('status', '!=', 'completed')->first();
        if (!$order) return redirect()->back()->withErrors('Order not found or already completed');

        $transaction = Transaction::where('source', $order->id)->where('type', 'product')->where('status', 'pending')->first();
        if (!$transaction) return redirect()->back()->withErrors('Transaction not found');
        $transaction->status = 'completed';
        $transaction->save();

        $data = $request->validated();
        $order->private_data = json_encode($data);
        $order->status = 'completed';
        $order->save();

        // pay the seller
        $order->seller->balance += $order->price - $order->price*$order->seller->commission;
        $order->seller->save();

        // get affiliate transations and complete them
        $affiliateTransactions = Transaction::where('source', $order->id)->where('type', 'affiliate')->where('status', 'pending')->get();
        foreach ($affiliateTransactions as $affiliateTransaction) {
            $affiliateTransaction->status = 'completed';
            $affiliateTransaction->save();

            $receiver = User::where('id', $affiliateTransaction->recipient_id)->first();
            if(!$receiver) continue;
            
            $receiver->affiliate_balance = $receiver->affiliate_balance + $affiliateTransaction->amount_received;
            $receiver->save();
        }


        // $buyer = $order->buyer;
        // NotificationService::addNotification($buyer, 'order_completed', 'Order Completed', 'Your order was completed', '/orders/' . $order->uuid);

        return redirect()->back()->with('success', 'Order updated');
    }

    
}
