@extends('layouts.app')

@section('style')
    <style>
        .modal {
            display: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
    </style>

    <link rel="stylesheet" href="{{ asset('.././assets/css/seller-products.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././css/sucess-modal.css') }}" />

@endsection

@section('title')
    Affiliate Requests
@endsection

@section('subtitle')
    List of pending affiliate requests
@endsection

@section('content')
    @if (count($affiliate_requests))
        <div class="display-table">
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Code</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($affiliate_requests as $request)
                        <tr>
                            <td mobile-title="Username">{{ $request->username }}</td>
                            <td mobile-title="Email">{{ $request->email }}</td>
                            <td mobile-title="Code">{{ $request->data }}</td>
                            <td mobile-title="Accept"><button class="simple-btn"
                                    onclick="accept('{{ $request->id }}', '{{ $request->data }}')">accept</button></td>
                            <td mobile-title="Reject"><button class="simple-btn"
                                    onclick="decline('{{ $request->id }}')">decline</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $affiliate_requests->links() }}

        </div>
    @endif

    <div id="accept-modal" class="delete-modal">
        <div class="delete-modal-content" id="accept-modal-content">
        </div>
    </div>

    <div id="decline-modal" class="delete-modal">
        <div class="delete-modal-content" id="decline-modal-content">
        </div>
    </div>

@endsection

@push('script')
    <script>
        // const accept = (id, code) => {
        //     const modal = document.getElementById('accept-modal');
        //     modal.style.display = 'flex';

        //     const form = document.querySelector('#accept-form');
        //     form.setAttribute('action', '/admin/affiliates/' + id);

        //     const codeInput = document.getElementById('code');
        //     codeInput.value = code;

        //     const commissionInput = document.getElementById('commission');
        //     commissionInput.value = 5;

        //     modal.style.display = 'flex';

        //     window.onclick = function(event) {
        //         if (event.target == modal) {
        //             modal.style.display = "none";
        //         }
        //     }
        // }

        // const decline = (id) => {
        //     const form = document.createElement('form');
        //     form.setAttribute('method', 'POST');
        //     form.setAttribute('action', '/admin/affiliates/' + id);

        //     const hiddenField = document.createElement('input');
        //     hiddenField.setAttribute('type', 'hidden');
        //     hiddenField.setAttribute('name', 'status');
        //     hiddenField.setAttribute('value', 'rejected');

        //     const hiddenField2 = document.createElement('input');
        //     hiddenField2.setAttribute('type', 'hidden');
        //     hiddenField2.setAttribute('name', '_token');
        //     hiddenField2.setAttribute('value', '{{ csrf_token() }}');

        //     form.appendChild(hiddenField);
        //     form.appendChild(hiddenField2);

        //     document.body.appendChild(form);
        //     form.submit();
        // }

        let acceptModal = document.getElementById("accept-modal");
        let acceptModalContent = document.getElementById("accept-modal-content");

        let declineModal = document.getElementById("decline-modal");
        let declineModalContent = document.getElementById("decline-modal-content");

        const accept = (id, data) => {

            acceptModalContent.innerHTML = `
                <form action="/admin/affiliates/${id}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="delete-modal-header">
                        <span onclick="closeAcceptModal()" class="delete-close" id="delete-close">&times;</span>
                        <h2>Confirmation Request</h2>
                    </div>
                    <p style="text-align:center;color: red;font-weight: bold; font-size: 18px;">
                        Are you sure you want acceprt this user as affiliate ?
                    </p>
                    <input type="hidden" name="status" value="approved">
                    <div style="padding: 0 15px;">
                        <label for="code">Code:</label>
                        <input id=="code" type="text" name="code" placeholder="Enter code" id="code" value="${data}">
                    </div>
                    <div style="padding: 0 15px;">
                        <label for="commision">Commision:</label>
                        <input id="commision" type="number" name="commission" placeholder="Enter commission" id="commission" value="5">
                    </div>
                    <div class="form-btn-wrapper" style="padding: 15px; gap: 10px;">
                        <button  class="simple-btn">Accept</button>
                        <button  onclick="event.preventDefault(); closeAcceptModal()" class="simple-btn">Cancel</button>
                    </div>  
                </form>
            `;
            acceptModal.style.display = "block";
        }

        const decline = (id) => {

            declineModalContent.innerHTML = `
                <form action="/admin/affiliates/${id}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="delete-modal-header">
                        <span onclick="closeDeclineModal()" class="delete-close" id="delete-close">&times;</span>
                        <h2>Confirmation Request</h2>
                    </div>
                    <p style="text-align:center;color: red;font-weight: bold; font-size: 18px;">
                        Are you sure you want decline this user as affiliate ?
                    </p>
                    <input type="hidden" name="status" value="rejected">
                    <div class="form-btn-wrapper" style="padding: 15px; gap: 10px;">
                        <button  class="simple-btn">Decline</button>
                        <button  onclick="event.preventDefault(); closeDeclineModal()" class="simple-btn">Cancel</button>
                    </div>  
                </form>
            `;
            declineModal.style.display = "block";
        }

        function closeAcceptModal() {
            acceptModal.style.display = "none";
        }

        function closeDeclineModal() {
            declineModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == acceptModal) {
                acceptModal.style.display = "none";
            }
        }
    </script>
@endpush
