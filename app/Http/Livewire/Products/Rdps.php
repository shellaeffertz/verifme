<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Rdps extends Component
{
    public $search = '';
    public $country = '';
    public $max_price = 5000;
    public $min_price = 0;

    public function render()
    {
        $products = Product::where('type', 'cracked_account');

        if($this->search != '') {
            $products->where('title', 'like', '%' . $this->search . '%');
        }



        if($this->country != '' && $this->country != 'all') {
            $products->where('public_data', 'like', '%"country":"' . $this->country . '"%');
            Log::info($this->country);
        }


        $max_price = intval($this->max_price);
        $min_price = intval($this->min_price);
        
        if($max_price != 0) {
            $products->where('price', '<=', $max_price);
        }

        if($min_price != 0) {
            $products->where('price', '>=', $min_price);
        }

        $products = $products->where('status', 'active');

        $products = $products->orderBy('created_at', 'desc')->paginate(10);

        foreach ($products as $product) {
            $product->public_data = json_decode($product->public_data);
        }

        return view(
            'livewire.products.rdps',
            [
                'products' => $products
            ]
        );
    }
}
