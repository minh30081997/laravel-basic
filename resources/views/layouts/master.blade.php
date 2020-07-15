<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My site | @yield('title', 'Home Page')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="header">
        @include('layouts.header')
    </div>

    <div class="content">
        @yield('content')
    </div>

    <div class="footer">
        @section('footerScript')
        <h1>Parent here</h1>
        @show
        @yield('footer')
    </div>
</body>
</html>