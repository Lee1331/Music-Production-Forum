<div class="row">
    <div class="col-9">
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
        <h3 class="mb-0">
            <a class="text-dark" href="{{route('article.show', $article->title)}}">{{$article->title}}</a>
        </h3>
        <div class="mb-1 text-muted font-italic">by {{$article->author->name}} | {{$article->created_at}}</div>
        <p class="card-text mb-auto">{!! str_limit($article->excerpt, 100, '...')!!} </p>
        <a href="{{route('article.show', $article->title)}}" class="mb-1">Continue reading</a>
    </div>
    @if($article->header_image)
        <div class="col-3">
            <div id="header-image" class="article-card-img">
                <img class="card-img-top" src="{{asset('images/'. $article->header_image)}}" href="{{route('article.show', $article->title)}}">
            </div>
        </div>
    @endif
</div>

