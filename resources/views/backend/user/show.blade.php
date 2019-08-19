@extends('layouts.user')

@section('title', 'User Accounts')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="media">
                @if($user->profile_image)
                    <div class="media-left">
                        <div class="col-sm-12 col-md-6 col-lg-3 my-1">
                            <img src="{{asset('images/'. $user->profile_image)}}" alt="{{$user->name}}'s profile image">
                        </div>
                    </div>
                @endif
                <div class="media-body">
                    <h3 class="media-heading"><a href="#"></a></h3>
                <div class="post-author-count">
                    <h4>{{$user['name']}} | ({{$user['email']}})</h4>
                    <hr>
                    <h4>User since {{$user['email_verified_at']}}</h4>
                </div>
                    <p>{{$user['bio']}}</p>
                </div>
            </div>
        </div>
    </div>
    @include('partials.user.homepageNavbar')

    @foreach($threads as $thread)
        <div class="card">
            <div class="card-body">

                <div class="media">
                    <div class="media-body">
                        <h3 class="media-heading"><a href="{{route('forum.show', $thread->title)}}">{{$thread->title}}</a></h3>
                        <div id="tooltip">{{$thread->display()->formatedCreatedAtDate}} ago...
                            <span id="tooltiptext">{{$thread->created_at}}</span>
                        </div>
                        in
                        <a class="d-inline" href="{{ route('forum.category.show', $thread->category_name) }}">
                            {{$thread->category_name}}
                        </a>
                        <hr>
                        {{$thread->body}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    {{$threads->render()}}
@endsection
