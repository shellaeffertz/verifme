<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\SupportTicket;

class AdminSupportTickets extends Component
{

    public $search = "";
    public $status = 'open';

    public function render()
    {
        return view('livewire.admin.admin-support-tickets', [
            'support_messages' => SupportTicket::join('users', 'users.id', '=', 'support_tickets.user_id')
                                    ->select('support_tickets.*', 'users.username', 'users.email')
                                    ->where('status', $this->status)
                                    ->where('users.username', 'like', '%' . $this->search. '%')
                                    ->orderBy('created_at', 'desc')
                                    ->paginate(10)
        ]);
    }

    public function changeStatus($val) {
        $this->status = $val;
    }
}
