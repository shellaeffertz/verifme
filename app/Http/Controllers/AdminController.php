<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function orders(Request $request)
    {
        $orders = Order::orderBy('created_at', 'desc')->paginate(8);
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


    public function refundOrder(Request $request, $id)
    {
        $order = Order::where('uuid', $id)->first();
        // dd($order->uuid);
        if (!$order) return redirect('/admin/orders')->withErrors('Order not found');
        if(!$order->refunded){
            $user = User::where('id',$order->buyer_id)->first();
            $user->balance = $user->balance + $order->price*0.8;
            // $user->balance = $user->balance - $order->price*0.2;
            $user->save();
            
            $userSeller = User::where('id',$order->seller_id)->first();
            $userSeller->balance =  $userSeller->balance - $order->price*0.8;
            $userSeller->save();

            $order->status = 'refunded';
            $order->refunded = true;
            $order->save();
           return redirect('/admin/orders')->with('success', 'Order refunded successfully');
        }else return redirect('/admin/orders')->withErrors('Order already refunded');
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


    public function delete(Request $request, $id)
    {
        // $user = $request->user();
        $product = Product::where('id', $id);
        // dd($id);
        if (!$product) return redirect()->back()->with('error', 'Invalid product selected');
        $product->delete();
        return redirect('/admin/products')->with('success', 'Product deleted successfully');
    }
}
