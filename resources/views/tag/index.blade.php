@extends('layouts.article')

@section('title', 'Choose a Topic')

@section('content')

    @if(count($tags) > 0)
        <div class="row">
            @forelse($tags as $tag)
                <div class="col s12 m4">
                    <a href="{{route('tags.show', $tag->name)}}">
                    <!--Using in-line styling as only a couple of elements need it-->
                    <div class="tags-jumbotron jumbotron p-3 p-md-5" style="background-color: #7CC2CB; color: #FEFFFF;">
                        <strong class="d-inline-block mb-2 ">{{$tag->name}}</strong>
                    </div>
                    </a>
                </div>
            @empty
                <div class="col s12">
                    <p>No tags found</p>
                    <hr>
                </div>
            @endforelse
        </div>
    @endif
@endsection

