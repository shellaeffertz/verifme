<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Users extends Component
{
    public $search = '';

    public function render()
    {
        return view(
            'livewire.admin.users',
            [
                'users' => User::where('username', 'like', '%' . $this->search. '%')
                                ->orWhere('email', 'like', '%' . $this->search . '%')
                                ->orWhere('nickname', 'like', '%' . $this->search . '%')
                                ->paginate(10)
            ]
        );
    }
}
