<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;

class Products extends Component
{

    public $search = "";

    public function render()
    {
        return view('livewire.admin.products', [
            'products' => Product::when($this->search, function($query, $search) {
                $query->where('title', 'LIKE', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10)
        ]);
    }
}
