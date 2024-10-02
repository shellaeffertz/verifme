<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

class Accounts extends Component
{
    public $search = '';
    public $country = '';
    public $query = 'personal';

    public function render()
    {
        return view(
            'livewire.products.accounts',
            [
                'products' => Product::where('type', 'bank_accounts')
                                    ->where('status', 'active')
                                    ->where('public_data', 'like', '%"account_type":"'.$this->query.'"%')
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

    public function changeAccountType($accountType) {
        $this->query = $accountType;
    }
}