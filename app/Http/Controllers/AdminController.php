<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        // dd($order->type);
        return view('admin.orders.show', [
            'order' => $order
        ]);
    }
}
