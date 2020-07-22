<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nhap Diem</title>
</head>
<body>
    <h1>Nhap Diem</h1>
    <form action="{{ route('diem') }}" method="GET">
        {{ csrf_field() }}
        <input type="number" name="number" id="number">
        <input type="submit" name="submit" id="submit">
    </form>
</body>
</html>