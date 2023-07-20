<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Coverage Check</title>
    @section('head')
        @include('inc.coverage.head')
    @show
</head>

<body>
    @yield('content')
    @section('foot')
        @include('inc.coverage.foot')
    @show
</body>

</html>
