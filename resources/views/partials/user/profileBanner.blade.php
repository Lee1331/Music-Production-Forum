<div class="card">
    <div class="card-body">
        <div class="media">
            <div class="media-left" >
                <div class="col-sm-12 col-md-6 col-lg-3 my-1">
                    <a href="{{route('home.edit', $user)}}">
                        @if($user->profile_image)
                            <div class="card-body" id="edit-account-card">
                                <img src="{{asset('images/'. $user->profile_image)}}" alt="{{$user->name}}'s profile image">
                                <div id="edit-account-slide">
                                    <h3 id="edit-text">Edit</h3>
                                    <h3 id="account-text">Account</h3>
                                </div>
                            </div>
                        @else
                            <div class="card-body"  id="edit-account-card" >
                                <h5 class="card-title">Edit Account</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Click here to edit your account</h6>
                            </div>
                        @endif
                    </a>
                </div>
            </div>
            <div class="media-body">
                <h3 class="media-heading"><a href="#"></a></h3>
                <div class="post-author-count">
                    <h4>{{$user->name}} | ({{$user->email}})</h4>
                    <hr>
                    <h4>User since {{$user->email_verified_at}}</h4>
                </div>
                <p>{{$user->bio}}</p>
            </div>
        </div>
    </div>
</div>
