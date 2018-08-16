<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title class="title m-b-md">@yield('title') - Shop</title>
        <link href="{{ asset('css/test.css') }}" rel="stylesheet" type="text/css">
    </head>
<body>
    <header class="top-right links">

        @if (is_null(session()->get('user_id')))
            <a href="{{ route('registerPage') }}" class="btn btn1">Register</a>
            <a href="{{ route('loginPage') }}" class="btn btn1">Login</a>
        @else
            <a href="{{ route('logoutPage') }}" class="btn btn1">Logout</a>
        @endif

    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer class="content">
        <a href="#">Contact Us</a>
    </footer>
</body>
</html>