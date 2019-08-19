<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Sonorous | Welcome</title>

        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="text-center align-content-center">
        <div id="content" class="d-flex-center w-150 h-150 mx-auto">
                <h1 class="cover-heading">Welcome to Sonorous!</h1>
                    <nav class="nav justify-content-center">
                        <a class="nav-link" href="{{ route('article') }}">Articles</a>
                        <a class="nav-link" href="{{ route('forum') }}">Forum</a>
                            <a class="nav-link"  href="{{ route('track') }}">
                                Tracks
                            </a>
                        @if (Route::has('login'))
                            @auth
                                <a class="nav-link" href="{{ url('/home') }}">Home</a>
                            @else
                                <a class="nav-link" href="{{ route('login') }}">Login</a>

                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                                @endif
                            @endauth
                        @endif
                    </nav>
                <h1 class="cover-heading">Est 2019</h1>
            <footer class="mastfoot mt-auto">
                <div class="inner">
                    <p>Powered by Laravel</p>
                </div>
            </footer>
        </div>
    </body>
</html>
