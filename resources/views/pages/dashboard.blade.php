<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title')
    dashboard
    @endsection
</head>

<body>
    @extends('layouts.master')

    @section('content')
    <h1>Content here</h1>
    @endsection

    @section('footerScript')
    @parent
    <h1>Children here</h1>
    @endsection

    @section('footer')
    <h1>Footer here</h1>
    @endsection
</body>

</html>