@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('.././css/modal-box.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('title')
    My Orders
@endsection


@section('content')
    <div class="display-table">
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Title</th>
                    <th>Order Type</th>
                    <th>Order Status</th>
                    <th>Order Price</th>
                    <th>Order Date</th>
                    <th>Order Deadline</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td mobile-title="Order ID"> {{ $order->uuid }} </td>
                        <td mobile-title="Order Title"> {{ $order->title }} </td>
                        <td mobile-title="Order Type"> {{ str_replace('_', ' ', Illuminate\Support\Str::ucfirst($order->type)) }} </td>
                        @if ($order->status != 'pending')
                            <td mobile-title="Order Status" style="color: green">{{ $order->status }}</td>
                        @else
                            <td mobile-title="Order Status">{{ $order->status }}</td>
                        @endif
                        <td mobile-title="Order Price"> ${{ $order->price }} </td>
                        <td mobile-title="Order Date"> {{ $order->created_at }} </td>
                        <td mobile-title="Order Deadline"> {{ $order->delivery_type != 'instant' ? $order->delivery_period : 'Instant' }} </td>
                        {{-- <td> <a class="buy-button" href="{{ route('order', $order->uuid) }}">View</a> </td> --}}
                        <td mobile-title="View"><a class="simple-btn" style="text-decoration: none"
                                href="{{ route('order', $order->uuid) }}">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $orders->links() }}

    </div>
@endsection



