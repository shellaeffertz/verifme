<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Password</title>
    <link rel="stylesheet" href="{{ asset('./assets/css/user.css') }}"  />
    <link rel="stylesheet" href="{{ asset('./assets/css/modal.css') }}"  />

</head>
<body>

    <div class="success">
        @if(session()->has('success'))
            <p>{{ session()->get('success') }}</p>
        @endif
    </div>
    <div class="success">
        @if(session()->has('success'))
            <p>{{ session()->get('success') }}</p>
        @endif
    </div>

    <form action="/reset-password/{{$token}}" method="POST" >
        <div class="errors">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            @endif
        </div>
        <div class="imgcontainer">
          <!-- <img src="logo.png" alt="Avatar" class="avatar"> -->
          <h1>Reset password / Change password</h1>
        </div>   
        <span class="spw">
            Please enter the new password .
        </span>
  
        <div class="container">
          <input type="password" placeholder="New password" name="password" required>
          <input type="password" placeholder="Repeat new password" name="password_confirmation" required>
          <button type="submit">Update Password</button>
        </div>
      </form>
</body>
</html>