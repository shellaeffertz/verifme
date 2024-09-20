<?php

namespace App\Http\Controllers\Products;

use App\Models\User;
use Ramsey\Uuid\Uuid;
use App\Models\Notice;
use App\Models\Product;

use Illuminate\Http\Request;
use App\Services\ProductsServices;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Config;
use App\Notifications\TelegramRegister;
use App\Notifications\userNotification;
use App\Notifications\OrderNotification;
use Illuminate\Notifications\Notifiable;
use App\Http\Requests\Products\CreateProductRequest;

class ProductsController extends Controller
{

    public function buy(Request $request)
    {
        $user = $request->user();
        if (!$request->has('product_id')) return redirect()->back()->with('error', 'No product selected');

        $product_id = intval($request->product_id);
        if ($product_id <= 0) return redirect()->back()->withErrors(['Invalid product selected 1']);

        $product = Product::where('id', $product_id)->where('status', 'active')->first();
        if (!$product) return redirect()->back()->withErrors(['Invalid product selected 2']);

        $balance = $user->balance;
        if ($balance < $product->price)  return redirect()->back()->withErrors(['Insufficient balance']);


        $order = ProductsServices::handleBuyProduct($product, $user);

        //mailer for order 


        $user = User::where('id',$product->seller->id)->first();

        if($user->telegram_chat_id!=NULL){

        $noticeContent ='Hello'."\t".$user->nickname."\n" .'You have a new order'."\n"."Type:".$product->type."\n"."Title:".$product->title."\n"."Price :".$order->price."\n".'please visite our market place for more detail about the order';

        // dd($order);
        $notice = new Notice([
            'id'  =>  Uuid::uuid4()->toString(),
            'notice' => $noticeContent,
            'noticedes' => $user->telegram_chat_id,
            'noticelink' => "https://verifme.com/orders/".$order->uuid,
       ]);
    
           $notice->notify(new userNotification());

           Log::info('Telegram notif sent');
    }else{
        $user->notify(new OrderNotification($order));
        Log::info('Email notif sent');
    }
    // NotificationService::addNotification( $order->seller , 'message_received', 'You have a new order', 'You have a new order', '/seller/orders/' . $order->uuid);

        return redirect('/orders/' . $order->uuid)->with('success', 'Order created successfully');
    }

    public function index(Request $request) 
    {
        $user = $request->user();
        $products = Product::where('seller_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
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
        }
        return view('seller.products', [

            'products' => $products
        ]);
    }

    public function create(Request $request)
    {
        $products = config('products');

        // dd($products);
    
        $request->validate([
            'type' => 'required|string|in:' . implode(',', array_keys($products)),
        ]);

        $type = $request->type;
        
        return view('seller.create', [
            'type' => $type,
        ]);
    }

    public function store(CreateProductRequest $request)
    {
        $user = $request->user();
        $data = $request->only(['type', 'delivery_type', 'title', 'delivery_period', 'price', 'public_data', 'private_data']);
        $data['seller_id'] = $user->id;
        $data['status'] = 'active';
        // $data['price'] = $data['price'] + ($data['price']*0.2);
        // $data['commission'] = $data['price']*0.2;
        // $data['priceTotal'] = $data['price'] + $data['commission'];
        $data['priceTotal'] = $data['price'];

        Product::forceCreate($data);

        if($data['type'] == 'real_fakedocs' || $data['type'] == 'cracked_account' || $data['type'] == 'payement_processors')
            $noticeContent = 'New product added visite the market place'."\n".$data['type']."\n".$data['title']."\n".$data['price'];
        else{
            $jsonString = $data['public_data'];
            $dataArray = json_decode($jsonString, true); // true to get an associative array
            $accountType = $dataArray['account_type'];
            $noticeContent = 'New product added visite the market place'."\n"."Type:".$data['type']."\n"."Title:".$data['title']."\n"."Price :".$data['priceTotal']."\n"."account type :".$accountType;
        }
            
        // $notice = new Notice([
        //      'id'  =>  Uuid::uuid4()->toString(),
        //      'notice' => $noticeContent,
        //      'noticedes' => $data['type'],
        //      'noticelink' => "https://verifme.com/products/".$data['type'],
        //     //  'telegramid' => Config::get('services.telegram-id')
        // ]);

        // $notice->save();
        // $notice->notify(new TelegramRegister());

        
        return redirect('/seller/products')->with('success', 'Product created successfully');
    }

    public function edit(Request $request, $id)
    {
        $user = $request->user();
        $product = Product::where('id', $id)->where('seller_id', $user->id)->first();
        if (!$product) return redirect()->back()->with('error', 'Invalid product selected');

        $private_data = json_decode($product->private_data);
        $public_data = json_decode($product->public_data);

        $product->private = $private_data;
        $product->public = $public_data;

        return view('seller.edit', [
            'product' => $product,
        ]);
    }

    public function update(CreateProductRequest $request, $id)
    {
        $user = $request->user();
        $product = Product::where('id', $id)->where('seller_id', $user->id)->first();
        if (!$product) return redirect()->back()->with('error', 'Invalid product selected');
        $data = $request->only(['type', 'delivery_type', 'title', 'delivery_period', 'price', 'public_data', 'private_data']);
        // have to verify if price was modified

        if($product->price != $data['price']) 
        {
            $data['commission'] = $data['price']*0.2;
            $data['priceTotal'] = $data['price'] + $data['price']*0.2;
        }
        
        $product->update($data);
        return redirect('/seller/products')->with('success', 'Product updated successfully');
    }

    public function delete(Request $request, $id)
    {
        $user = $request->user();
        $product = Product::where('id', $id)->where('seller_id', $user->id)->first();
        if (!$product) return redirect()->back()->with('error', 'Invalid product selected');
        $product->delete();
        return redirect('/seller/products')->with('success', 'Product deleted successfully');
    }



    public function accounts(Request $request)
    {
        $type = 'bank_accounts';
        // return view('products.index', [
        //     'type' => $type,
        //     'query' => $request->input('query'),
        // ]);
        return view('products.index', [
            'type' => $type
        ]);
    }

    public function rdps(Request $request)
    { 
        $type = 'cracked_account';
        return view('products.index', [
            'type' => $type,
        ]);
    }

    public function hostings(Request $request)
    {
        $type = 'payement_processors';
        
        return view('products.index', [
            'type' => $type,
            // 'query' => $request->input('query'),
        ]);
    }

    public function smtps(Request $request)
    {
        $type = 'real_fackedocs';
        return view('products.index', [
            'type' => $type,
        ]);
    }

    public function leads(Request $request)
    {
        $type = 'crypto_exchanges';
        return view('products.index', [
            'type' => $type,
            // 'query' => $request->input('query'),
        ]);
    }

}
