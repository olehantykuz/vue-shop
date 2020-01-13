<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Admin - @yield('title')</title>
</head>
<body>
    <div>
        <div class="float-right">
            @auth<p>Hi, {{ Auth::user()->name }}</p>@endauth
            @include('cart.small')
        </div>
        <ul class="list-group list-group-horizontal">
            @guest
                <li class="list-group-item"><a href="/">Home</a></li>
                <li class="list-group-item"><a href="/register">Register</a></li>
                <li class="list-group-item"><a href="/login">Login</a></li>
            @endguest
            @auth
                    <li class="list-group-item"><a href="/logout">Logout</a></li>
            @endauth
            <li class="list-group-item"><a href="{{ route('products.list') }}">Products</a></li>
            <li class="list-group-item"><a href="{{ route('categories.list') }}">Categories</a></li>
        </ul>
    </div>
    <div class="content">
        <div class="container">
            @yield('content')
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
