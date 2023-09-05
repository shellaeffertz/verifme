<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    Hi, {{ $user->name }} <br>
    <br>
    You are receiving this email because we received a password reset request for your account. <br>
    <br>
    Please click the button below to reset your password: <br>
    <br>
    <a href="{{ $reset_url }}">Reset Password</a> <br>
    <br>
    If you did not request a password reset, no further action is required. <br>
    <br>
    Regards, <br>
    {{ config('app.name') }}
</body>
</html>