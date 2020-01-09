<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin - @yield('title')</title>
</head>
<body>
<div class="content">
    <div class="container">
        @yield('content')
    </div>
</div>
</body>
</html>
