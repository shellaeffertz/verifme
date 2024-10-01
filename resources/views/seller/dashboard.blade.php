@extends('layouts.app')

@section('style')

    <link rel="stylesheet" href="{{ asset('../.././css/seller-dashboard.css') }}" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

        <link rel="stylesheet" href="{{ asset('.././assets/css/seller-products.css') }}" />
        <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
        <link rel="stylesheet" href="{{ asset('.././assets/css/modal.css') }}" />
        <link rel="stylesheet" href="{{ asset('.././css/sucess-modal.css') }}" />

@endsection

@section('title')
    Dashboard
@endsection


@section('content')
    <div class="content2">
        <div class="pt-4 px-4">
            <div class="row g-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-line fa-3x icon-color"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today Sales</p>
                            <h6 class="mb-0">
                                {{ \App\Models\Order::where('seller_id', Auth::user()->id)->where('status', '!=', 'pending')->whereDate('created_at', Carbon\Carbon::today())->count() }}
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-bar fa-3x icon-color"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Sales</p>
                            <h6 class="mb-0">
                                {{ \App\Models\Order::where('seller_id', Auth::user()->id)->where('status', '!=', 'pending')->count() }}
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-area fa-3x icon-color"></i>
                        <div class="ms-3">
                            <p class="mb-2">Today Revenue</p>
                            <h6 class="mb-0">
                                {{ \App\Models\Order::where('seller_id', Auth::user()->id)->where('status', '!=', 'pending')->where('refunded', false)->whereDate('created_at', Carbon\Carbon::today())->sum('price') }}$
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                        <i class="fa fa-chart-pie fa-3x icon-color"></i>
                        <div class="ms-3">
                            <p class="mb-2">Total Revenue</p>
                            <h6 class="mb-0">
                                {{ \App\Models\Order::where('seller_id', Auth::user()->id)->where('status', '!=', 'pending')->where('refunded', false)->sum('price') }}$
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sale & Revenue End -->


        <!-- Recent Sales Start -->
        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Recent Listed Products</h6>
                    <a href="/seller/products" style="text-decoration: none ; font-weight : bold ; color: #1C3879;">
                        Show All
                    </a>
                </div>




                <div class="display-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (\App\Models\Product::where('seller_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5) as $product)
                                <tr>
                                @if($product->type == "bank_accounts")
                                    <td mobile-title="Type">Banck Accounts</td>
                                @elseif($product->type == "cracked_account")
                                <td mobile-title="Type">Cracked Accounts</td>
                                @elseif($product->type == "payement_processors")
                                <td mobile-title="Type">Payements process</td>
                                @elseif($product->type == "crypto_exchanges")
                                    <td mobile-title="Type">Crypto and Exchanges</td>
                                @elseif($product->type == "real_fakedocs")
                                    <td mobile-title="Type">Real and fake documents</td>
                                @endif
                                    <td mobile-title="Title">{{ Str::limit($product->title, 50, '...') }}</td>
                                    <td mobile-title="Price">{{ $product->price }}$</td>
                                    <td mobile-title="Status">{{ $product->status }}</td>
                                    <td mobile-title="Edit"><a href="{{ route('seller.edit', $product->id) }}"
                                            class="simple-btn" style="text-decoration: none">Edit</a></td>
                                    <td mobile-title="Delete">
                                        <a class="simple-btn" onclick="deleteProduct({{ $product->id }})" style="text-decoration: none">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <div class="container-fluid pt-4 px-4">
            <div class="bg-light text-center rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0">Orders</h6>
                    <a href="/seller/orders" style="text-decoration: none ; font-weight : bold ; color: #1C3879;">
                        Show All
                    </a>
                </div>

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

                            @foreach (\App\Models\Order::where('seller_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5) as $order)
                                <tr>
                                    @if($order->type == "bank_accounts")
                                        <td mobile-title="Type">Banck Accounts</td>
                                    @elseif($order->type == "cracked_account")
                                        <td mobile-title="Type">Cracked Accounts</td>
                                    @elseif($order->type == "payement_processors")
                                        <td mobile-title="Type">Payements process</td>
                                    @elseif($order->type == "crypto_exchanges")
                                        <td mobile-title="Type">Crypto and Exchanges</td>
                                    @elseif($order->type == "real_fakedocs")
                                        <td mobile-title="Type">Real and fake documents</td>
                                    @endif
                                    <td mobile-title="Title">{{ Str::limit($order->title, 50, '...') }}</td>
                                    <td mobile-title="Price">{{ $order->price }}$</td>
                                    @if ($order->status != 'pending')
                                        <td mobile-title="Status" style="color: green">{{ $order->status }}</td>
                                    @else
                                        <td mobile-title="Status">{{ $order->status }}</td>
                                    @endif
                                    <td mobile-title="">
                                        <a href="{{ route('seller.order', $order->uuid) }}" class="simple-btn" style="text-decoration: none">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </div>
    </div>

    <div id="delete-modal" class="delete-modal">
        <div class="delete-modal-content" id="delete-modal-content">
        </div>
    </div>
@endsection

@push('script')
    <script>

        let deleteModal = document.getElementById("delete-modal");
        let deleteModalContent = document.getElementById("delete-modal-content");

        const deleteProduct = (id) => {
            deleteModalContent.innerHTML = `
             <form action="/seller/delete" method="POST" >
                @csrf
                @method('DELETE')
                <div class="delete-modal-header">
                    <span onclick="closeDeleteModal()" class="delete-close" id="delete-close">&times;</span>
                    <h2>Confirmation Request</h2>
                </div>
                <p style="text-align:center;color: red;font-weight: bold; font-size: 18px;">
                    Are you sure you want delete this product ?
                </p>
                <input type="hidden" name="product_id" value="${id}" />
                <div class="form-btn-wrapper" style="padding: 15px; gap: 10px;">
                    <button class="simple-btn">Delete</button>
                    <button type="button"  onclick="closeDeleteModal()" class="simple-btn">Cancel</button>
                </div>  
              </form>
             `;
            deleteModal.style.display = "block";
        }

        function closeDeleteModal() {
            deleteModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == deleteModal) {
                deleteModal.style.display = "none";
            }
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endpush


