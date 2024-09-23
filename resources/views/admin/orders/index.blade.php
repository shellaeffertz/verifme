@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('.././assets/css/seller-products.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././css/sucess-modal.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('title')
    All Orders
@endsection


@section('content')
    {{-- <div class="d-flex">
        <div class="wrapper2">
            <input wire:model="search" id="searchInput" type="text" placeholder="Search Order By User..." />
        </div>
    </div> --}}

    <div id="filteredResults" class="display-table">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Seller</th>
                    <th>Buyer</th>
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
                        <td mobile-title="Seller nickname"> {{ $order->seller->nickname }} </td>
                        <td mobile-title="Buyer nickname"> {{ $order->buyer->nickname }} </td>
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
                        <td mobile-title="View"><a class="simple-btn" style="text-decoration: none"
                                href="order/{{ $order->uuid }}">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}

    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const filteredResults = document.getElementById('filteredResults');
        const rows = document.querySelectorAll('.display-table tbody tr');
    
        // Function to filter orders
        function filterOrders() {
            const searchText = searchInput.value.toLowerCase();
    
            rows.forEach(row => {
                let rowText = row.textContent.toLowerCase();
                if (rowText.includes(searchText)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    
        // Add event listener to the search input
        searchInput.addEventListener('keyup', filterOrders);
    </script>
    
    
@endsection

