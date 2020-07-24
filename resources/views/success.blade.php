<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Success</title>
</head>

<body>
    @if (Auth::check())
        <h1>Login success</h1>
        @if (isset($user))
            {{ "Ten: " . $user->name }}
            <br>
            {{ "Email: " . $user->email }}
            <br>
            <a href="{{ url('logout') }}">Logout</a>
        @endif
    @else
        <h1>Not Login?</h1>
    @endif
</body>

</html>