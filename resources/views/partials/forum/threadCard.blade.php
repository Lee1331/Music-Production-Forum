@if(auth()->check())
    <div class="col-2">
        <div class="sticky-top" >
            <div class="card">
                <div class="card-body">
                    <h3>
                        <a class="nav-link" href="{{route('forum.create')}}">
                            Create New Thread
                        </a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
@else
    <div class="col-2" id="login-col">
        <div class="sticky-top">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <h3>
                            <a href="{{ route('login') }}">
                                Login to Create a Thread
                            </a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
