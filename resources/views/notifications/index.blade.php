@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/notifications.css') }}" />
@endsection

@section('title')
    Notifications
@endsection

@section('subtitle')
    all my notifications
@endsection

@section('content')
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
                        <td mobile-title="TYPE">{{ ucwords(str_replace('_', ' ', $notification->type)) }}</td>
                        <td mobile-title="TITLE">{{ $notification->title }}</td>
                        <td mobile-title="PRICE">  {{ $notification->updated_at }} </td>
                        <td mobile-title="STATUS">     
                            <a href="/notifications/{{ $notification->id }}" class="simple-btn">Show</a>
                        </td>
                   
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $notifications->links() }}
        
    </div>

@endsection
