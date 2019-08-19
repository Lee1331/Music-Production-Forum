@section('dashboard')
    <nav class="col-md-2 d-none d-md-block bg-light sidebar" id="sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.home')}}">
                        <i class="fas fa-chart-pie"></i>
                        Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.index')}}">
                        <i class="fa fa-users"></i>
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.article.index')}}">
                        <i class="fas fa-folder"></i>
                        Articles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.thread.index')}}">
                        <i class="far fa-clone"></i>
                        Forum Threads
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.post.index')}}">
                        <i class="fa fa-square"></i>
                        Forum Posts
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{route('admin.category.index')}}">
                        <i class="fa fa-folder-open"></i>
                        Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{route('admin.tag.index')}}">
                        <i class="fa fa-tags"></i>
                        Tags
                    </a>
                </li>
            </ul>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Tracks</span>
                <a class="d-flex align-items-center text-muted" href="#">
                </a>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.track.weekly.index')}}">
                        This Weeks Entries
                    </a>
                    <a class="nav-link" href="{{route('admin.track.index')}}">
                        All Entries
                    </a>
                </li>
            </ul>
        </div>
    </nav>
@endsection
