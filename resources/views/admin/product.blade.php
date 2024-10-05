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

@section('subtitle')
    All listed Products
@endsection


@section('content')

    @livewire('admin.products') 

    <div id="delete-modal" class="delete-modal">
        <div class="delete-modal-content" id="delete-modal-content">
        </div>
    </div>

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