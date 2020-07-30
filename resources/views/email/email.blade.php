<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password With Email</title>
</head>
<body>
<form action="{{ route('send.code.reset.password') }}" method="POST">
    {{ csrf_field() }}
    @if(session('message'))
        {{ session('message') }}
    @endif
    <h1>Reset Password</h1>
    Email: 
    <input type="text" name="email" id="email">
    <input type="submit" name="submit" id="submit" value="Send Password Reset Link">
</form>
</body>
</html>