@extends('layouts.app')

@section('style')
@endsection

@section('title')
    My Orders
@endsection

@section('subtitle')
    all Your registered Orders
@endsection


@section('content')

    <div class="display-table">
        
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td mobile-title="Type">{{ $order->type }}</td>
                        <td mobile-title="Title">{{ Str::limit($order->title, 50, '...') }}</td>
                        <td mobile-title="Price">{{ $order->price }}$</td>
                        @if ($order->status != 'pending')
                            <td mobile-title="Status" style="color: green">{{ $order->status }}</td>
                        @else
                            <td mobile-title="Status">{{ $order->status }}</td>
                        @endif
                        <td mobile-title=""><a href="{{ route('seller.order', $order->uuid) }}" class="simple-btn"
                                style="text-decoration: none">View</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $orders->links() }}

    </div>
@endsection


