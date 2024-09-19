@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/notifications.css') }}" />
@endsection


@section('content')
    {{-- <ul class="responsive-table">
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
                        <a href="/notifications/{{ $notification->id }}" class="simple-btn">Show</a>
                    </div>
                </li>
            @endforeach

        </div>
    </ul> --}}
    @if(Auth::user()->telegram_chat_id==NULL)
    <div class="button-container">
        <a class="simple-btn" href="/auth/telegram/redirect">Telegram Notification</a>
    </div>
    @endif

    <div class="display-table">
        <table>
            <thead>
                <tr>
                    <th>Notification Title</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>

                @foreach ($notifications as $notification)
                    <tr class="@if (!$notification->seen) pending @endif" >
                        <td mobile-title="TYPE">{{ $notification->type }}</td>
                        <td mobile-title="TITLE">{{ $notification->title }}</td>
                        <td mobile-title="PRICE">  {{ $notification->updated_at }} </td>
                        <td mobile-title="STATUS">     
                            <a href="/notifications/{{ $notification->id }}" class="simple-btn">Show</a>
                        </td>
                   
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection

@section('title')
    Notifications
@endsection
