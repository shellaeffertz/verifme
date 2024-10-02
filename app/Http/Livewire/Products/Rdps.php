<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Rdps extends Component
{
    public $search = '';
    public $country = '';

    public function render()
    {
        return view(
            'livewire.products.rdps',
            [
                'products' => Product::where('type', 'cracked_account')
                                        ->where('status', 'active')
                                        ->when($this->search, function($query, $search) {
                                            $query->where('title', 'like', '%' . $search . '%');
                                        })
                                        ->when($this->country != '' && $this->country != 'all', function($query) {
                                            $query->where('public_data', 'like', '%"country":"' . $this->country . '"%');
                                        })
                                        ->orderByRaw('CAST(price AS DECIMAL(10, 2)) ASC')
                                        ->paginate(10)
            ]
        );
    }
}
