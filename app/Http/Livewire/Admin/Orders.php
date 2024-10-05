<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class Orders extends Component
{

    public $search= "";

    public function render()
    {
        return view('livewire.admin.orders', [

            'orders' => Order::when($this->search, function($query, $search) {
                                    $query->where('title', 'LIKE', '%' . $search . '%');
                                })
                                ->orderBy('created_at', 'desc')
                                ->paginate(10)
        ]);
    }
}
