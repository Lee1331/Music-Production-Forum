<div class="card">
    <nav class="navbar navbar-expand-lg" id="userNav">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">

                <!--If the user is a guest, or logged in but their id is different to that of the user they are visiting-->
                @if(Auth::guest() || $user['id'] !== Auth::user()->id)
                    <a class="nav-item nav-link" href="{{route('user.show', ['user' => $user['name']] )}}">Threads</a>
                    <a class="nav-item nav-link" href="{{route('user.likes.show', ['user' => $user['name']] )}}">Likes</a>
                    <a class="nav-item nav-link" href="{{route('user.tracks.show', ['user' => $user['name']] )}}">Featured Tracks</a>
                <!--Else if the user is logged in, and is visting their own account-->
                @elseif(Auth::user() && $user['id'] === Auth::user()->id)
                    <a class="nav-item nav-link" href="{{route('home')}}">Threads</a>
                    <a class="nav-item nav-link" href="{{route('home.likes.show')}}">Likes</a>
                    {{-- <a class="nav-item nav-link" href="{{route('likes')}}">Likes</a> --}}
                    {{-- <a class="nav-item nav-link" href="{{route('home.likes.show')}}">Likes</a> --}}
                    <a class="nav-item nav-link" href="{{route('home.tracks.show')}}">Featured Tracks</a>
                    {{-- <a class="nav-item nav-link" href="{{route('test')}}">Featured Tracks</a> --}}
                @endif

            </div>
        </div>
    </nav>
</div>
