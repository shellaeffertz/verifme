@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('.././assets/css/seller-products.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././css/sucess-modal.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('title')
    All Products
@endsection


@section('content')
    <div class="d-flex">
        <div class="wrapper2">
            <input wire:model="search" type="text" placeholder="Search Order By User..." />
        </div>
    </div>

    <div class="display-table">
        <table>
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Seller nickname</th>
                    <th>Product Title</th>
                    <th>Product Type</th>
                    <th>Product Status</th>
                    <th>Product Price</th>
                    <th>Date Of Listing</th>
                    <th>Product Description</th>
                    <th> Delete the listing</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        {{-- <td mobile-title="SellerName">{{$product->id}}</td> --}}
                        <td mobile-title="SellerName">{{$product->seller->nickname}}</td>
                        <td mobile-title="TITLE">{{ $product->title }}</td>
                        <td mobile-title="TYPE">{{ $product->type }}</td>
                        <td mobile-title="TITLE">{{ $product->title }}</td>
                        <td mobile-title="STATUS">{{ $product->status }}</td>
                        <td mobile-title="PRICE">{{ $product->price }}$</td>
                        <td mobile-title="DATE">{{ $product->created_at }}</td>
                        <td mobile-title="DESC">
                            <div class="">
                                <p class="truncated-description">
                                  {{Str::limit($product->public->description, 50, '...') }}
                                </p>
                             
                                <span class="tooltip">                  
                                  {{  str_replace("\r\n","\n", $product->public->description) }}
                                </span>
                            </div> 
                        </td>
                    <td mobile-title="Delete">
                        <a class="simple-btn"
                            onclick="deleteProduct({{ $product->id }})">Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}

    </div>

{{--  --}}
<div id="delete-modal" class="delete-modal">
    <div class="delete-modal-content" id="delete-modal-content">
    </div>

</div>
    {{--  --}}
@endsection

@push('script')
    <script>
        let modal = document.getElementById("modal");
        let deleteModal = document.getElementById("delete-modal");
        let deleteModalContent = document.getElementById("delete-modal-content");

        function selectProductTypeModal() {

            modal.style.display = "block";
        }

        const deleteProduct = (id) => {

            console.log(id);
            deleteModalContent.innerHTML = `
             <form action="/admin/delete/${id}" method="POST" >
             <div class="delete-modal-header">
                 <span onclick="closeDeleteModal()" class="delete-close" id="delete-close">&times;</span>
                 <h2>Are you sure you want to delete this product?</h2>
             </div>
                  <div class="delete-modal-body">
                 <button  class="next-button">Delete</button>
                 <button  onclick="event.preventDefault(); closeDeleteModal()" class="next-button">Cancel</button>
                  </div>  
              </form>
             `;
            deleteModal.style.display = "block"
        }


        function closeModal() {
            modal.style.display = "none";
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