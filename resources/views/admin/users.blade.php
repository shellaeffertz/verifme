@extends('layouts.app')

@section('title')
    Users
@endsection

@section('subtitle')
All users registered in the app
@endsection

@section('content')
    @livewire('admin.users') 
@endsection