<div>

    <div class="d-flex">
        <div class="wrapper2">
            <input wire:model="search" type="text" placeholder="Search By Username..." />
        </div>
    </div>

    <div class="d-flex">
        <div class="account-type-btn-wrapper">
            <button wire:click="changeStatus('pending')" class="{{$status == 'pending' ? 'account-type-btn active' : 'account-type-btn'}}" type="button">Pending</button>
            <button class="{{$status == 'completed' ? 'account-type-btn active' : 'account-type-btn'}}" wire:click="changeStatus('completed')" class="account-type-btn" type="button">Completed</button>
        </div>
        <div style="display: none;" wire:loading>
            <div class="loader"></div>
        </div>
    </div>

    @if (count($affiliate_requests) == 0)

        <p class="no-results">No Requests Found.</p>

    @else

        <div class="display-table">

            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Code</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($affiliate_requests as $request)
                        <tr>
                            <td mobile-title="Username">{{ $request->username }}</td>
                            <td mobile-title="Email">{{ $request->email }}</td>
                            <td mobile-title="Code">{{ $request->data }}</td>
                            <td mobile-title="Status">{{ ucfirst($request->status) }}</td>
                            <td mobile-title=""><button class="simple-btn"
                                    onclick="accept('{{ $request->id }}', '{{ $request->data }}')">accept</button></td>
                            <td mobile-title=""><button class="simple-btn"
                                    onclick="decline('{{ $request->id }}')">decline</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $affiliate_requests->links() }}

        </div>

    @endif

</div>
