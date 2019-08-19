@section('dashboard')
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">

        <div class="sidebar-sticky">
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link">
                        Popular Forum Threads
                    </a>
                    <hr>
                </li>

                @foreach($popularThreads as $popularThread)
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{route('forum.show', $popularThread->title)}}">
                            <div id="tooltip"> {{$popularThread->title}}
                                <span id="tooltiptext">{{$popularThread->forumPosts->count()}} Current Posts</span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>

            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <hr>
                    <a class="nav-link">
                        Trending Forum Threads
                    </a>
                    <hr>
                </li>

                @foreach($trendingThreads as $trendingThread)
                    <li class="nav-item">
                        <a class="nav-link text-primary" href="{{route('forum.show', $trendingThread->title)}}">
                            <div id="tooltip"> {{$trendingThread->title}}
                                <span id="tooltiptext">{{$trendingThread->view_count}} Views</span>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
@endsection
