@extends('layouts.admin')

@section('title', 'Manage Tags')

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
                <a class="nav-link" href="{{route('admin.tag.create')}}">
                    <i class="	fa fa-tags"></i>
                    Create New Tag
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-fixed">
                    <thead class="thead-light">
                        <tr>
                            <th>#id</th>
                            <th>Name</th>
                            <th>Related Articles</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                            <tr>
                                <td>{{$tag->id}}</td>
                                <td>
                                    <a href="{{ route('tags.show', $tag->name) }}">
                                        {{$tag->name}}
                                    </a>
                                </td>
                                <td>
                                    {{count($tag->articles)}}
                                </td>
                                <td>

                                    <form action="{{ route('admin.tag.edit', $tag->id) }}" >
                                        <button type="submit">
                                            <i class="fa fa-edit"></i>
                                            {!! csrf_field() !!}
                                        </button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('admin.tag.destroy', $tag->id) }}" method="POST">
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
            {{$tags->render()}}
        </div>
@endsection
