@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}" />
@endsection

@section('title')
    Profile
@endsection


@section('subtitle')
    my Profile information
@endsection


@section('content')

    <div class="create-form">

        <div class="form-group">

            <h2 class="section-headline">PROFILE</h2>
    
            <div>
                <label>Username:</label>
                <input type="text" value="{{ $user->username }}" disabled/>
            </div>
    
    
            <div>
                <label>Nickname:</label>
                <input type="text" value="{{ $user->nickname }}" disabled/>
            </div>
    
            <div>
                <label>Email:</label>
                <input type="text" value="{{ $user->email }}" disabled/>
            </div>
    
        </div>

        <div class="form-group">

            <h2 class="section-headline">SECURITY</h2>
    
            <form action="/profile" method="POST">
                @csrf
                @method('PUT')

                <div>
                    <label>Current Password:</label>
                    <input type="password" name="current_password"/>
                    @error('current_password')
                        <div class="form-error-message">{{ $message }}</div>
                    @enderror
                </div>
        
        
                <div>
                    <label>New Password:</label>
                    <input type="password" name="password"/>
                    @error('password')
                        <div class="form-error-message">{{ $message }}</div>
                    @enderror
                </div>
        
                <div>
                    <label>New Password confirmation:</label>
                    <input type="password" name="password_confirmation"/>
                    @error('password_confirmation')
                        <div class="form-error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-btn-wrapper">
                    <button type="submit" class="simple-btn">Update</button>
                </div>

            </form>
    
        </div>

    </div>

@endsection