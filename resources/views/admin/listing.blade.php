@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('.././assets/css/seller-products.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././css/sucess-modal.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('title')
    Show Listing
@endsection


@section('content')

    <div class="report-details">

        <h2 class="section-headline" >Listing DETAILS</h2>

        <div>
            <label>title :</label>
            <input type="text" value="{{ $product->title }}" disabled>
        </div>

        <div>
            <label>Description:</label>
            <textarea rows="5" disabled>{{ $product->public_data->description }}</textarea>
        </div>
        
        <div>
            <label>Country :</label>
            <input type="text" value="{{ $product->public_data->country }}" disabled>
        </div>

        <div>
            <label>Created At :</label>
            <input type="text" value="{{ $product->created_at }}" disabled>
        </div>

        <div>
            <label>Status:</label>
            <input type="text" value="{{ $product->status }}" disabled>
        </div>

        <div>
            <label>Type:</label>
            <input type="text" value="{{ ucwords(str_replace('_', ' ', $product->type)) }}" disabled>
        </div>

        <div>
            <label>Delivery Type:</label>
            <input type="text" value="{{ ucfirst($product->delivery_type) }}" disabled>
        </div>

        @if($product->delivery_type == 'preorder')
            <div>
                <label>Delivery Periode:</label>
                <input type="text" value="{{ $product->delivery_period }}" disabled>
            </div>
        @endif

        @if($product->delivery_type == 'instant')
            <div>
                <label>Account Details :</label>
                <input type="text" value="{{ $product->private_data->account_details }}" disabled>
            </div>
            <div>
                <label>Document links :</label>
                <input type="text" value="{{ $product->private_data->document_links }}" disabled>
            </div>
        @endif

        <div>
            <label>Price:</label>
            <input type="text" value="{{ $product->price }}$" disabled>
        </div>
       
        <div class="form-btn-wrapper">
            <button onclick="deleteProduct('{{ $product->id }}')" class="simple-btn" type="button">DELETE</button>
        </div>

    </div>

    <div id="delete-modal" class="delete-modal">
        <div class="modal-content" id="delete-modal-content">
        </div>
    </div>

@endsection

@push('script')
    <script>

        let deleteModal = document.getElementById("delete-modal");
        let deleteModalContent = document.getElementById("delete-modal-content");

        const deleteProduct = (id) => {

            deleteModalContent.innerHTML = `
                <form action="/admin/delete" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="delete-modal-header">
                        <span onclick="closeDeleteModal()" class="delete-close" id="delete-close">&times;</span>
                        <h2>Confirmation Request</h2>
                    </div>
                    <p style="text-align:center;color: red;font-weight: bold; font-size: 18px;">
                        Are you sure you want delete this Listing ?
                    </p>
                    <input type="hidden" name="product_id" value="${id}" />
                    <div class="form-btn-wrapper" style="padding: 15px; gap: 10px;">
                        <button  class="simple-btn">Delete</button>
                        <button  onclick="event.preventDefault(); closeDeleteModal()" class="simple-btn">Cancel</button>
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
        }
    </script>
@endpush