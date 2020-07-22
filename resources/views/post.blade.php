<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post Pagination</title>
</head>
<body>
    @foreach ($posts as $value)
    {{ $value->name }}
    @endforeach
    {{ $posts->links() }}

    {{ $posts->currentPage() }}
</body>
</html>