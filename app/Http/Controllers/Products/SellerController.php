<?php

namespace App\Http\Controllers\Products;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateProductRequest;

class SellerController extends Controller
{
    public function store(CreateProductRequest $request){
        $user = $request->user();
        $data = $request->only(['type', 'delivery_type', 'title', 'delivery_period', 'price', 'public_data', 'private_data']);
        $data['seller_id'] = $user->id;
        $data['status'] = 'active';
        Product::forceCreate($data);
        return redirect('/seller/products')->with('success', 'Product created successfully');    
    }

    public function dashboard(Request $request){
        $user = $request->user();
        return view('seller.dashboard', [
            'user' => $user
        ]);
    }


    public function tos(Request $request){
        $user = $request->user();
        return view('seller.tos', [
            'user' => $user
        ]);
    }
}
