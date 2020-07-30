<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Content</title>
</head>
<body>
    <p>Hi {{ $data['user']->name }} !</p>
    <a href="{{ $data['route'] }}">Reset password</a>
</body>
</html>