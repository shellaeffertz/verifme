@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}" />
@endsection


@section('content')


    {{-- <ul class="navarea">
        <li class="menu-page"><button id="general" class="active">General</button></li>
        <li class="menu-page"><button id="security">Security</button></li>
     </ul>

    <div id="general-content" class="page-content">


        <br>
        <div class="line">
            <p class="char1">Nickname : </p>
            <input value="{{ $user->nickname }}" disabled>
        </div>
        <br>
        <hr>

        <br>
        <div class="line">
            <p class="char1">Email : </p>
            <input value="{{ $user->email }}" disabled>
        </div>
        <br>
        <hr>

        <br>
        <div class="line">
            <p class="char1">Username : </p>
            <input value="{{ $user->username }}" disabled>
        </div>
        <br>


    </div>

    <div id="security-content">

        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <p class="update-pass-title">Update password</p>
                    <form action="/profile" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <input type="password" name="current_password" class="form-control col-12" placeholder="current password" required>
                            @error('current_password')
                                <div class="form-error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control col-12" placeholder="password" required>
                            @error('password')
                                <div class="form-error-message">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation" class="form-control col-12" placeholder="password confirmation" required>
                            @error('password_confirmation')
                                <div class="form-error-message">{{ $message }}</div>
                            @enderror
                        </div>                        
                        <div class="form-btn-wrapper">
                            <input class="simple-btn" type="submit" value="Change">
                        </div>
                    </form>
                 </div>
            </div>
        </div>
        

    </div>

    <script type="text/javascript" src="./js/profile.js"></script> --}}

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

@section('title')
    Profile
@endsection
