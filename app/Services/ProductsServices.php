<?php

namespace App\Services;

use App\Models\User;
use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Support\Str;

class ProductsServices
{
    public static function handleBuyProduct($product, $user)
    {
        if ($product->delivery_type == 'instant') {
            return self::handleBuyProductInstant($product, $user);
        } else {
            return self::handleBuyProductService($product, $user);
        }
    }

    public static function handleBuyProductInstant($product, $user)
    {
        $product->status = 'sold';
        $product->save();

        $seller = $product->seller;
        $seller->balance = $seller->balance + ($product->priceTotal - $product->priceTotal*$seller->commission);
        $seller->save();

        $user->balance = $user->balance - $product->priceTotal;
        $user->save();

        logger(json_encode($product->public_data));

        $order = Order::forceCreate([
            'product_id' => $product->id, 
            'buyer_id' => $user->id,
            'title' => $product->title,
            'seller_id' => $product->seller_id,
            'status' => 'completed',
            'uuid' => Str::uuid(),
            'type' => $product->type,
            'delivery_type' => $product->delivery_type,
            'public_data' => json_encode($product->public_data),
            'private_data' => json_encode($product->private_data ?? '{}'),
            'price' => $product->price,
        ]);

        $price = $product->price;
        $fee = $price * $seller->commission;

        // check if seller has a referrer
        if ($seller->referrer && User::where('id', $seller->referrer)->exists()) {
            $affiliate = User::where('id', $seller->referrer)->first();
            $affiliate->affiliate_balance = $affiliate->affiliate_balance + $price * $affiliate->affiliate_commission;
            $affiliate->save();

            Transaction::forceCreate([
                'sender_id' => $seller->id,
                'recipient_id' => $affiliate->id,
                'type' => 'affiliate',
                'status' => 'completed',
                'uuid' => Str::uuid(),
                'amount_sent' => $price,
                'amount_received' => $price * $affiliate->affiliate_commission,
                'fee' => 0,
                'source' => $order->id,
            ]);

            $fee = $fee - $price * $affiliate->affiliate_commission;
        }

        if ($user->referrer && User::where('id', $user->referrer)->exists()) {
            $affiliate = User::where('id', $user->referrer)->first();
            $affiliate->affiliate_balance = $affiliate->affiliate_balance + $price * $affiliate->affiliate_commission;
            $affiliate->save();

            Transaction::forceCreate([
                'sender_id' => $user->id,
                'recipient_id' => $affiliate->id,
                'type' => 'affiliate',
                'status' => 'completed',
                'uuid' => Str::uuid(),
                'amount_sent' => $price,
                'amount_received' => $price * $affiliate->affiliate_commission,
                'fee' => 0,
                'source' => $order->id,
            ]);

            $fee = $fee - $price * $affiliate->affiliate_commission;
        }

        Transaction::forceCreate([
            'sender_id' => $user->id,
            'recipient_id' => $seller->id,
            'type' => 'product',
            'status' => 'completed',
            'uuid' => Str::uuid(),
            'amount_sent' => $product->price,
            'amount_received' => $product->price *  (1 - $seller->commission),
            'fee' => $price * $seller->commission,
            'source' => $order->id,
        ]);

        Transaction::forceCreate([
            'sender_id' => $user->id,
            'recipient_id' => null,
            'type' => 'fees',
            'status' => 'completed',
            'uuid' => Str::uuid(),
            'amount_sent' => $price * $seller->commission,
            'amount_received' => $fee,
            'fee' => 0,
            'source' => $order->id,
        ]);


        // NotificationService::addNotification($user, 'product_buy', 'You have successfully bought a product', 'success', '/orders/' . $order->uuid);
        // NotificationService::addNotification($seller, 'product_sold', 'You have successfully sold a product', 'success', '/seller/orders/' . $order->uuid);

        return $order;
    }

    public static function handleBuyProductService($product, $user)
    {
        $product->status = 'sold';
        $product->save();

        $user->balance = $user->balance - $product->price;
        $user->save();

        $seller = $product->seller;

        $order = Order::forceCreate([
            'product_id' => $product->id,
            'buyer_id' => $user->id,
            'seller_id' => $product->seller_id,
            'status' => 'pending', // not completed yet
            'uuid' => Str::uuid(),
            'title' => $product->title,
            'type' => $product->type,
            'delivery_type' => $product->delivery_type,
            'delivery_period' => $product->delivery_period,
            'public_data' => json_encode($product->public_data),
            'private_data' => json_encode($product->private_data),
            'price' => $product->price,
        ]);

        $price = $product->price;
        $fee = $price * $seller->commission; // The amount of money our app gain

        // check if seller has a referrer
        if ($seller->referrer && User::where('id', $seller->referrer)->exists()) {
            $affiliate = User::where('id', $seller->referrer)->first(); // the user who invited the seller in the first place
            $affiliate->affiliate_balance = $affiliate->affiliate_balance + $price * $affiliate->affiliate_commission;
            $affiliate->save();

            Transaction::forceCreate([
                'sender_id' => $seller->id,
                'recipient_id' => $affiliate->id,
                'type' => 'affiliate',
                'status' => 'pending',
                'uuid' => Str::uuid(),
                'amount_sent' => $price,
                'amount_received' => $price * $affiliate->affiliate_commission,
                'fee' => 0,
                'source' => $order->id,
            ]);

            $fee = $fee - $price * $affiliate->affiliate_commission;
        }

        if ($user->referrer && User::where('id', $user->referrer)->exists()) {
            $affiliate = User::where('id', $user->referrer)->first();
            $affiliate->balance = $affiliate->balance + $price * $affiliate->affiliate_commission;
            $affiliate->save();

            Transaction::forceCreate([
                'sender_id' => $user->id,
                'recipient_id' => $affiliate->id,
                'type' => 'affiliate',
                'status' => 'pending',
                'uuid' => Str::uuid(),
                'amount_sent' => $price,
                'amount_received' => $price * $affiliate->affiliate_commission,
                'fee' => 0,
                'source' => $order->id,
            ]);

            $fee = $fee - $price * $affiliate->affiliate_commission;
        }

        Transaction::forceCreate([
            'sender_id' => $user->id,
            'recipient_id' => $seller->id,
            'type' => 'product',
            'status' => 'pending',
            'uuid' => Str::uuid(),
            'amount_sent' => $product->price,
            'amount_received' => $product->price *  (1 - $seller->commission),
            'fee' => $product->price * $seller->commission,
            'source' => $order->id,
        ]);

        Transaction::forceCreate([
            'sender_id' => $user->id,
            'recipient_id' => null,
            'type' => 'fees',
            'status' => 'pending',
            'uuid' => Str::uuid(),
            'amount_sent' => $price * $seller->commission,
            'amount_received' => $fee,
            'fee' => 0,
            'source' => $order->id,
        ]);

        NotificationService::addNotification($user, 'product_place_order', 'You have successfully placed an order', 'success', '/orders/' . $order->uuid);
        NotificationService::addNotification($seller, 'product_place_order', 'You have a new pending Order', 'success', '/seller/orders/' . $order->uuid);

        return $order;
    }
}
