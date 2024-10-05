<div>
    <div class="d-flex">
        <div class="wrapper2">
            <input wire:model="search" type="text" placeholder="Search users..." />
        </div>
        <div style="display: none;" wire:loading>
            <div class="loader"></div>
        </div>
    </div>

    @if (count($users) == 0)

        <p class="no-results">No Results.</p>

    @else
        <div class="display-table">

            <table>
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>User name</th>
                        <th>Nickname</th>
                        <th>Balance</th>
                        <th>Seller</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td mobile-title="Email">{{ $user->email }}</td>
                            <td mobile-title="User name">{{ $user->username }}</td>
                            <td mobile-title="Nickname">{{ $user->nickname }}</td>
                            <td mobile-title="Balance">${{ $user->balance }}</td>
                            <td mobile-title="Seller">{{ $user->is_seller ? 'true' : 'false' }}</td>
                            <td mobile-title="Edit"><a class="simple-btn" style="text-decoration: none"
                                    href="/admin/users/{{ $user->id }}">Edit</a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $users->links() }}
            
        </div>
    @endif

</div>
