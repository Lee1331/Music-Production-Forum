@extends('layouts.forum')

@section('title', 'Threads | ' . $thread->title)

@section('content')
    <!-- Styles -->
    <link href="{{ asset('css/forum.css') }}" rel="stylesheet">

    <div class="card">
        <div class="card-body">
            <div class="media">
                @if($thread->owner['profile_image'])
                    <div class="media-left">
                        <img src="{{asset('images/'. $thread->owner->profile_image)}}" alt="{{$thread->owner->name}}'s profile image">
                    </div>
                @endif
                <div class="media-body">
                    <h3 class="media-heading">
                        @if($thread->owner_name)
                        <a href="{{route('user.show', ['user' => $thread->owner['name']])}}">
                            {{$thread->owner_name}}
                        </a>
                        @else
                            Deleted User
                        @endif
                        asked...</h3>
                    <h4>
                        <a href="{{route('forum.show', $thread->title)}}">{{$thread->title}}</a>
                    </h4>
                    <div id="tooltip">{{$thread->display()->formatedCreatedAtDate}} ago...
                        <span id="tooltiptext">{{$thread->created_at}}</span>
                    </div>
                    |
                    <div id="tooltip">Last updated {{$thread->display()->formatedUpdatedAtDate}}
                        <span id="tooltiptext">{{$thread->updated_at}}</span>
                    </div>
                    <hr>
                    {{$thread->body}}
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2> Responces </h2>
    </div>

    <div class="d-flex justify-content-center">
        <div class="col-10">
            @foreach($thread->forumPosts as $post)
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            @if($post->owner['profile_image'])
                                <div class="media-left">
                                    <img src="{{asset('images/'. $post->owner->profile_image)}}" alt="{{$post->owner->name}}'s profile image">
                                </div>
                            @endif
                            <div class="media-body">
                                <h3 class="media-heading">{{$post->title}}</h3>
                                by
                                @if($post->owner['name'])
                                    <a href="{{route('user.show', ['user' => $post->owner['name']])}}">
                                        {{$post->owner['name']}}
                                    </a>
                                @else
                                    Deleted User
                                @endif
                                <div id="tooltip">, {{$post->display()->formatedCreatedAtDate}} ago...
                                    <span id="tooltiptext">{{$post->created_at}}</span>
                                </div>
                                @if(Auth::check())
                                    <div id="tooltip">
                                        <form method="POST" action="{{ route(('like.post'), $post->title)}}">
                                            {{csrf_field()}}
                                            <label for="likePost">Like</label>
                                            <button type="submit" id="likePost" class="{{$post->isAlreadyLiked() ? 'disabled' : ''}}">
                                                <i class='far fa-heart'></i>
                                            </button>
                                        </form>
                                        <span id="tooltiptext">Like Forum Post</span>
                                    </div>

                                    <div id="tooltip">
                                        <form method="POST" action="{{ route(('dislike.post'), $post->title)}}">
                                            {{csrf_field()}}
                                            {{ method_field('DELETE') }}
                                            <label for="dislikePost" >Dislike</label>
                                            <button type="submit" id="dislikePost" class="{{$post->isAlreadyLiked() ? '' : 'disabled'}}">
                                                <i class="fa fa-heart"></i>
                                            </button>
                                        </form>
                                        <span id="tooltiptext">Dislike Forum Post</span>
                                    </div>

                                    @if(Auth::user()->id === $post->owner->id)
                                        <div id="tooltip">
                                            <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                                <label>| Delete</label>
                                                <button type="submit">
                                                    <i class="fa fa-edit"></i>
                                                    {!! csrf_field() !!}
                                                    {{ method_field('DELETE') }}
                                                </button>
                                            </form>
                                            <span id="tooltiptext">Delete Your Forum Post</span>
                                        </div>
                                    @endif
                                @endif
                                {{$post->likes_count}}
                                @if($post->likes_count)
                                    current like(s)
                                @endif

                                <hr>
                                {{$post->body}}
                                {{$post->desc}}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if(Auth::check())
                <div class="col-2" id="right-col">
                    <div class="sticky-top" >
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{route('forum.posts', $thread->title)}}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Body</label>
                                        <textarea class="form-control" id="body" name="body" rows="3"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Reply to Thread</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else()
                <div class="col-2">
                    <div class="sticky-top" >
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center">
                                    <h3>
                                        <a href="{{ route('login') }}">Login to Reply</a>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
