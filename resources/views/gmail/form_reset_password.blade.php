<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Reset Password</title>
</head>
<body>
    <h1>Reset Password</h1>
    <form action="" method="POST">
        {{ csrf_field() }}
        Email: <input type="email" name="email" id="email" value="{{ $emailForgot->email }}">
        <br>
        New password: <input type="password" name="password" id="password">
        <input type="submit" name="reset" id="reset" value="Reset">
    </form>
</body>
</html>