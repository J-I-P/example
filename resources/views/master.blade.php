<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title class="title m-b-md">@yield('title') - Shop</title>

        <!--<link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    </head>
<body>
    <header class="top-right links">
        <a href="{{ route('registerPage') }}">Register</a>
        <a href="{{ route('loginPage') }}">Login</a>
    </header>

    <div class="content">
        @yield('content')
    </div>

    <footer class="content">
        <a href="#">Contact Us</a>
    </footer>
</body>
</html>