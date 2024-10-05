<div>

    <div class="d-flex">
        <div class="wrapper2">
            <input wire:model="search" type="text" placeholder="Search By Username..." />
        </div>
    </div>

    <div class="d-flex">
        <div class="account-type-btn-wrapper">
            <button wire:click="changeStatus('open')" class="{{$status == 'open' ? 'account-type-btn active' : 'account-type-btn'}}" type="button">Open</button>
            <button class="{{$status == 'completed' ? 'account-type-btn active' : 'account-type-btn'}}" wire:click="changeStatus('completed')" class="account-type-btn" type="button">Completed</button>
        </div>
        <div style="display: none;" wire:loading>
            <div class="loader"></div>
        </div>
    </div>

    @if (count($support_messages) == 0)

        <p class="no-results">No Tickets Found.</p>

    @else

        <div class="display-table">

            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Type</th>
                        <th>user</th>
                        <th>email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($support_messages as $tickets)
                        <tr>
                            <td mobile-title="Subject"> {{ Str::limit($tickets->subject, 60, '...') }}</td>
                            <td mobile-title="Type">{{ $tickets->type }}</td>
                            <td mobile-title="user">{{ $tickets->username }}</td>
                            <td mobile-title="email">{{ $tickets->email }}</td>
                            <td mobile-title=""><a href="{{ route('admin.support.show', $tickets->id) }}" class="simple-btn">view</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $support_messages->links() }}
            
        </div>

    @endif

</div>
