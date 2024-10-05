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

    @livewire('admin.admin-support-tickets')

@endsection

