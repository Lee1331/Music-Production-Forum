@extends('layouts.forum')

@section('title', 'Categories')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="col-10">
            @foreach($threads as $thread)
                <div class="card">
                    <div class="card-body">
                        <div class="media">
                            <div class="media-body">
                                <h3 class="media-heading"><a href="{{route('forum.show', $thread->title)}}">{{$thread->title}}</a></h3>
                                by
                                @if($thread->owner['name'])
                                    <a href="{{ route('user.show', ['user' => $thread->owner->name]) }}">
                                        {{$thread->owner['name']}}
                                    </a>
                                @else
                                    Deleted User
                                @endif
                                ,
                                <div id="tooltip">{{$thread->display()->formatedCreatedAtDate}} ago...
                                    <span id="tooltiptext">{{$thread->created_at}}</span>
                                </div>
                                with {{$thread->view_count}} views
                                <hr>
                                {{$thread->body}}
                            </div>
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
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
    </div>
@endsection
