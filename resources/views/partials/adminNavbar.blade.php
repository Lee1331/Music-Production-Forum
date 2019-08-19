@section('navbar')
    <nav class="navbar navbar-expand-md navbar-laravel" id="navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Sonorous
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <i class="fa fa-bars hamburger-icon" aria-hidden="true"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="cursor: pointer;">
                            Articles
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="{{ route('article') }}">
                                Browse by Articles
                            </a>
                            <a class="dropdown-item" href="{{ route('tags') }}">
                                Browse by Tags
                            </a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre style="cursor: pointer;">
                                Tracks
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"  href="{{ route('track') }}">
                                    Weekly Tracks
                                </a>
                                @auth
                                    <a class="dropdown-item" href="{{ route('track.create') }}">
                                        Submit a Track
                                    </a>
                                @endauth
                                <a class="dropdown-item" href="{{ route('track.archives') }}">
                                    Archives
                                </a>
                            </div>
                        </li>
                    <a class="nav-link" href="{{ route('forum') }}">Forum</a>
                    <!-- Authentication Links -->

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"> (Admin)</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('admin.home') }}">
                                Dashboard
                            </a>

                            <a class="dropdown-item" href="{{ route('admin.logout') }}">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <a href="{{ route('admin.logout') }}">

                            </a>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
@endsection
