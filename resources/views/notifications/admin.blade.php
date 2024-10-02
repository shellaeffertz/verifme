@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/notifications.css') }}" />
@endsection

@section('title')
    Notifications
@endsection

@section('subtitle')
All your notifications
@endsection

@section('content')

    <table>
        <thead>
            <tr>
                <th>Title</th>
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
                        <a href="/admin/notifications/{{ $notification->id }}" class="simple-btn">Show</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
