@extends('layouts.article')

@section('title', " $tag->name")

@section('content')

    <div id="articles">
            <div class="card">
                    <div class="card-body">
                <div class="row">
                    <!-- if there are no articles other then the trending article, give the trending articles a full column (col-12)-->
                    @if(count($articles) === 0)
                        <div class="col-12">
                            @forelse($trendingArticles as $article)
                                @include('partials.article.featuredArticle')
                                <hr>
                            @empty
                                <p>No trending articles found</p>
                                <hr>
                            @endforelse
                        </div>
                    @else
                        <div class="col-lg-7 col-xs-12">
                            @forelse($articles as $article)
                                @include('partials.article.articleCard')
                                <hr>
                            @empty
                                <p>No articles found</p>
                                <hr>
                            @endforelse
                        </div>
                        <div class="col-lg-4 col-xs-12">
                            <div class="sticky-top">
                                <h3 class="mb-0">
                                    <a class="text-dark" href="{{route('tags.show', 'featured')}}">Trending in this Tag</a>
                                </h3>
                                @forelse($trendingArticles as $article)
                                    <hr>
                                    @include('partials.article.featuredArticle')
                                @empty
                                    <p>No trending articles found</p>
                                    <hr>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
