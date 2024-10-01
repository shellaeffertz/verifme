@extends('layouts.app')

@section('style')
<style>
        #products {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #products td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #products tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #products tr:hover {
            background-color: #ddd;
        }

        #products th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
</style>
@endsection


@section('content')

<a href="{{ route('seller.create') }}" class="btn btn-primary">Create Product</a>

<table id="products">
<tr>
    <th>Type</th>
    <th>Title</th>
    <th>Price</th>
    <th>Status</th>
    <th>view</th>
</tr>


@foreach ($orders as $order)
    <tr>
        <td>{{ $order->type }}</td>
        <td>{{ $order->title }}</td>
        <td>{{ $order->price }}$</td>
        <td>{{ $order->status }}</td>
        <td><a href="{{ route('seller.order', $order->uuid) }}" class="btn btn-primary">View</a></td>
    </tr>
@endforeach
</table>

@endsection

@section('title')
    My Orders
@endsection
