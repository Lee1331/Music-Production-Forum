@extends('layouts.article')

@section('title', 'Articles')

@section('content')
    <div id="articles">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    @if(count($articles) > 0)
                        @if(count($featuredArticles) > 0)
                            <div class="col-7">
                                @foreach($articles as $article)
                                    @include('partials.article.articleCard')
                                    <hr>
                                @endforeach
                                <div class="card-footer">
                                    {{$articles->render()}}
                                </div>
                            </div>
                            <div class="col-4" >
                                <div class="sticky-top" >
                                    <h3 class="mb-0">
                                        Picked by us
                                    </h3>
                                    @foreach($featuredArticles as $article)
                                        <hr>
                                        @include('partials.article.featuredArticle')
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="col-12">
                                @foreach($articles as $article)
                                    @include('partials.article.articleCard')
                                    <hr>
                                @endforeach
                                <div class="card-footer">
                                    {{$articles->render()}}
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col s12">
                                <p>No articles found</p>
                                <hr>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
