<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/user.css') }}" />
    <link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}" />
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.key') }}"></script>

</head>

<body>

    <div class="success">
        @if (session()->has('success'))
            <p>{{ session()->get('success') }}</p>
        @endif
    </div>
    <div class="success">
        @if (session()->has('success'))
            <p>{{ session()->get('success') }}</p>
        @endif
    </div>


    <form action="/reset" method="POST" id="forgot-pass">
        <div class="imgcontainer">
            <!-- <img src="logo.png" alt="Avatar" class="avatar"> -->
            <h1>Reset password</h1>
        </div>
        <span class="spw">
            Forgot your password? No worries,
            please enter your email address
            and we will email you a password
            reset link that will allow you to
            choose a new one.
        </span>
        <div class="errors">
            @if ($errors->any())
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
            @endif
        </div>

        <div class="container">
            <input type="text" placeholder="Email / username" name="username" required>
            <button class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}" data-callback='onSubmit'
                data-action='submit'>Reset Password</button>

        </div>

        <span class="psw"><a href="login">Back</a></span>

    </form>
     <script type="text/javascript" src="./js/modal.js"></script>
    <script>
        function onSubmit(token) {
            document.getElementById("forgot-pass").submit();
        }
    </script>
    <script src="{{asset('./assets/js/login.js')}}"></script>
</body>

</html>
