@section('category-navbar')
    <nav class="navbar navbar-expand-md mx-auto">
        <a class="navbar-brand mx-auto">
            <h2 id="title">Categories | </h2>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCategories" aria-controls="navbarCategories" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon">
                    <i class="fa fa-folder-open"></i>
                </span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCategories">
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                @foreach($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('forum.category.show', $category->name) }}">
                            <h2>
                                {{$category->name}}
                            </h2>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </nav>
@endsection
