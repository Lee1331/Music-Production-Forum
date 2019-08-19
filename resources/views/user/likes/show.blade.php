@extends('layouts.user')

@section('title', 'Liked Posts')

@section('content')
    @include('partials.user.profileBanner')
    @if(empty($likedPosts->total))
        @include('partials.user.homepageNavbar')
        <div class="card">
            <div class="card-body">
                @foreach($likedPosts as $likedPost)
                    <div id="tooltip"><h3 class="media-heading"><a href="{{route('forum.show', $likedPost->forumPost->forumThread->title)}}"> {{$likedPost->forumPost->title}}</a></h3>
                        <span id="tooltiptext">in {{$likedPost->forumPost->forumThread->title}}</span>
                    </div>
                    <br>
                @endforeach
            </div>
        </div>
    @endif
@endsection
