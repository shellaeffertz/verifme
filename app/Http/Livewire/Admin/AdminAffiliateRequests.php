<?php

namespace App\Http\Livewire\Admin;

use App\Models\Request;
use Livewire\Component;

class AdminAffiliateRequests extends Component
{
    public $search = "";
    public $status = "pending";

    public function render()
    {
        return view('livewire.admin.admin-affiliate-requests', [
            'affiliate_requests' => Request::join('users', 'users.id', '=', 'requests.user_id')
                                    ->select('requests.*', 'users.username', 'users.email')
                                    ->where('requests.type', 'affiliate')
                                    ->when($this->status == 'pending', function($query) {
                                        $query->where('status', $this->status);
                                    }, function($query) {
                                        $query->where('status','<>', $this->status);
                                    })
                                    ->where('users.username', 'like', '%' . $this->search . '%')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10)
        ]);
    }

    public function changeStatus($val) {
        $this->status = $val;
    }
}
