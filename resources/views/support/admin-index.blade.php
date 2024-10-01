@extends('layouts.app')

@section('style')
    <style>
        .add {
            margin-left: auto;
        }
    </style>
@endsection

@section('title')
    Support Tickets
@endsection

@section('subtitle')
    This is the list of all open support tickets.
@endsection


@section('content')

    @if (count($support_messages) == 0)
        <div class="alert alert-info">No tickets.</div>
    @else
        <div class="display-table">
            <table>
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>user</th>
                        <th>email</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($support_messages as $tickets)
                        <tr>
                            <td mobile-title="Subject"> {{ Str::limit($tickets->subject, 60, '...') }}</td>
                            <td mobile-title="Type">{{ $tickets->type }}</td>
                            <td mobile-title="Status">{{ $tickets->status }}</td>
                            <td mobile-title="user">{{ $tickets->username }}</td>
                            <td mobile-title="email">{{ $tickets->email }}</td>
                            <td mobile-title=""><a href="{{ route('admin.support.show', $tickets->id) }}" class="simple-btn">view</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $support_messages->links() }}
    @endif


@endsection

