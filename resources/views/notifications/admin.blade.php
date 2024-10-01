@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/notifications.css') }}" />
@endsection


@section('content')
    <ul class="responsive-table">
        <li class="table-header">
            <div class="col col-1">Notification Title</div>
            <div class="col col-2">Description</div>
            <div class="col col-3">Date</div>
            <div class="col col-4"></div>
        </li>

        <div class="withdraws">

            @foreach ($notifications as $notification)
                <li class="table-row @if (!$notification->seen) pending @endif">
                    <div class="col col-1">{{ $notification->type }} </div>
                    <div class="col col-2">{{ $notification->title }}</div>
                    <div class="col col-3">{{ $notification->updated_at }}</div>
                    <div class="col col-4">
                        <a href="/admin/notifications/{{ $notification->id }}" class="simple-btn">Show</a>
                    </div>
                </li>
            @endforeach

        </div>
    </ul>
@endsection

@section('title')
    Notifications
@endsection
