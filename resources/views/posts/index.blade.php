<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Posts</title>
</head>

<body>
    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row">
            @foreach($posts as $post)
            <div class="col-md-4">
                <h2>{{ $post->title }}</h2>
                <p>{{ str_limit($post->body, 100) }}</p>
                <p><a class="btn btn-default" href="{{ route('show_post', ['id' => $post->id]) }}" role="button">Chi
                        tiết »</a></p>
            </div>
            @endforeach
        </div>
    </div>
    @endsection
</body>

</html>