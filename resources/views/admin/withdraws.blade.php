@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('.././assets/css/modal-box.css') }}" />
@endsection

@section('title')
    withdraws
@endsection


@section('content')
    <div class="display-table">
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Nickname</th>
                    <th>Email</th>
                    <th>Balance</th>
                    <th>Amount</th>
                    <th>Withdraw Id</th>
                    <th>Withdraw type</th>
                    <th>Withdraw Coin</th>
                    <th>Withdraw Adresse</th>
                    <th>Withdraw Status</th>
                    <th>Withdraw Created_at</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($withdraws as $withdraw)
                    <tr>
                        <td mobile-title="Username">{{ $withdraw->username }}</td>
                        <td mobile-title="Nickname">{{ $withdraw->nickname }}</td>
                        <td mobile-title="Email">
                            <div class="description-container">
                            <p class="truncated-description">
                                {{Str::limit($withdraw->email, 50, '...') }}
                              </p>
                           
                              <span class="tooltip">                  
                                {{  str_replace("\r\n","\n", $withdraw->email) }}
                              </span>
                            </div>
                        </td>
                        <td mobile-title="Balance">${{ $withdraw->balance }}</td>
                        <td mobile-title="Amount">${{ $withdraw->amount }}</td>
                        <td mobile-title="Withdraw Id">{{ $withdraw->uuid }}</td>
                        <td mobile-title="Withdraw type">{{ $withdraw->type }}</td>
                        <td mobile-title="Withdraw Coin">{{ $withdraw->coin }}</td>
                        <td mobile-title="Withdraw Adresse">
                            <div class="description-container">
                            <p class="truncated-description">
                                {{Str::limit($withdraw->address, 50, '...') }}
                              </p>
                           
                              <span class="tooltip">                  
                                {{  str_replace("\r\n","\n", $withdraw->address) }}
                              </span>
                            </div>
                        </td>
                        <td mobile-title="Withdraw Status">{{ $withdraw->status }}</td>
                        <td mobile-title="Withdraw Created_at">{{ $withdraw->created_at }}</td>
                        <td mobile-title="Approve" onclick="approve('{{ $withdraw->uuid }}')">
                            <button class="simple-btn">Approve</button></td>
                        <td mobile-title="Reject" onclick="reject('{{ $withdraw->uuid }}')"><button
                                class="simple-btn">Reject</button></td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $withdraws->links() }}

    </div>


    <div id="reject-modal" class="modal">

        <form method="POST" id="reject-form" class="modal-content">
            <div class="modal-header">
                <span onclick="closeModal()" class="close">&times;</span>
            </div>
            <textarea name="reason" placeholder="Reason" style="width: 98%" class="select-box"></textarea>
            <input type="submit" value="Submit">
        </form>
    </div>
@endsection



@push('script')
    <script>
        function approve(uuid) {
            // create a form 
            var form = document.createElement("form");
            form.setAttribute("method", "post");
            form.setAttribute("action", "/admin/withdraws/" + uuid);
            form.setAttribute("style", "display: none");
            // create a hidden input
            var input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("name", "_token");
            input.setAttribute("value", "{{ csrf_token() }}");

            var status = document.createElement("input");
            status.setAttribute("type", "hidden");
            status.setAttribute("name", "status");
            status.setAttribute("value", "approved");

            // append the input to the form
            form.appendChild(input);
            form.appendChild(status);

            // append the form to the document
            document.body.appendChild(form);
            // submit the form
            form.submit();
        }

        function reject(uuid) {
            // show a modal and ask for reason then submit a form with reason status as rejected and uuid
            let modal = document.getElementById("reject-modal");
            modal.style.display = "block";
            let form = modal.querySelector("form");
            form.setAttribute("action", "/admin/withdraws/" + uuid);
            let status = document.createElement("input");
            status.setAttribute("type", "hidden");
            status.setAttribute("name", "status");
            status.setAttribute("value", "rejected");
            form.appendChild(status);
        }

        window.onclick = function(event) {
            if (event.target == document.getElementById("reject-modal")) {
                document.getElementById("reject-modal").style.display = "none";
            }
        }

        function closeModal() {
            document.getElementById("reject-modal").style.display = "none";
        }
    </script>
@endpush
