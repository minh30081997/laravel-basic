<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Send Token</title>
</head>

<body>
    <h1>Reset Password</h1>

    @if(session('message'))
    {{ session('message') }}
    @endif

    <form action="{{ route('send.token') }}" method="POST">
        {{ csrf_field() }}
        Email: <input type="email" name="email" id="email">
        <input type="submit" name="send-token" id="send-token" value="Send Password Reset Link">
    </form>
</body>

</html>