@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('./assets/css/profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}" />
@endsection


@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif






    <ul class="navarea">
        <li class="menu-page"><button id="general" class="active">General</button></li>
        <li class="menu-page"><button id="security">Security</button></li>
        {{-- <li class="menu-page"><button id="notifications">Notifications</button></li> --}}
     </ul>

    @if ($errors->any())
        <div class="errors">
            @foreach ($errors->all() as $error)
                <label>
                    <input type="checkbox" class="alertCheckbox" autocomplete="off" />
                    <div class="alert error">
                        <span class="alertClose">X</span>
                        <span class="alertText">ERROR : {{ $error }}
                            <br class="clear" /></span>
                    </div>
                </label>
            @endforeach
        </div>
    @endif

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

        {{-- <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <p class="update-pass-title">Update password</p>
                    <form action="/profile" method="post">
                        <br>
                        <input type="password" name="current_password" placeholder="current password" required>
                       
                        <input type="password" name="password" placeholder="password" required>
                       
                        <input type="password" name="password_confirmation" placeholder="password confirmation" required>
                       
                        <input class="button" type="submit" value="Change">
                    </form>



                </div>
            </div>
        </div> --}}
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

    {{-- <div id="notifications-content">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-body">
                    <p class="update-pass-title">Notifications</p>
                </div>
            </div>
        </div>
    </div> --}}

  





    <script type="text/javascript" src="./js/profile.js"></script>

@endsection

@section('title')
    Profile
@endsection
