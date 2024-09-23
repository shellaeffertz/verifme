<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function orders(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.orders.index', [
            'orders' => $orders,
            
        ]);
    }

    public function showOrder(Request $request, $id)
    {
        $order = Order::where('uuid', $id)->first();
            // Update the order type here based on your logic
        if (!$order) return redirect('/admin/orders')->withErrors('Order not found');
        $order->public = json_decode($order->public_data);
        $order->private = json_decode($order->private_data);
        // dd($order);
        return view('admin.orders.show', [
            'order' => $order
        ]);
    }


    public function refundOrder(Request $request)
    {
        $attributes = $request->validate([
            'order_uuid' => ['required']
        ]);

        $order = Order::where('uuid', $attributes['order_uuid'])->first();
        logger($order);
        if (!$order) return redirect('/admin/orders')->withErrors('Order not found');
    
        if(!$order->refunded){

            $seller = User::where('id', $order->seller_id)->first();
            $buyer = User::where('id', $order->buyer_id)->first();
            $amount = 0;

            if($order->status == 'completed') {
               // get 80% of the order price from the seller
                $seller->balance = $seller->balance - $order->price*(1 - $seller->commission);
                $amount = $amount + $order->price*(1 - $seller->commission);
                $seller->save();
                // get the 5% of the order price from the seller refferer if he has one
                if ($seller->referrer && User::where('id', $seller->referrer)->exists()) {
                    $affiliate = User::where('id', $seller->referrer)->first();
                    $affiliate->affiliate_balance = $affiliate->affiliate_balance - $order->price * $affiliate->affiliate_commission;
                    $amount = $amount + $order->price * $affiliate->affiliate_commission;
                    $affiliate->save();
                }
                // get the 5% of the order price from the buyer refferer if he has one
                if ($buyer->referrer && User::where('id', $buyer->referrer)->exists()) {
                    $affiliate = User::where('id', $buyer->referrer)->first();
                    $affiliate->affiliate_balance = $affiliate->affiliate_balance - $order->price * $affiliate->affiliate_commission;
                    $amount = $amount + $order->price * $affiliate->affiliate_commission;
                    $affiliate->save();
                }
                // get the application fees amount from this order it could be 20% or 15% or 10%
                $app_fees = Transaction::where('source', $order->id)->where('type', 'fees')->first();
                $amount = $amount + $app_fees->amount_received;
                $buyer->balance = $buyer->balance + $amount;
                $buyer->save();
                Transaction::forceCreate([
                    'sender_id' => null,
                    'recipient_id' => $buyer->id,
                    'type' => 'refund',
                    'status' => 'completed',
                    'uuid' => Str::uuid(),
                    'amount_sent' => $order->price,
                    'amount_received' => $order->price,
                    'fee' => 0,
                    'source' => $order->id,
                ]);
           } else {
                $amount = $order->price;
                $buyer->balance = $buyer->balance + $amount;
                $buyer->save();
           }

            $order->refunded = true;
            $order->save();

           return redirect('/admin/order/' . $order->uuid)->with('success', 'Order refunded successfully');

        } else {

            return redirect('/admin/orders')->withErrors('Order already refunded');
        }
    }

    public function products(Request $request)
    {
        // $user = $request->user();
        $products = Product::paginate(10);

        // Loop through each product and update the product type
        foreach ($products as $product) {
            // Update the product type here based on your logic
        if($product->type == "bank_accounts")
            $product->type = 'Banck Accounts';
        elseif($product->type == "cracked_account")
            $product->type = 'Cracked Accounts';
        elseif($product->type == "payement_processors")
            $product->type = 'Payements process';       
        elseif($product->type == "crypto_exchanges")
            $product->type = 'Crypto and Exchanges';
        elseif($product->type == "real_fakedocs")
            $product->type = 'Real and fake documents';

            $product->public = json_decode($product->public_data);
        }
        return view('admin.product', [

            'products' => $products
        ]);
    }

    public function showProduct($product_id) {

        $product = Product::where('id', $product_id)->first();
        if(!$product) return redirect()->back()->withErrors('Product not found');

        $product['public_data'] = json_decode($product['public_data']);
        $product['private_data'] = json_decode($product['private_data']);

        return view('admin.listing', [
            'product' => $product
        ]);
    }


    public function delete(Request $request)
    {
        $attributes = $request->validate([
            'product_id' => ['required']
        ]);

        $product = Product::where('id', $attributes['product_id'])->first();
        if (!$product) return redirect('/admin/products')->withErrors('product not found');
        $product->delete();
        return redirect('/admin/products')->with('success', 'Product deleted successfully');
    }
}
