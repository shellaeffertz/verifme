@extends('layouts.app')

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
                        <th> </th>
                        <th> </th>
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
    <div class="modal" id="accept-modal">
        <div class="modal-content">
            <form action="/admin/affiliates" method="POST" id="accept-form">
                @csrf
                <input type="hidden" name="status" value="approved">
                <input type="text" name="code" placeholder="Enter code" id="code">
                <input type="number" name="commission" placeholder="Enter commission" id="commission">
                <input type="submit" value="submit">
            </form>
        </div>
    </div>
@endsection


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
@endsection

@push('script')
    <script>
        const accept = (id, code) => {
            const modal = document.getElementById('accept-modal');
            modal.style.display = 'flex';

            const form = document.querySelector('#accept-form');
            form.setAttribute('action', '/admin/affiliates/' + id);

            const codeInput = document.getElementById('code');
            codeInput.value = code;

            const commissionInput = document.getElementById('commission');
            commissionInput.value = 5;

            modal.style.display = 'flex';

            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }




        }

        const decline = (id) => {
            const form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', '/admin/affiliates/' + id);

            const hiddenField = document.createElement('input');
            hiddenField.setAttribute('type', 'hidden');
            hiddenField.setAttribute('name', 'status');
            hiddenField.setAttribute('value', 'rejected');

            const hiddenField2 = document.createElement('input');
            hiddenField2.setAttribute('type', 'hidden');
            hiddenField2.setAttribute('name', '_token');
            hiddenField2.setAttribute('value', '{{ csrf_token() }}');

            form.appendChild(hiddenField);
            form.appendChild(hiddenField2);

            document.body.appendChild(form);
            form.submit();
        }
    </script>
@endpush
