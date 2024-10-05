<div>

    <div class="d-flex">
        <div class="wrapper2">
            <input wire:model="search" type="text" placeholder="Search Orders By Title..." />
        </div>
        <div style="display: none;" wire:loading>
            <div class="loader"></div>
        </div>
    </div>

    @if (count($orders) == 0)

        <p class="no-results">No Results.</p>

    @else

        <div class="display-table">

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Refunded</th>
                        <th>Created At</th>
                        <th>
                            <span style="display: block;">D.P</span>
                            <span style="display: block;font-size: 9px;">(Delivery Period)</span>
                        </th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td mobile-title="Order ID"> {{ $order->uuid }} </td>
                            <td mobile-title="Title" class="description-column">
                                <p>
                                    {{Str::limit($order->title, 50, '...') }}
                                </p>
                                @if(Str::length($order->title) > 50)
                                    <p class="full-description">
                                        {{ $order->title }}
                                    </p>
                                @endif            
                            </td>
                            <td mobile-title="Order Type">
                                {{ ucwords(str_replace('_', ' ', $order->type)) }}
                            </td>
                            @if ($order->status != 'pending')
                                <td mobile-title="Order Status" style="color: green">{{ $order->status }}</td>
                            @else
                                <td mobile-title="Order Status">{{ $order->status }}</td>
                            @endif
                            <td mobile-title="Order Price"> ${{ $order->price }} </td>
                                @if(!$order->refunded)
                                <td mobile-title="Order Refund">No</td>
                                @else 
                                <td mobile-title="Order Refund">Yes</td>
                                @endif
                    
                            <td mobile-title="Order Date"> {{ $order->created_at }} </td>
                            <td mobile-title="Order Deadline">
                                {{ $order->delivery_type != 'instant' ? $order->delivery_period : 'Instant' }} </td>
                            <td mobile-title=""><a class="simple-btn" style="text-decoration: none"
                                    href="order/{{ $order->uuid }}">View</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $orders->links() }}
        </div>

    @endif

</div>
