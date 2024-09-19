@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('.././assets/css/seller-products.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././css/sucess-modal.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection


@section('content')
    <div class="btn-mgl">
        <button class="simple-btn mgl-auto" onclick="selectProductTypeModal()"><i class="fa fa-plus icone"></i> Add
            Product</button>
    </div>


    <div class="display-table">
        <table>
            <thead>
                <tr>
                    <th>TYPE</th>
                    <th>TITLE</th>
                    <th>PRICE</th>
                    <th>STATUS</th>
                    <th> </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>

                @foreach ($products as $product)
                    <tr>
                        <td mobile-title="TYPE">{{ $product->type }}</td>
                        <td mobile-title="TITLE">{{ $product->title }}</td>
                        <td mobile-title="PRICE">{{ $product->price }}$</td>
                        <td mobile-title="STATUS">{{ $product->status }}</td>
                        <td mobile-title="Edit"><a href="{{ route('seller.edit', $product->id) }}" class="simple-btn">Edit</a></td>
                        <td mobile-title="Delete"><a class="simple-btn"
                                onclick="deleteProduct({{ $product->id }})">Delete</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}

    </div>





    <div id="modal" class="modal">
        <form action="{{ route('seller.create') }}" method="get" class="modal-content">
            <div class="modal-header">
                <span onclick="closeModal()" class="close">&times;</span>
                <h2>Select Product Type</h2>
            </div>
            <div class="modal-body"> 
                <select name="type" class="select-box">
                    <option value="bank_accounts">Bank Accounts</option>
                    <option value="payement_processors">Payement Processors</option>
                    <option value="crypto_exchanges">Crypto Exchanges</option>
                    <option value="cracked_account">Cracked Accounts</option>
                    <option value="real_fakedocs">Real and Fake Docs</option>
                </select>
                <input type="submit" value="Next" class="next-button">
            </div>
        </form>
    </div>

    <div id="delete-modal" class="delete-modal">
        <div class="delete-modal-content" id="delete-modal-content">
        </div>

    </div>
@endsection

@section('title')
    Products
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
             <form action="/seller/delete/${id}" method="POST" >
                <div class="delete-modal-header">
                    <span onclick="closeDeleteModal()" class="delete-close" id="delete-close">&times;</span>
                    <h2>Confirmation Request</h2>
                </div>
                <p style="text-align:center;color: red;font-weight: bold; font-size: 18px;">
                    Are you sure you want delete this product ?
                </p>
                <div class="delete-modal-body">
                    <button  class="simple-btn">Delete</button>
                    <button type="button"  onclick="closeDeleteModal()" class="simple-btn">Cancel</button>
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
