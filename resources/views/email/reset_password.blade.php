<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    <form action="{{ route('save.reset.password') }}" method="POST">
        {{ csrf_field() }}
        <h1>Reset Password</h1>
        Email   :  <input type="email" name="email" id="email" value="{{ $email }}">
        Password:  <input type="password" name="password" id="password">
        <input type="submit" name="submit" id="submit" value="Reset">
    </form>
</body>
</html>