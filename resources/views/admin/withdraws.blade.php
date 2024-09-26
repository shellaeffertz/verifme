@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('.././assets/css/seller-products.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal.css') }}" />
    <link rel="stylesheet" href="{{ asset('.././css/sucess-modal.css') }}" />
@endsection

@section('title')
    withdraws
@endsection


@section('content')

    <table>
        <thead>
            <tr>
                <th>Nickname</th>
                <th>Address</th>
                <th>Balance</th>
                <th>AF Balance</th>
                <th>Amount</th>
                <th>Type</th>
                <th>Coin</th>
                <th>Created At</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($withdraws as $withdraw)
                <tr>
                    <td mobile-title="Nickname">{{ $withdraw->nickname }}</td>
                    <td mobile-title="Address" class="description-column">
                        <p>
                            {{Str::limit($withdraw->address , 30, '...') }}
                        </p>
                        <p class="full-description">
                            {{ $withdraw->address  }}
                        </p>
                    </td>
                    <td mobile-title="Balance">${{ $withdraw->balance }}</td>
                    <td mobile-title="AF Balance">${{ $withdraw->affiliate_balance }}</td>
                    <td mobile-title="Amount">${{ $withdraw->amount }}</td>
                    <td mobile-title="type">{{ $withdraw->type }}</td>
                    <td mobile-title="Coin">{{ $withdraw->coin }}</td>
                    <td mobile-title="Created_at">{{ $withdraw->created_at }}</td>
                    <td mobile-title="">
                        <button onclick="approveWithdraw( '{{ $withdraw->uuid }}' )" type="button" class="simple-btn">Approve</button>
                    </td>
                    <td mobile-title="" onclick="rejectWithdraw('{{ $withdraw->uuid }}')">
                        <button class="simple-btn">Reject</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $withdraws->links() }}

    <div id="reject-modal" class="delete-modal" style="display: none;">
        <div class="delete-modal-content" id="reject-modal-content">
        </div>
    </div>

    <div id="approve-modal" class="delete-modal" style="display: none;">
        <div class="delete-modal-content" id="approve-modal-content">
        </div>
    </div>

@endsection



@push('script')
    <script>

        let approveModal = document.getElementById("approve-modal");
        let approveModalContent = document.getElementById("approve-modal-content");

        let rejectModal = document.getElementById("reject-modal");
        let rejectModalContent = document.getElementById("reject-modal-content");

        const approveWithdraw = (id) => {

            approveModalContent.innerHTML = `
                <form action="withdraws/${id}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="delete-modal-header">
                        <span onclick="closeApproveModal()" class="delete-close" id="delete-close">&times;</span>
                        <h2>Confirmation Request</h2>
                    </div>
                    <p style="text-align:center;color: red;font-weight: bold; font-size: 18px;">
                        Are you sure you want approve this withdraw ?
                    </p>
                    <input type="hidden" name="status" value="approved" />
                    <div class="form-btn-wrapper" style="padding: 15px; gap: 10px;">
                        <button  class="simple-btn">Approve</button>
                        <button  onclick="event.preventDefault(); closeApproveModal()" class="simple-btn">Cancel</button>
                    </div>  
                </form>
            `;
            approveModal.style.display = "block";
        }

        const rejectWithdraw = (id) => {

            rejectModalContent.innerHTML = `
                <form action="withdraws/${id}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="delete-modal-header">
                        <span onclick="closeRejectModal()" class="delete-close" id="delete-close">&times;</span>
                        <h2>Confirmation Request</h2>
                    </div>
                    <p style="text-align:center;color: red;font-weight: bold; font-size: 18px;">
                        Are you sure you want reject this withdraw ?
                    </p>
                    <input type="hidden" name="status" value="rejected" />
                    <div style="padding: 0 10px">
                        <label for="reason">Reason of Reject</label>
                        <textarea style="marging-top: 20px;" id="reason" name="reason" rows="10"></textarea>
                    </div>
                    <div class="form-btn-wrapper" style="padding: 15px; gap: 10px;">
                        <button  class="simple-btn">Reject</button>
                        <button  onclick="event.preventDefault(); closeRejectModal()" class="simple-btn">Cancel</button>
                    </div>  
                </form>
            `;
            rejectModal.style.display = "block";
        }

        function closeApproveModal() {
            approveModal.style.display = "none";
        }

        function closeRejectModal() {
            rejectModal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == approveModal) {
                approveModal.style.display = "none";
            }
        }

        window.onclick = function(event) {
            if (event.target == rejectModal) {
                rejectModal.style.display = "none";
            }
        }
    </script>
@endpush
