@extends('layouts.admin')

@section('title', 'Manage Articles')

@section('content')
    <div class="card">
        <div class="card-header">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-warning" role="alert">{{$error}}</div>
                @endforeach
            @endif
            @if(session('message'))
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            @endif
            <div class="d-flex justify-content-center">
                <a class="nav-link" href="{{route('admin.article.create')}}">
                    <i class="far fa-clone"></i>
                    Create New Article
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead class="thead-light">
                        <tr>
                            <th>#id</th>
                            <th>Title</th>
                            <th>Excerpt</th>
                            <th>Tags</th>
                            <th>Header Image</th>
                            <th>Body Image</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td>{{$article->id}}</td>
                                <td>
                                    <a href="{{route('article.show', $article->title)}}">
                                        {{$article->title}}
                                    </a>
                                </td>
                                <td>{{$article->excerpt}}</td>
                                <td>
                                    @if($article->tags)
                                        @foreach($article->tags as $tag)
                                            <a href="{{route('tags.show', $tag->name)}}">
                                                <strong class="d-inline-block mb-2 text-primary">{{$tag->name}}</strong>
                                            </a>
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if( $article->header_image )
                                        <img src="{{asset('images/'. $article->header_image)}}" style="width:256px; height:256px;">
                                    @endif
                                </td>
                                <td>
                                    @if( $article->body_image )
                                        <img src="{{asset('images/'. $article->body_image)}}" style="width:256px; height:256px;">
                                    @endif
                                </td>
                            <td>
                                <form action="{{ route('admin.article.edit', $article->title) }}" >
                                    <button type="submit">
                                        <i class="fa fa-edit"></i>
                                        {!! csrf_field() !!}
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('admin.article.destroy', $article->id) }}" method="POST">
                                    <button type="submit">
                                        <i class="fa fa-edit"></i>
                                        {!! csrf_field() !!}
                                        {{ method_field('DELETE') }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            {{$articles->render()}}
        </div>
@endsection
