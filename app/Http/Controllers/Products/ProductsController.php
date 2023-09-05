<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductsServices;
use App\Http\Controllers\Controller;
use App\Services\NotificationService;
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

        return redirect('/orders/' . $order->uuid)->with('success', 'Order created successfully');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $products = Product::where('seller_id', $user->id)->orderBy('created_at', 'desc')->paginate(10);
        // Loop through each product and update the product type
        foreach ($products as $product) {
            // Update the product type here based on your logic
        if($product->type == "accounts")
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
        Product::forceCreate($data);
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
        $type = 'accounts';
        return view('products.index', [
            'type' => $type,
            'query' => $request->input('query'),
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
