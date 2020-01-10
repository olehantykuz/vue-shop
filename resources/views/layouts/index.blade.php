<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin - @yield('title')</title>
</head>
<body>
<div>
    <ul>
        @guest
            <li><a href="#">Register</a></li>
            <li><a href="#">Login</a></li>
        @endguest
        <li><a href="{{ route('products.list') }}">Products</a></li>
        <li><a href="{{ route('categories.list') }}">Categories</a></li>
    </ul>
</div>
<div class="content">
    <div class="container">
        @yield('content')
    </div>
</div>
</body>
</html>
