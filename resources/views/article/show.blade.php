@extends('layouts.article')

@section('title', 'Articles')

@section('content')
    <div class="container">
        <div class="jumbotron p-3 p-md-5 text-text-dark rounded bg-white">
                <div class="container-fluid display-inline">
                    <div class="row">
                        <div class="col-9" >
                            @if($article->tags->count() > 0)
                                <div class="mx-auto flex-grow-1">
                                    <i class="fa fa-tags" style="font-size:24px;color:black"></i>
                                    @foreach($article->tags as $tag)
                                        <ul class="list-inline" id="tags">
                                            <a href="{{route('tags.show', $tag->name)}}">
                                                <li class="list-inline-item">{{$tag->name}}</li>
                                            </a>
                                        </ul>
                                    @endforeach
                                </div>
                            @endif
                            <h1 class="display-9 font-italic">{{$article->title}}</h1>
                            <div class="mb-1 text-muted font-italic">
                                by {{$article->author->name}} | {{$article->created_at}}
                            </div>
                        </div>
                        @if($article->header_image)
                            <div class="col-3">
                                <img id="article-header-img" src="{{asset('images/'. $article->header_image)}}">
                            </div>
                        @endif
                    </div>
                <hr>
                <p class="lead my-3">"{!! $article->excerpt !!}"</p>
            </div>
            <hr>
            @if($article->body_image)
                <img class="card-img-top" src="{{asset('images/'. $article->body_image)}}" alt="Article Body Image" id="body-image">
            @endif
            <div class="col-md-11">
                <p class="lead my-3">{!! $article->body !!}</p>
            </div>
        </div>
    </div>
@endsection
