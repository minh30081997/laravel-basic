<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>

<body>
    <form action="{{ route('login') }}" method="POST">
        {{ csrf_field() }}
        @if (isset($message))
            {{ $message }}
        @endif
        <input type="text" name="username" id="username">
        <input type="password" name="password" id="password">
        <input type="submit" name="login" id="login">
    </form>
</body>

</html>