@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>{{ $post->title }}</h2>

            <p>{{ $post->body }}</p>
        </div>
    </div>
</div>
@endsection