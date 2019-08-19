@extends('layouts.user')

@section('title', 'Home')

@section('content')
    @include('partials.user.profileBanner')
    @if(empty($threads->total))
        @include('partials.user.homepageNavbar')
        @foreach($threads as $thread)
            <div class="card">
                <div class="card-body">
                    <div class="media">
                        <div class="media-body">
                            <h3 class="media-heading"><a href="{{route('forum.show', $thread->title)}}">{{$thread->title}}</a></h3>
                            <div id="tooltip">{{$thread->display()->FormatedCreatedAtDate}} ago...
                                <span id="tooltiptext">{{$thread->created_at}}</span>
                            </div>
                            |
                            in
                            <a class="d-inline" href="{{ route('forum.category.show', $thread->category_name) }}">
                                    {{$thread->category_name}}
                                </a>
                                with {{$thread->view_count}} views
                            |
                            <div id="tooltip"> Last Updated at... {{$thread->display()->FormatedUpdatedAtDate}}
                                <span id="tooltiptext">{{$thread->updated_at}}</span>
                            </div>
                            <br>
                            <hr>
                            {{$thread->body}}
                            {{$thread->desc}}
                        </div>
                        <div class="d-inline">
                            Edit Thread
                            <form action="{{ route('forum.edit', $thread->title) }}" >
                                <button type="submit">
                                    <i class="fa fa-edit"></i>
                                    {!! csrf_field() !!}
                                </button>
                            </form>
                            Delete Thread
                            <form action="{{ route('forum.destroy', $thread->id) }}" method="POST">
                                <button type="submit">
                                    <i class="fa fa-edit"></i>
                                    {!! csrf_field() !!}
                                    {{ method_field('DELETE') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
{{$threads->render()}}
@endsection
